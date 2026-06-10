<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::withCount(['products', 'subcategories'])->orderBy('sort_order')->paginate(15);
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product-categories', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category created!');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($productCategory->image) Storage::disk('public')->delete($productCategory->image);
            $data['image'] = $request->file('image')->store('product-categories', 'public');
        }

        $productCategory->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category updated!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->image) Storage::disk('public')->delete($productCategory->image);
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category deleted!');
    }
}
