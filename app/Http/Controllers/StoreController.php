<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use Illuminate\Http\Request;

class StoreController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pFeatured  = Product::featured()->get();
        $categories = Category::all();

        return view('store.index', compact('categories', 'pFeatured'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $pFeatured = $category->products;

        return view('store.index', compact('categories', 'pFeatured'));
    }
}
