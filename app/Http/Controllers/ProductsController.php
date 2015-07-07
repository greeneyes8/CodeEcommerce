<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Product;

class ProductsController extends Controller
{
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->model->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(Category $category)
    {
        $categories = $category::lists('name', 'id');
        return view('products.create', compact('categories'));
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();

        $product = $this->model->fill($input);

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id, Category $category)
    {
        $product = $this->model->find($id);
        $categories = $category::lists('name', 'id');

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * @param                 $id
     * @param ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {
        $this->model->find($id)->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return redirect()->route('products.index');
    }
}
