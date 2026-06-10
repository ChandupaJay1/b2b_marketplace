<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('company_name', 'like', '%' . $request->search . '%');
        }

        $vendors = $query->latest()->paginate(15);

        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $categories = VendorCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.vendors.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_category_id' => ['required', 'exists:vendor_categories,id'],
            'company_name'       => ['required', 'string', 'max:255'],
            'email'              => ['required', 'email'],
            'website'            => ['nullable', 'url', 'max:255'],
            'logo'               => ['nullable', 'image', 'max:2048'],
            'banner'             => ['nullable', 'image', 'max:4096'],
        ]);

        $data = $request->except(['_token', 'logo', 'banner']);
        $data['slug']        = Str::slug($request->company_name);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('vendors/logos', 'public');
        }
        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('vendors/banners', 'public');
        }

        Vendor::create($data);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor created successfully!');
    }

    public function show(Vendor $vendor)
    {
        $vendor->load(['category', 'products']);
        return view('admin.vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        $categories = VendorCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.vendors.edit', compact('vendor', 'categories'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_category_id' => ['required', 'exists:vendor_categories,id'],
            'company_name'       => ['required', 'string', 'max:255'],
            'email'              => ['required', 'email'],
            'website'            => ['nullable', 'url', 'max:255'],
            'logo'               => ['nullable', 'image', 'max:2048'],
            'banner'             => ['nullable', 'image', 'max:4096'],
        ]);

        $data = $request->except(['_token', '_method', 'logo', 'banner']);
        $data['slug']        = Str::slug($request->company_name);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('logo')) {
            if ($vendor->logo) Storage::disk('public')->delete($vendor->logo);
            $data['logo'] = $request->file('logo')->store('vendors/logos', 'public');
        }
        if ($request->hasFile('banner')) {
            if ($vendor->banner) Storage::disk('public')->delete($vendor->banner);
            $data['banner'] = $request->file('banner')->store('vendors/banners', 'public');
        }

        $vendor->update($data);

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        if ($vendor->logo) Storage::disk('public')->delete($vendor->logo);
        if ($vendor->banner) Storage::disk('public')->delete($vendor->banner);
        $vendor->delete();

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor deleted!');
    }

    public function updateStatus(Request $request, Vendor $vendor)
    {
        $request->validate(['status' => ['required', 'in:pending,approved,rejected,suspended']]);
        $vendor->update(['status' => $request->status]);

        return back()->with('success', 'Vendor status updated to ' . ucfirst($request->status) . '.');
    }
}
