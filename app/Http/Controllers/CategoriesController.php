<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->model->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();

        $category = $this->model->fill($input);

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->model->find($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * @param                 $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CategoryRequest $request)
    {
        $this->model->find($id)->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return redirect()->route('categories.index');
    }
}
