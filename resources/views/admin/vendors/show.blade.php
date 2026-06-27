@extends('layouts.admin')
@section('title', $vendor->company_name)

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.vendors.index') }}" class="text-sm text-secondary/50 hover:text-secondary/70">← Back to Vendors</a>
    <div class="flex gap-2">
        <a href="{{ route('admin.vendors.edit', $vendor) }}" class="btn-primary text-sm py-2">Edit Vendor</a>
        @if($vendor->status !== 'approved')
        <form action="{{ route('admin.vendors.status', $vendor) }}" method="POST" class="inline">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="approved">
            <button type="submit" class="btn-success text-sm py-2">Approve</button>
        </form>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Main info --}}
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
            @if($vendor->banner)
                <img src="{{ asset('storage/' . $vendor->banner) }}" class="w-full h-36 object-cover">
            @endif
            <div class="p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 border">
                        @if($vendor->logo)
                            <img src="{{ asset('storage/' . $vendor->logo) }}" class="w-14 h-14 object-contain rounded-xl">
                        @else
                            <span class="text-2xl font-bold text-primary-dark">{{ strtoupper(substr($vendor->company_name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-secondary">{{ $vendor->company_name }}</h2>
                        <div class="flex flex-wrap gap-2 mt-1">
                            <span class="badge text-xs
                                @if($vendor->status === 'approved') badge-success
                                @elseif($vendor->status === 'pending') badge-yellow
                                @elseif($vendor->status === 'rejected') badge-red
                                @else badge-gray @endif">
                                {{ ucfirst($vendor->status) }}
                            </span>
                            @if($vendor->is_featured) <span class="badge-yellow text-xs">⭐ Featured</span> @endif
                            <span class="badge-primary text-xs">{{ $vendor->category?->name }}</span>
                        </div>
                    </div>
                </div>
                @if($vendor->description)
                    <p class="text-secondary/60 text-sm leading-relaxed">{{ $vendor->description }}</p>
                @endif
            </div>
        </div>

        {{-- Products --}}
        <div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-secondary/5 flex justify-between items-center">
                <h3 class="font-bold text-secondary">Products ({{ $vendor->products->count() }})</h3>
                <a href="{{ route('admin.products.create') }}?vendor={{ $vendor->id }}" class="text-xs text-primary hover:underline">+ Add Product</a>
            </div>
            @forelse($vendor->products->take(8) as $product)
            <div class="px-5 py-3 border-b border-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" class="w-9 h-9 rounded-xl object-cover">
                    @else
                        <div class="w-9 h-9 bg-surface rounded-xl flex items-center justify-center text-secondary/50 text-sm">📦</div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-secondary">{{ $product->name }}</p>
                        <p class="text-xs text-secondary/50">{{ $product->category?->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @if($product->price) <span class="text-sm font-medium text-primary-dark">${{ number_format($product->price, 2) }}</span> @endif
                    <span class="{{ $product->is_active ? 'badge-success' : 'badge-gray' }} text-xs">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-secondary/50 hover:text-primary">Edit</a>
                </div>
            </div>
            @empty
            <p class="p-5 text-sm text-secondary/50 text-center">No products yet. <a href="{{ route('admin.products.create') }}" class="text-primary hover:underline">Add the first product</a>.</p>
            @endforelse
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-5">
            <h3 class="font-bold text-secondary mb-4">Vendor Details</h3>
            <dl class="space-y-3 text-sm">
                @foreach([
                    ['Category',    $vendor->category?->name, false],
                    ['Email',       $vendor->email,           false],
                    ['Phone',       $vendor->phone,           false],
                    ['Website',     $vendor->website,         true],
                    ['Country',     $vendor->country,         false],
                    ['City',        $vendor->city,            false],
                    ['State',       $vendor->state,           false],
                    ['Postal Code', $vendor->postal_code,     false],
                    ['Address',     $vendor->address,         false],
                    ['Est. Year',   $vendor->established_year, false],
                    ['Employees',   $vendor->employees_count ? $vendor->employees_count . '+' : null, false],
                    ['Certifications', $vendor->certifications, false],
                ] as [$k, $v, $isLink])
                @if($v)
                <div>
                    <dt class="text-secondary/50 text-xs">{{ $k }}</dt>
                    <dd class="font-medium text-secondary mt-0.5">
                        @if($isLink)
                            <a href="{{ $v }}" target="_blank" rel="noopener" class="text-primary hover:underline break-all">{{ $v }}</a>
                        @else
                            {{ $v }}
                        @endif
                    </dd>
                </div>
                @endif
                @endforeach
            </dl>
        </div>

        <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-5">
            <h3 class="font-bold text-secondary mb-3">Update Status</h3>
            <form action="{{ route('admin.vendors.status', $vendor) }}" method="POST" class="space-y-3">
                @csrf @method('PATCH')
                <select name="status" class="input-field text-sm">
                    @foreach(['pending','approved','rejected','suspended'] as $s)
                        <option value="{{ $s }}" @selected($vendor->status == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary text-sm w-full justify-center">Update Status</button>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-5">
            <h3 class="font-bold text-secondary mb-3">Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('vendors.show', $vendor->slug) }}" target="_blank" class="flex items-center gap-2 text-sm text-primary hover:underline">
                    🌐 View on Website
                </a>
                <form action="{{ route('admin.vendors.destroy', $vendor) }}" method="POST" onsubmit="return confirm('Delete {{ $vendor->company_name }}? This will also delete all associated products.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">🗑 Delete Vendor</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
