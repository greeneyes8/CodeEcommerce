@extends('app')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Itens</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            {!! \Form::model($order, ['method' => 'PUT', 'url' => route('orders.update', [$order->id])]) !!}
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    <ul>
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($order->total, 2, ',', '.') }}</td>
                <td>
                    {!! Form::select('stat_id', $stats, $order->stat_id, ['class' => 'form-control']) !!}
                </td>
                <td>
                    {!! Form::submit('Atualizar Status', ['class' => 'btn btn-sm btn-primary', 'style' => 'margin-top: 0;']) !!}
                </td>
            </tr>
            {!! \Form::close() !!}
            @endforeach
            </tbody>
        </table>
    </div>

    {!! $orders->render() !!}
@stop