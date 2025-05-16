<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function orders()
    {
        if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $orders = \App\Models\Order::with('orderItems.product', 'user')->get();
    return view('admin.orders.index', compact('orders'));
    }
}
