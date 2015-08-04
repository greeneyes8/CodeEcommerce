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