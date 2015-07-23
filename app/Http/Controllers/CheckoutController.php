<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller {

    public function place(Order $orderModel, OrderItem $orderItem)
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
                $order = $orderModel->create(['user_id' => Auth::user()->id, 'total' => $cart->getTotal()]);
                foreach ($cart->all() as $k => $item)
                {

                    $order->items()->create(['product_id' => $k, 'price' => $item['price'], 'qtd' => $item['qtd']]);
                }

                Session::forget('cart');

                DB::commit();
            }
            catch (\Exception $e)
            {
                DB::rollBack();
                \Flash::error('Erro ao inserir Pedido!' . $e);

                return redirect()->back()->withInput();
            }
        }

        return redirect()->route('checkout.resume', ['id' => $order->id]);
    }

    public function resume($id)
    {
        $order = Order::find($id);

        if ( ! $order)
        {
            return redirect('/');
        }

        return view('store.resume', compact('order'));
    }
}
