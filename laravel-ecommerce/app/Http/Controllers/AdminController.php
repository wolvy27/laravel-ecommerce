<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function orders()
    {
        $orders = Order::with('items.product', 'user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }
}
