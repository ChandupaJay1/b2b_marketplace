@extends('layouts.admin')
@section('title', 'New Subcategory')

@section('content')
<div class="max-w-xl">
    <div class="mb-6"><a href="{{ route('admin.product-subcategories.index') }}" class="text-sm text-secondary/50 hover:text-secondary/70">← Back</a></div>
    <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-6">
        <h2 class="font-bold text-secondary text-lg mb-6">New Product Subcategory</h2>
        <form action="{{ route('admin.product-subcategories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label class="label">Parent Category *</label>
                <select name="product_category_id" class="input-field" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('product_category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input-field" required>
            </div>
            <div>
                <label class="label">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="input-field w-32">
            </div>
            <div>
                <label class="label">Image</label>
                <input type="file" name="image" accept="image/*" class="input-field text-sm">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', true)) class="rounded">
                <label for="is_active" class="text-sm text-secondary/70">Active</label>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-sm">Create Subcategory</button>
                <a href="{{ route('admin.product-subcategories.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
