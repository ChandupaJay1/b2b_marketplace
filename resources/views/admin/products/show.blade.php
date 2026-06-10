@extends('layouts.admin')
@section('title', $product->name)

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Products</a>
        <div class="flex gap-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn-primary text-sm py-2">Edit</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger text-sm py-2">Delete</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                @if($product->main_image)
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                @endif
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="{{ $product->is_active ? 'badge-green' : 'badge-gray' }} text-xs">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                        @if($product->is_featured) <span class="badge-yellow text-xs">⭐ Featured</span> @endif
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h2>
                    @if($product->short_description)
                        <p class="text-gray-600 mb-4">{{ $product->short_description }}</p>
                    @endif
                    @if($product->description)
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description }}</p>
                    @endif
                </div>
            </div>

            @if($product->images->count())
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-3">Gallery Images</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" class="w-20 h-20 object-cover rounded-xl border">
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-bold text-gray-900 mb-4">Product Details</h3>
                <dl class="space-y-3 text-sm">
                    @foreach([
                        ['Vendor', $product->vendor?->company_name],
                        ['Category', $product->category?->name],
                        ['Subcategory', $product->subcategory?->name],
                        ['SKU', $product->sku],
                        ['Price', $product->price ? '$' . number_format($product->price, 2) : null],
                        ['Min. Order', $product->min_order_quantity . ' ' . $product->unit],
                        ['Origin', $product->origin_country],
                        ['Views', number_format($product->views)],
                    ] as [$k, $v])
                    @if($v)
                    <div class="flex justify-between">
                        <dt class="text-gray-500">{{ $k }}</dt>
                        <dd class="font-medium text-gray-900 text-right">{{ $v }}</dd>
                    </div>
                    @endif
                    @endforeach
                </dl>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="text-blue-600 text-sm hover:underline font-medium">View on Website →</a>
            </div>
        </div>
    </div>
</div>
@endsection
