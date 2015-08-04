@extends('app')

@section('content')
    <div class="container">
        <h1>Editing Category: {{ $category->name }}</h1>

        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::model($category, ['method' => 'PUT', 'url' => route('categories.update', [$category->id])]) !!}

        @include('categories._form')

        <div class="form-group">
            {!! Form::submit('Save Category', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection