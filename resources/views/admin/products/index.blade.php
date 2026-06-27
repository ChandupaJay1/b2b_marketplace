@extends('layouts.admin')
@section('title', 'Product Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">All Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn-primary text-sm py-2.5">+ Add Product</a>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-40">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field text-sm" placeholder="Product name...">
        </div>
        <div class="w-44">
            <label class="label">Category</label>
            <select name="category" class="input-field text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-44">
            <label class="label">Vendor</label>
            <select name="vendor" class="input-field text-sm">
                <option value="">All Vendors</option>
                @foreach($vendors as $v)
                    <option value="{{ $v->id }}" @selected(request('vendor') == $v->id)>{{ $v->company_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary text-sm py-2.5 px-5">Reset</a>
    </form>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Product</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Vendor</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Price</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($products as $product)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        @if($product->main_image)
                            <img src="{{ asset('storage/' . $product->main_image) }}" class="w-9 h-9 rounded-xl object-cover">
                        @else
                            <div class="w-9 h-9 bg-surface rounded-xl flex items-center justify-center text-secondary/50">📦</div>
                        @endif
                        <div>
                            <p class="font-medium text-secondary">{{ $product->name }}</p>
                            <p class="text-xs text-secondary/50">{{ $product->sku }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $product->vendor?->company_name }}</td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $product->category?->name }}</td>
                <td class="px-5 py-4 text-secondary/70 font-medium">${{ $product->price ? number_format($product->price, 2) : '—' }}</td>
                <td class="px-5 py-4">
                    <div class="flex gap-1">
                        <span class="{{ $product->is_active ? 'badge-success' : 'badge-gray' }} text-xs">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                        @if($product->is_featured) <span class="badge-yellow text-xs">Featured</span> @endif
                    </div>
                </td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-primary hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-10 text-center text-secondary/50">No products found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $products->withQueryString()->links() }}</div>
</div>
@endsection
