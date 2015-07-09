<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\ProductImageRequest;
use CodeCommerce\Http\Requests\ProductRequest;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller {

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
        $tag_list = explode(',', str_replace(';', '', $input['tag_list']));
        $tags = [];

        foreach($tag_list as $tag){
            $tags[] = Tag::firstOrCreate(['name' => trim($tag)])->id;
        }

        $product = $this->model->fill($input);

        $product->save();

        $product->tags()->sync($tags);

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id, Category $category)
    {
        $product    = $this->model->find($id);
        $categories = $category::lists('name', 'id');

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * @param                 $id
     * @param ProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductRequest $request)
    {
        $input = $request->all();
        $tag_list = explode(',', str_replace(';', '', $input['tag_list']));
        $tags = [];

        foreach($tag_list as $tag){
            $tags[] = Tag::firstOrCreate(['name' => trim($tag)])->id;
        }

        $product = $this->model->find($id);
        $product->update($input);
        $product->tags()->sync($tags);

        return redirect()->route('products.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->model->find($id);

        foreach($product->images as $image)
        {
            if (file_exists(public_path('uploads') . '/' . $image->id . '.' . $image->extension))
            {
                Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
            }

            $image->delete();
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function images($id)
    {
        $product = $this->model->find($id);

        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->model->find($id);

        return view('products.create_image', compact('product'));
    }

    public function storeImage($id, ProductImageRequest $request, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id' => $id, 'extension' => $extension]);

        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('products.images', [$id]);
    }

    public function destroyImage($id, $id_image, ProductImage $productImage)
    {
        $image = $productImage->find($id_image);

        if(file_exists(public_path('uploads').'/'.$image->id.'.'.$image->extension))
        {
            Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
        }

        $image->delete();

        return redirect()->route('products.images', [$id]);
    }
}
