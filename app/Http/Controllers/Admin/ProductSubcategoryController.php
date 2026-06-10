<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = ProductSubcategory::with('category')->withCount('products')->orderBy('sort_order')->paginate(15);
        return view('admin.product-subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.product-subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name'                => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'image'               => ['nullable', 'image', 'max:2048'],
            'sort_order'          => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product-subcategories', 'public');
        }

        ProductSubcategory::create($data);

        return redirect()->route('admin.product-subcategories.index')->with('success', 'Subcategory created!');
    }

    public function edit(ProductSubcategory $productSubcategory)
    {
        $categories = ProductCategory::where('is_active', true)->get();
        return view('admin.product-subcategories.edit', compact('productSubcategory', 'categories'));
    }

    public function update(Request $request, ProductSubcategory $productSubcategory)
    {
        $request->validate([
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name'                => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'image'               => ['nullable', 'image', 'max:2048'],
            'sort_order'          => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($productSubcategory->image) Storage::disk('public')->delete($productSubcategory->image);
            $data['image'] = $request->file('image')->store('product-subcategories', 'public');
        }

        $productSubcategory->update($data);

        return redirect()->route('admin.product-subcategories.index')->with('success', 'Subcategory updated!');
    }

    public function destroy(ProductSubcategory $productSubcategory)
    {
        if ($productSubcategory->image) Storage::disk('public')->delete($productSubcategory->image);
        $productSubcategory->delete();

        return redirect()->route('admin.product-subcategories.index')->with('success', 'Subcategory deleted!');
    }
}
