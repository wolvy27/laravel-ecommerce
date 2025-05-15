<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // List all products — allow authenticated users to view
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show form to create a product — admin only
    public function create()
    {
        $this->authorizeAdmin();

        return view('products.create');
    }

    // Store new product — admin only
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description', 'price', 'stock_quantity']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show edit form — admin only
    public function edit(Product $product)
    {
        $this->authorizeAdmin();

        return view('products.edit', compact('product'));
    }

    // Update product — admin only
    public function update(Request $request, Product $product)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description', 'price', 'stock_quantity']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product — admin only
    public function destroy(Product $product)
    {
        $this->authorizeAdmin();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // Helper function to check admin role
    private function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
