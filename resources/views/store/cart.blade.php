@extends('store.store')

@section('content')
    <section id="cart_items">
        <div class="container">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="table-responsive cart_info">

                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price text-right">Valor</td>
                            <td class="qtd text-center">Quantidade</td>
                            <td class="total  text-right">Total</td>
                            <td width="200px" class="text-center"></td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($cart->all() as $id => $item)
                        <tr>
                            <td class="cart_product">
                                <a href="{{ route('store.product', ['id' => $id]) }}">
                                    Imagem
                                </a>
                            </td>

                            <td class="cart_description">
                                <h4><a href="{{ route('store.product', ['id' => $id]) }}">{{ $item['name'] }}</a></h4>
                                <p>Código: {{ $id }}</p>
                            </td>

                            <td class="cart_price text-right">
                                R$ {{ number_format($item['price'], 2, ',', '.') }}
                            </td>

                            <td class="cart_quantity text-center">
                                {!! \Form::open(['url' => route('cart.update', ['id' => $id]), 'class' => 'form-inline ajax']) !!}

                                    <div class="form-group">
                                        {!! \Form::text('qtd', $item['qtd'], ['class' => 'form-control text-center', 'style' => 'width: 50px;']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! \Form::submit('Atualizar', ['class' => 'form-control btn btn-primary', 'style' => 'margin-top: 0;']) !!}
                                    </div>
                                {!! \Form::close() !!}
                            </td>

                            <td class="cart_total text-right">
                                <p class="cart_total_price">
                                    R$ {{ number_format($item['price'] * $item['qtd'], 2, ',', '.') }}
                                </p>
                            </td>

                            <td class="cart_delete text-center">
                                <a href="{{ route('cart.destroy', ['id' => $id]) }}" class="cart_quantity_delete">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='6'>
                                Nenhum produto adicionado ao carrinho
                            </td>
                        </tr>
                    @endforelse

                    @if($cart->getTotal() > 0)
                    <tr class="cart_menu">
                        <td colspan="5">
                            <div class="pull-right">
                                <span>
                                    TOTAL: R$ {{ number_format($cart->getTotal(), 2, ',', '.') }}
                                </span>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('store.checkout.place') }}" class="btn btn-success">FINALIZAR <strong>COMPRA</strong></a>
                        </td>
                    </tr>
                    @endif

                    </tbody>
                </table>

            </div>

        </div>

    </section>
@stop