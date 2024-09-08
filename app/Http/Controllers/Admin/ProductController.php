<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->keyword) {
            $products = Product::search($request->keyword)
                ->latest()
                ->paginate(10);
            $products->appends(['keyword' => $request->keyword]);
        }else{
            $products = Product::latest()->paginate(10);
        }
        return view('pages.admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $priceDecimal = (int)str_replace(['Rp', '.', ' '], '', $request->price);

        $product = new Product();
        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_price = $priceDecimal;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('pages.admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product->product_name = $request->name;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->customer()->exists()) {
            return back()->with('errors', 'Product cannot be deleted because it is currently assigned customer.');
        }

        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }

    public function show(Product $product)
    {
        return view('pages.admin.product.show', compact('product'));
    }
}
