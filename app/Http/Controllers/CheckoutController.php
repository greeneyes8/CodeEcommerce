<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller {

    public function place(Order $orderModel, CheckoutService $checkoutService)
    {
        if ( ! Session::has('cart'))
        {
            return false;
        }

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0)
        {

            DB::beginTransaction();
            try
            {

                $checkout = $checkoutService->createCheckoutBuilder();

                $order = $orderModel->create(['user_id' => Auth::user()->id, 'total' => $cart->getTotal(), 'stats_id' => 1]);
                foreach ($cart->all() as $k => $item)
                {
                    $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, '.', ''), $item['qtd']));
                    $order->items()->create(['product_id' => $k, 'price' => $item['price'], 'qtd' => $item['qtd']]);
                }

                $checkout->setReference($order->id);
                $checkout->setRedirectTo(route('store.payment', ['id' => $order->id]));
                $response = $checkoutService->checkout($checkout->getCheckout());
                $order->update(['code_pagseguro' => $response->getCode()]);

                DB::commit();
            }
            catch (\Exception $e)
            {
                DB::rollBack();
                \Flash::error('Erro ao inserir Pedido. Tente novamente mais tarde! \n' . $e);

                return redirect()->back()->withInput();
            }
        }

        return redirect($response->getRedirectionUrl());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * Responsável por receber o redirecionamento do pagseguro e redirecionar o usuário
     */
    public function payment($id)
    {
        $order = Order::where('id', $id)->IsOwner()->firstOrFail();

        $order->update(['stat_id' => 2]);

        Session::forget('cart');

//        event(new CheckoutEvent(Auth::user(), $order));

        return redirect()->route('store.checkout', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     *
     * Responsável por mostrar o resumo do pedido na tela
     */
    public function checkout($id)
    {
        $order = Order::where('id', $id)->IsOwner()->firstOrFail();

        return view('store.checkout', compact('order'));
    }

    public function payment_status(Request $request)
    {
        if ($request->get('notificationType') == 'transaction')
        {
            $url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/' . $request->get('notificationCode') . '?email=' . config('pagseguro.email') . '&token=' . config('pagseguro.token');

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $transaction = curl_exec($curl);
            curl_close($curl);

            if ($transaction == 'Unauthorized')
            {
                //MSG de ERRO!
                exit();
            }

            $transaction = simplexml_load_string($transaction);

            switch ($transaction->status)
            {
                case 1:
                    $code = 2;
                    break; //Aguardando pagamento
                case 2:
                    $code = 2;
                    break; //Em análise
                case 3:
                    $code = 3;
                    break; //Paga
                case 4:
                    $code = 3;
                    break; //Disponível
                case 5:
                    $code = 1;
                    break; //Em disputa
                case 6:
                    $code = 6;
                    break; //Devolvida
                case 7:
                    $code = 6;
                    break; //Cancelada
                case 8:
                    $code = 6;
                    break; //Chargeback debitado
                case 9:
                    $code = 6;
                    break; //Em contestação
                default:
                    $code = 1;
            }

            $order = Order::where('id', $transaction->reference)->firstOrFail();

            $order->update(['stat_id' => $code, 'code_pagseguro' => $transaction->code]);
        }
    }
}