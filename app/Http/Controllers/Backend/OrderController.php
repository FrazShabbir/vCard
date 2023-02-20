<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('backend.orders.index')
            ->with('orders', $orders);
    }
}
