<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Product;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class ProductsController extends Controller
{
    private $productsModel;

    public function __construct(Product $productsModel)
    {
        $this->productsModel = $productsModel;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productsModel->all();
        return view('products.index', compact('products'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();

        $product = $this->productsModel->fill($input);

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->productsModel->find($id);

        return view('products.edit', compact('product'));
    }

    /**
     * @param                 $id
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {
        $this->productsModel->find($id)->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->productsModel->find($id)->delete();

        return redirect()->route('products.index');
    }
}
