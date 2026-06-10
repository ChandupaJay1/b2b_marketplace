<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Vendor;
use App\Models\VendorCategory;

class HomeController extends Controller
{
    public function index()
    {
        $featuredVendors    = Vendor::where('status', 'approved')->where('is_featured', true)->with('category')->take(6)->get();
        $featuredProducts   = Product::where('is_active', true)->where('is_featured', true)->with(['vendor', 'category'])->take(8)->get();
        $productCategories  = ProductCategory::where('is_active', true)->withCount('products')->orderBy('sort_order')->take(8)->get();
        $vendorCategories   = VendorCategory::where('is_active', true)->withCount('vendors')->orderBy('sort_order')->take(6)->get();
        $totalVendors       = Vendor::where('status', 'approved')->count();
        $totalProducts      = Product::where('is_active', true)->count();

        return view('home', compact(
            'featuredVendors', 'featuredProducts', 'productCategories',
            'vendorCategories', 'totalVendors', 'totalProducts'
        ));
    }

    public function about()
    {
        return view('about');
    }
}
