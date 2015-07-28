@extends('store.store')

@section('content')
    <div class="container">
        <h3>Pedido realizado com sucesso!</h3>

        <p>O Pedido #{{ $order->id }}, foi realizado com sucesso.</p>
        <!--/product-details-->
    </div>
@stop