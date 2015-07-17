@extends('store.store')

@section('categories')
    @include('store.partials.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">

        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ $category->name }}</h2>
            @include('store.partials.product', ['products' => $products])
        </div>
        <!--features_items-->

    </div>
@stop