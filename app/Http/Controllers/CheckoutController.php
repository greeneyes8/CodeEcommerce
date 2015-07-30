<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {

    public function place(Order $orderModel)
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
                $order = $orderModel->create(['user_id' => Auth::user()->id, 'total' => $cart->getTotal(), 'stats_id' => 1]);
                foreach ($cart->all() as $k => $item)
                {
                    $order->items()->create(['product_id' => $k, 'price' => $item['price'], 'qtd' => $item['qtd']]);
                }

                Session::forget('cart');

                DB::commit();

                event(new CheckoutEvent(Auth::user(), $order));
            }
            catch (\Exception $e)
            {
                DB::rollBack();
                \Flash::error('Erro ao inserir Pedido. Tente novamente mais tarde!');

                return redirect()->back()->withInput();
            }
        }

        return redirect()->route('store.checkout', ['id' => $order->id]);
    }

    public function checkout($id)
    {
        $order = Order::where('id', $id)->IsOwner()->firstOrFail();

        return view('store.checkout', compact('order'));
    }
}
