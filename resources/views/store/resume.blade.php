@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            <h1>
                Parabéns, compra realizada com sucesso! <br />
                <small>Código do Pedido: {{ $order->id }}</small>
            </h1>

            <br />
            <br />

            <div class="table-responsive cart_info">

                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price text-right">Valor</td>
                            <td class="qtd text-center">Quantidade</td>
                            <td class="total  text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $item->id]) }}">
                                    Imagem
                                </a>
                            </td>

                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $item->id]) }}">{{ $item->product->name }}</a></h4>
                                <p>Código: {{ $item->id }}</p>
                            </td>

                            <td class="cart_price text-right">
                                R$ {{ number_format($item->price, 2, ',', '.') }}
                            </td>

                            <td class="cart_quantity text-center">
                                {{ $item->qtd }}
                            </td>

                            <td class="cart_total text-right">
                                <p class="cart_total_price">
                                    R$ {{ number_format($item->price * $item->qtd, 2, ',', '.') }}
                                </p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='6'>
                                Nenhum produto adicionado ao carrinho
                            </td>
                        </tr>
                    @endforelse

                    @if($order->total > 0)
                    <tr class="cart_menu">
                        <td colspan="5">
                            <div class="pull-right">
                                <span>
                                    TOTAL: R$ {{ number_format($order->total, 2, ',', '.') }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endif

                    </tbody>
                </table>

            </div>

        </div>

    </section>
@stop