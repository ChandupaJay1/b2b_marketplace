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
        $categories    = ProductCategory::where('is_active', true)
                            ->with(['subcategories'])
                            ->withCount(['products' => fn($q) => $q->where('is_active', true)])
                            ->having('products_count', '>', 0)
                            ->orderBy('sort_order')
                            ->get();

        $subcategories = ProductSubcategory::where('is_active', true)->get();

        // If a specific category or search is active → flat filtered view
        $filterActive = $request->hasAny(['search', 'category', 'subcategory']);

        if ($filterActive) {
            $query = Product::where('is_active', true)->with(['vendor', 'category', 'subcategory']);

            if ($request->filled('category')) {
                $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
            }
            if ($request->filled('subcategory')) {
                $query->whereHas('subcategory', fn($q) => $q->where('slug', $request->subcategory));
            }
            if ($request->filled('search')) {
                $term = $request->search;
                $query->where(fn($q) => $q->where('name', 'like', "%$term%")
                                          ->orWhere('short_description', 'like', "%$term%"));
            }

            $products = $query->paginate(16);

            return view('products.index', compact('products', 'categories', 'subcategories', 'filterActive'));
        }

        // Default → category-wise view, load limited products per category
        foreach ($categories as $cat) {
            $cat->setRelation('featuredProducts',
                Product::where('product_category_id', $cat->id)
                       ->where('is_active', true)
                       ->with(['vendor'])
                       ->orderByDesc('is_featured')
                       ->take(8)
                       ->get()
            );
        }

        $products = collect(); // empty for the view check

        return view('products.index', compact('products', 'categories', 'subcategories', 'filterActive'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)
                          ->with([
                              'category',
                              'subcategory',
                              'images',
                            'vendors' => fn($q) => $q->wherePivot('is_active', true)
                                                        ->orderByPivot('is_primary', 'desc'),
                          ])
                          ->firstOrFail();

        $product->increment('views');

        $related = Product::where('product_category_id', $product->product_category_id)
                          ->where('id', '!=', $product->id)
                          ->where('is_active', true)
                          ->take(4)->get();

        return view('products.show', compact('product', 'related'));
    }
}
