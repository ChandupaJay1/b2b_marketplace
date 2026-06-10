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
}
