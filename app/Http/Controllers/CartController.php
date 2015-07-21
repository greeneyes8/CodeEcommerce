<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\CartRequest;
use CodeCommerce\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    private $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if ( ! Session::has('cart'))
        {
            Session::set('cart', $this->cart);
        }

        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id)
    {
        $cart = $this->getCart();

        $product = Product::find($id);
        $cart->add($id, $product->name, $product->price);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CartRequest $request)
    {
        $cart = $this->getCart();

        $cart->update($id, $request->get('qtd'));

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cart = $this->getCart();

        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @return Cart
     */
    private function getCart()
    {
        if (Session::has('cart'))
        {
            $cart = Session::get('cart');
        }
        else
        {
            $cart = $this->cart;
        }

        return $cart;
    }
}