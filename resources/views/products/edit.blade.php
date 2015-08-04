@extends('app')

@section('content')
    <div class="container">
        <h1>Editing Product: {{ $product->name }}</h1>

        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::model($product, ['method' => 'PUT', 'url' => route('products.update', [$product->id])]) !!}

        @include('products._form')

        <div class="form-group">
            {!! Form::submit('Save Product', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection