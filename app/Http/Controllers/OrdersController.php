<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\Stat;
use Illuminate\Http\Request;

class OrdersController extends Controller {

    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = $this->model->paginate(10);
        $stats  = Stat::lists('name', 'id');

        return view('orders.index', compact('orders', 'stats'));
    }

    public function update($id, Request $request)
    {
        $order = $this->model->find($id);
        $order->update($request->only(['stat_id']));

        return redirect()->route('orders.index');
    }
}
