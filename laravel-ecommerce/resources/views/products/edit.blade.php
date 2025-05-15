@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

    @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $product->name }}" class="w-full border p-2">
        <input type="text" name="category" value="{{ $product->category }}" class="w-full border p-2">
        <textarea name="description" class="w-full border p-2">{{ $product->description }}</textarea>
        <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border p-2">
        <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="w-full border p-2">
        
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover mb-2" />
        @endif

        <input type="file" name="image" class="w-full border p-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Product</button>
    </form>
</div>
@endsection
