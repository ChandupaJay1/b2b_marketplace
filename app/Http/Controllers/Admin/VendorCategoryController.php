<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorCategoryController extends Controller
{
    public function index()
    {
        $categories = VendorCategory::withCount('vendors')->orderBy('sort_order')->paginate(15);
        return view('admin.vendor-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.vendor-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon'        => ['nullable', 'string', 'max:100'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vendor-categories', 'public');
        }

        VendorCategory::create($data);

        return redirect()->route('admin.vendor-categories.index')->with('success', 'Vendor category created!');
    }

    public function edit(VendorCategory $vendorCategory)
    {
        return view('admin.vendor-categories.edit', compact('vendorCategory'));
    }

    public function update(Request $request, VendorCategory $vendorCategory)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon'        => ['nullable', 'string', 'max:100'],
            'image'       => ['nullable', 'image', 'max:2048'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($vendorCategory->image) {
                Storage::disk('public')->delete($vendorCategory->image);
            }
            $data['image'] = $request->file('image')->store('vendor-categories', 'public');
        }

        $vendorCategory->update($data);

        return redirect()->route('admin.vendor-categories.index')->with('success', 'Vendor category updated!');
    }

    public function destroy(VendorCategory $vendorCategory)
    {
        if ($vendorCategory->image) {
            Storage::disk('public')->delete($vendorCategory->image);
        }

        $vendorCategory->delete();

        return redirect()->route('admin.vendor-categories.index')->with('success', 'Vendor category deleted!');
    }
}
