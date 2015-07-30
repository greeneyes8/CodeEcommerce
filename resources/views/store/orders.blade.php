@extends('store.store')

@section('content')
    <div class="container">
        <h3>Meus Pedidos</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Itens</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($order->total, 2, ',', '.') }}</td>
                <td>{{ $order->stat->name }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop