@extends('store.store')

@section('categories')
    @include('store.partials.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">

                    @if(count($product->images))
                        <img src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}" alt="" width="200px"/>
                    @else
                        <img src="{{ url('build/images/no-img.jpg') }}" alt="" width="200px"/>
                    @endif

                </div>

                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach($product->images as $image)
                                <a href="#"><img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" alt="" width="80"></a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->

                    <h2>{{ $product->name }}</h2>

                    <p>{{ $product->description }}</p>

                    <span>
                        <span>R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Adicionar no Carrinho
                            </a>
                    </span>

                    @foreach($product->tags as $tag)
                        <a href="{{ route('store.tag', ['id' => $tag->id]) }}">
                            <span class="label label-primary">
                                {{ $tag->name }}
                            </span>
                        </a>
                    @endforeach


                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->
    </div>
@stop