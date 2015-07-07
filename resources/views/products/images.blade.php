@extends('app')

@section('content')
    <div class="container">
        <h1>Images of {{ $product->name }}</h1>

        <br>
        <a href="{{ route('products.images.create', [$product->id]) }}" class="btn btn-default">New Image</a>
        <br>
        <br>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Extension</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($product->images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>
                        <img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" width="80">
                    </td>
                    <td>{{ $image->extension }}</td>
                    <td width="70px">
                        {!! \Form::model($image->product->id, ['method' => 'DELETE', 'url' => route('products.images.destroy', [$image->product->id, $image->id])]) !!}
                        <button type="submit" class="btn-delete btn btn-link btn-sm text-red">Delete</button>
                        {!! \Form::close()!!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('products.index') }}" class="btn btn-default">Voltar</a>

    </div>
@endsection