@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">All Orders</h1>

    @foreach($orders as $order)
        <div class="border rounded p-4 mb-4 shadow">
            <h2 class="font-semibold text-lg mb-2">Order #{{ $order->id }} – ${{ $order->total }}</h2>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment:</strong> {{ $order->payment_type }}</p>
            <p><strong>Ordered by:</strong> {{ $order->user->name ?? 'Guest' }}</p>

            <h3 class="mt-4 font-semibold">Items:</h3>
            <ul class="list-disc pl-6">
                @foreach($order->orderItems as $item)
                    <li>{{ $item->product->name ?? '[Deleted Product]' }} x{{ $item->quantity }} – ${{ $item->price }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
