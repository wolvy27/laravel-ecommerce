@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

    @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Product Name" class="w-full border p-2" value="{{ old('name') }}">
        <input type="text" name="category" placeholder="Category" class="w-full border p-2" value="{{ old('category') }}">
        <textarea name="description" placeholder="Description" class="w-full border p-2">{{ old('description') }}</textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" class="w-full border p-2" value="{{ old('price') }}">
        <input type="number" name="stock_quantity" placeholder="Stock Quantity" class="w-full border p-2" value="{{ old('stock_quantity') }}">
        <input type="file" name="image" class="w-full border p-2">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Product</button>
    </form>
</div>
@endsection
