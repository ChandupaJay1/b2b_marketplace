@extends('layouts.admin')
@section('title', 'Product Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">Product Categories</h2>
    <a href="{{ route('admin.product-categories.create') }}" class="btn-primary text-sm py-2.5">+ New Category</a>
</div>
<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Subcategories</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Products</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($categories as $cat)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4 font-medium text-secondary">{{ $cat->name }}</td>
                <td class="px-5 py-4 text-secondary/50">{{ $cat->subcategories_count }}</td>
                <td class="px-5 py-4 text-secondary/50">{{ $cat->products_count }}</td>
                <td class="px-5 py-4"><span class="{{ $cat->is_active ? 'badge-success' : 'badge-gray' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.product-categories.edit', $cat) }}" class="text-xs text-primary hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.product-categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-secondary/50">No categories yet</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $categories->links() }}</div>
</div>
@endsection
