<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['vendor', 'category', 'subcategory']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('subcategory')) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $request->subcategory));
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('short_description', 'like', '%' . $request->search . '%');
        }

        $products       = $query->paginate(12);
        $categories     = ProductCategory::where('is_active', true)->with('subcategories')->get();
        $subcategories  = ProductSubcategory::where('is_active', true)->get();

        return view('products.index', compact('products', 'categories', 'subcategories'));
    }

    public function show(string $slug)
    {
        $product  = Product::where('slug', $slug)->where('is_active', true)
                           ->with(['vendor', 'category', 'subcategory', 'images'])
                           ->firstOrFail();

        $product->increment('views');

        $related = Product::where('product_category_id', $product->product_category_id)
                          ->where('id', '!=', $product->id)
                          ->where('is_active', true)
                          ->take(4)->get();

        return view('products.show', compact('product', 'related'));
    }
}
