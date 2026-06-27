@extends('layouts.admin')
@section('title', 'Edit Product Category')

@section('content')
<div class="max-w-xl">
    <div class="mb-6"><a href="{{ route('admin.product-categories.index') }}" class="text-sm text-secondary/50 hover:text-secondary/70">← Back</a></div>
    <div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-6">
        <h2 class="font-bold text-secondary text-lg mb-6">Edit: {{ $productCategory->name }}</h2>
        <form action="{{ route('admin.product-categories.update', $productCategory) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="label">Name *</label>
                <input type="text" name="name" value="{{ old('name', $productCategory->name) }}" class="input-field" required>
            </div>
            <div>
                <label class="label">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description', $productCategory->description) }}</textarea>
            </div>
            <div>
                <label class="label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $productCategory->sort_order) }}" class="input-field">
            </div>
            <div>
                <label class="label">Image</label>
                @if($productCategory->image) <img src="{{ asset('storage/' . $productCategory->image) }}" class="w-20 h-20 object-cover rounded-xl mb-2"> @endif
                <input type="file" name="image" accept="image/*" class="input-field text-sm">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $productCategory->is_active)) class="rounded">
                <label for="is_active" class="text-sm text-secondary/70">Active</label>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary text-sm">Save Changes</button>
                <a href="{{ route('admin.product-categories.index') }}" class="btn-secondary text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
