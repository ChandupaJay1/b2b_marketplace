@extends('layouts.admin')
@section('title', 'Edit Product')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a></div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h2 class="font-bold text-gray-900 text-lg mb-6">Edit: {{ $product->name }}</h2>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="label">Vendor *</label>
                    <select name="vendor_id" class="input-field" required>
                        @foreach($vendors as $v)
                            <option value="{{ $v->id }}" @selected(old('vendor_id', $product->vendor_id) == $v->id)>{{ $v->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Category *</label>
                    <select name="product_category_id" class="input-field" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('product_category_id', $product->product_category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Subcategory</label>
                    <select name="product_subcategory_id" class="input-field">
                        <option value="">None</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" @selected(old('product_subcategory_id', $product->product_subcategory_id) == $sub->id)>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="input-field">
                </div>
                <div class="sm:col-span-2">
                    <label class="label">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input-field" required>
                </div>
                <div>
                    <label class="label">Price (USD)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="input-field" step="0.01" min="0">
                </div>
                <div>
                    <label class="label">Min. Order Quantity</label>
                    <input type="number" name="min_order_quantity" value="{{ old('min_order_quantity', $product->min_order_quantity) }}" class="input-field">
                </div>
                <div>
                    <label class="label">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" class="input-field">
                </div>
                <div>
                    <label class="label">Country of Origin</label>
                    <input type="text" name="origin_country" value="{{ old('origin_country', $product->origin_country) }}" class="input-field">
                </div>
            </div>
            <div>
                <label class="label">Short Description</label>
                <textarea name="short_description" rows="2" class="input-field resize-none">{{ old('short_description', $product->short_description) }}</textarea>
            </div>
            <div>
                <label class="label">Full Description</label>
                <textarea name="description" rows="5" class="input-field resize-none">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Main Image</label>
                    @if($product->main_image) <img src="{{ asset('storage/' . $product->main_image) }}" class="w-20 h-20 object-cover rounded-xl mb-2"> @endif
                    <input type="file" name="main_image" accept="image/*" class="input-field text-sm">
                </div>
                <div>
                    <label class="label">Add Gallery Images</label>
                    <input type="file" name="images[]" accept="image/*" multiple class="input-field text-sm">
                </div>
            </div>
            @if($product->images->count())
            <div>
                <p class="text-sm font-medium text-gray-700 mb-2">Existing Gallery</p>
                <div class="flex gap-2 flex-wrap">
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}" class="w-16 h-16 object-cover rounded-xl border">
                    @endforeach
                </div>
            </div>
            @endif
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="rounded">
                    <label for="is_active" class="text-sm text-gray-700">Active</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="rounded">
                    <label for="is_featured" class="text-sm text-gray-700">Featured</label>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-sm">Save Changes</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
