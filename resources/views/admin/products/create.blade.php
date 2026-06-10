@extends('layouts.admin')
@section('title', 'Add Product')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a></div>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h2 class="font-bold text-gray-900 text-lg mb-6">Add New Product</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="label">Vendor *</label>
                    <select name="vendor_id" class="input-field" required>
                        <option value="">Select Vendor</option>
                        @foreach($vendors as $v)
                            <option value="{{ $v->id }}" @selected(old('vendor_id') == $v->id)>{{ $v->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Category *</label>
                    <select name="product_category_id" class="input-field" required id="category-sel">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('product_category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">Subcategory</label>
                    <select name="product_subcategory_id" class="input-field">
                        <option value="">Select Subcategory</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" @selected(old('product_subcategory_id') == $sub->id)>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="label">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" class="input-field">
                </div>
                <div class="sm:col-span-2">
                    <label class="label">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-field" required>
                </div>
                <div>
                    <label class="label">Price (USD)</label>
                    <input type="number" name="price" value="{{ old('price') }}" class="input-field" step="0.01" min="0">
                </div>
                <div>
                    <label class="label">Min. Order Quantity</label>
                    <input type="number" name="min_order_quantity" value="{{ old('min_order_quantity', 1) }}" class="input-field" min="1">
                </div>
                <div>
                    <label class="label">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', 'piece') }}" class="input-field" placeholder="kg, piece, liter...">
                </div>
                <div>
                    <label class="label">Country of Origin</label>
                    <input type="text" name="origin_country" value="{{ old('origin_country') }}" class="input-field">
                </div>
            </div>
            <div>
                <label class="label">Short Description</label>
                <textarea name="short_description" rows="2" class="input-field resize-none">{{ old('short_description') }}</textarea>
            </div>
            <div>
                <label class="label">Full Description</label>
                <textarea name="description" rows="5" class="input-field resize-none">{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="label">Main Image</label>
                    <input type="file" name="main_image" accept="image/*" class="input-field text-sm">
                </div>
                <div>
                    <label class="label">Gallery Images (multiple)</label>
                    <input type="file" name="images[]" accept="image/*" multiple class="input-field text-sm">
                </div>
            </div>

            {{-- Additional Vendors Section --}}
            <div class="border-t pt-5 mt-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900">Additional Vendors (Optional)</h3>
                    <button type="button" onclick="addVendorRow()" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        + Add Vendor
                    </button>
                </div>
                <p class="text-xs text-gray-500 mb-4">Add other vendors who sell this product. You can set different pricing for each vendor.</p>
                
                <div id="vendors-container" class="space-y-3">
                    {{-- Vendor rows will be added here dynamically --}}
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', true)) class="rounded">
                    <label for="is_active" class="text-sm text-gray-700">Active</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured')) class="rounded">
                    <label for="is_featured" class="text-sm text-gray-700">Featured</label>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-sm">Create Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
let vendorRowIndex = 0;

function addVendorRow() {
    const container = document.getElementById('vendors-container');
    const row = document.createElement('div');
    row.className = 'grid grid-cols-12 gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200';
    row.id = `vendor-row-${vendorRowIndex}`;
    
    row.innerHTML = `
        <div class="col-span-12 sm:col-span-4">
            <label class="text-xs text-gray-600 font-medium">Vendor</label>
            <select name="additional_vendors[]" class="input-field text-sm mt-1" required>
                <option value="">Select Vendor</option>
                @foreach($vendors as $v)
                    <option value="{{ $v->id }}">{{ $v->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label class="text-xs text-gray-600 font-medium">Price (USD)</label>
            <input type="number" name="vendor_prices[]" step="0.01" min="0" class="input-field text-sm mt-1" placeholder="0.00">
        </div>
        <div class="col-span-6 sm:col-span-2">
            <label class="text-xs text-gray-600 font-medium">MOQ</label>
            <input type="number" name="vendor_moqs[]" min="1" value="1" class="input-field text-sm mt-1">
        </div>
        <div class="col-span-10 sm:col-span-2">
            <label class="text-xs text-gray-600 font-medium">SKU</label>
            <input type="text" name="vendor_skus[]" class="input-field text-sm mt-1" placeholder="SKU">
        </div>
        <div class="col-span-2 sm:col-span-1 flex items-end">
            <button type="button" onclick="removeVendorRow(${vendorRowIndex})" class="w-full sm:w-auto px-3 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                <i class="fas fa-trash text-sm"></i>
            </button>
        </div>
    `;
    
    container.appendChild(row);
    vendorRowIndex++;
}

function removeVendorRow(index) {
    const row = document.getElementById(`vendor-row-${index}`);
    if (row) row.remove();
}
</script>
@endsection
