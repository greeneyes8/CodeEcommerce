@extends('app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        <br>
        <a href="{{ route('products.create') }}" class="btn btn-default">New Product</a>
        <br>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ str_limit($product->description, 100, '...') }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td width="70px"><a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-link btn-sm">Edit</a></td>
                    <td width="70px">
                        {!! \Form::model($product, ['method' => 'DELETE', 'url' => route('products.destroy', [$product->id])]) !!}
                        <button type="submit" class="btn-delete btn btn-link btn-sm text-red">Delete</button>
                        {!! \Form::close()!!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $products->render() !!}
    </div>
@endsection