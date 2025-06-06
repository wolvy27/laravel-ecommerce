@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    @php
    $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
    @endphp

    <a href="{{ route('cart.index') }}" class="text-blue bg-blue-600 px-3 py-1 rounded hover:bg-blue-700">
        Cart ({{ $cartCount }})
    </a>

    <h1 class="text-2xl font-bold mb-4">Product List</h1>
    @if(auth()->user()->role === 'admin')
    <div class="flex gap-4 mb-4">
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-blue px-4 py-2 rounded hover:bg-blue-600">
            Add Product
        </a>
        <a href="{{ route('admin.orders') }}" class="bg-indigo-500 text-blue px-4 py-2 rounded hover:bg-indigo-600">
            View Orders
        </a>
    </div>
    @endif


    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->category }}</td>
                <td class="px-4 py-2">${{ $product->price }}</td>
                <td class="px-4 py-2">{{ $product->stock_quantity }}</td>
                <td class="px-4 py-2">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 mr-2">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    @endif
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
