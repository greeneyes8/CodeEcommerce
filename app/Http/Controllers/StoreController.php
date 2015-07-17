<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use CodeCommerce\Tag;

class StoreController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products    = Product::featured()->get();
        $recommended = Product::recommended()->get();
        $categories  = Category::all();

        return view('store.index', compact('categories', 'products', 'recommended'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category   = Category::find($id);
        $products   = $category->products;

        return view('store.category', compact('categories', 'products', 'category'));
    }

    public function product($id)
    {
        $categories = Category::all();
        $product    = Product::find($id);

        return view('store.product', compact('categories', 'product', 'category'));
    }

    public function tag($id)
    {
        $categories = Category::all();
        $tag        = Tag::find($id);

        return view('store.tag', compact('categories', 'category', 'tag'));
    }
}