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

        <div class="form-group">
            {!! Form::label('category', 'Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('price', 'Price:') !!}
            {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::checkbox('featured') !!}
            {!! Form::label('featured', 'Featured') !!}

            {!! Form::checkbox('recommend') !!}
            {!! Form::label('recommend', 'Recommend') !!}
        </div>

        <div class="form-group">
            {!! Form::label('tag_list') !!}
            {!! Form::textarea('tag_list', null, ['class' => 'form-control', 'rows' => '1']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save Product', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection