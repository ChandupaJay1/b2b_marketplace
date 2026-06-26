<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::where('status', 'approved')->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('search')) {
            $query->where('company_name', 'like', '%' . $request->search . '%');
        }

        $vendors    = $query->withCount('products')->paginate(12);
        $categories = VendorCategory::where('is_active', true)->withCount('vendors')->get();
        $countries  = Vendor::where('status', 'approved')->distinct()->pluck('country')->filter()->sort()->values();

        return view('vendors.index', compact('vendors', 'categories', 'countries'));
    }

    public function show(string $slug)
    {
        $vendor   = Vendor::where('slug', $slug)->where('status', 'approved')->with(['category', 'products.category'])->firstOrFail();
        $products = $vendor->products()->where('is_active', true)->with('category')->paginate(12);

        return view('vendors.show', compact('vendor', 'products'));
    }

    /**
     * Get all active products for a vendor (AJAX — for RFQ form)
     */
    public function getProducts(Vendor $vendor)
    {
        $products = $vendor->allProducts()
            ->where('products.is_active', true)
            ->get()
            ->map(fn($p) => [
                'id'   => $p->id,
                'name' => $p->name,
                'sku'  => $p->sku,
            ]);

        return response()->json(['products' => $products]);
    }

    /**
     * Get product categories for a specific vendor (AJAX)
     */
    public function getCategories(Vendor $vendor)
    {
        // Get unique product categories from ALL vendor's products (both owned and through pivot table)
        $ownedProducts = $vendor->products()->with('category')->get();
        $sharedProducts = $vendor->allProducts()->with('category')->get();
        
        // Merge both collections
        $allProducts = $ownedProducts->merge($sharedProducts);
        
        // Extract unique categories
        $categories = $allProducts
            ->pluck('category')
            ->unique('id')
            ->filter() // Remove null values
            ->values()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug
                ];
            });

        return response()->json([
            'success' => true,
            'vendor_id' => $vendor->id,
            'vendor_name' => $vendor->company_name,
            'categories' => $categories,
            'total_products' => $allProducts->count()
        ]);
    }
}
