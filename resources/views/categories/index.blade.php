@extends('app')

@section('content')
    <div class="container">
        <h1>Categories</h1>

        <br>
        <a href="{{ route('categories.create') }}" class="btn btn-default">New Category</a>
        <br>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td width="70px"><a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-link btn-sm">Edit</a></td>
                    <td width="70px">
                        {!! \Form::model($category, ['method' => 'DELETE', 'url' => route('categories.destroy', [$category->id])]) !!}
                        <button type="submit" class="btn-delete btn btn-link btn-sm text-red">Delete</button>
                        {!! \Form::close()!!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $categories->render() !!}
    </div>
@endsection