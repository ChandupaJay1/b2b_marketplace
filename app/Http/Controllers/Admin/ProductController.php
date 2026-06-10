<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductImage;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['vendor', 'category']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('product_category_id', $request->category);
        }

        if ($request->filled('vendor')) {
            $query->where('vendor_id', $request->vendor);
        }

        $products   = $query->latest()->paginate(15);
        $categories = ProductCategory::all();
        $vendors    = Vendor::where('status', 'approved')->get();

        return view('admin.products.index', compact('products', 'categories', 'vendors'));
    }

    public function create()
    {
        $categories    = ProductCategory::where('is_active', true)->with('subcategories')->get();
        $subcategories = ProductSubcategory::where('is_active', true)->get();
        $vendors       = Vendor::where('status', 'approved')->get();

        return view('admin.products.create', compact('categories', 'subcategories', 'vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id'              => ['required', 'exists:vendors,id'],
            'product_category_id'    => ['required', 'exists:product_categories,id'],
            'product_subcategory_id' => ['nullable', 'exists:product_subcategories,id'],
            'name'                   => ['required', 'string', 'max:255'],
            'description'            => ['nullable', 'string'],
            'main_image'             => ['nullable', 'image', 'max:4096'],
            'images.*'               => ['nullable', 'image', 'max:4096'],
        ]);

        $data = $request->except(['_token', 'main_image', 'images']);
        $data['slug']        = Str::slug($request->name);
        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id'  => $product->id,
                    'image'       => $path,
                    'is_primary'  => $index === 0,
                    'sort_order'  => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load(['vendor', 'category', 'subcategory', 'images']);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories    = ProductCategory::where('is_active', true)->with('subcategories')->get();
        $subcategories = ProductSubcategory::where('is_active', true)->get();
        $vendors       = Vendor::where('status', 'approved')->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'vendors'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'vendor_id'              => ['required', 'exists:vendors,id'],
            'product_category_id'    => ['required', 'exists:product_categories,id'],
            'product_subcategory_id' => ['nullable', 'exists:product_subcategories,id'],
            'name'                   => ['required', 'string', 'max:255'],
            'main_image'             => ['nullable', 'image', 'max:4096'],
            'images.*'               => ['nullable', 'image', 'max:4096'],
        ]);

        $data = $request->except(['_token', '_method', 'main_image', 'images']);
        $data['slug']        = Str::slug($request->name);
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('main_image')) {
            if ($product->main_image) Storage::disk('public')->delete($product->main_image);
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'sort_order' => $product->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->main_image) Storage::disk('public')->delete($product->main_image);

        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}
