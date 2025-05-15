@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Your Shopping Cart</h1>

    @if (session('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    @if (count($cart) > 0)
        <table class="table-auto w-full mb-4">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item['name'] }}</td>
                        <td class="px-4 py-2">${{ $item['price'] }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-block">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border p-1">
                                <button class="text-blue-500 ml-2">Update</button>
                            </form>
                        </td>
                        <td class="px-4 py-2">${{ $itemTotal }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove item?')">
                                @csrf
                                <button class="text-red-500">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-xl font-semibold">Total: ${{ number_format($total, 2) }}</div>

        <a href="{{ route('checkout.form') }}" class="mt-4 inline-block bg-green-500 text-white px-6 py-2 rounded">Proceed to Checkout</a>

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
