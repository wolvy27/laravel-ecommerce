@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    @if ($errors->any())
        <div class="text-red-500 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Your Name" class="w-full border p-2" required>
        <input type="email" name="email" placeholder="Email" class="w-full border p-2" required>
        <textarea name="address" placeholder="Address" class="w-full border p-2" required></textarea>
        <select name="payment_type" class="w-full border p-2" required>
            <option value="">Select Payment Type</option>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="PayPal">PayPal</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Place Order</button>
    </form>
</div>
@endsection
