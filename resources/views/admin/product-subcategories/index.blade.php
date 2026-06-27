@extends('layouts.admin')
@section('title', 'Product Subcategories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">Product Subcategories</h2>
    <a href="{{ route('admin.product-subcategories.create') }}" class="btn-primary text-sm py-2.5">+ New Subcategory</a>
</div>
<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Subcategory</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Parent Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Products</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($subcategories as $sub)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4 font-medium text-secondary">{{ $sub->name }}</td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $sub->category?->name }}</td>
                <td class="px-5 py-4 text-secondary/50">{{ $sub->products_count }}</td>
                <td class="px-5 py-4"><span class="{{ $sub->is_active ? 'badge-success' : 'badge-gray' }}">{{ $sub->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.product-subcategories.edit', $sub) }}" class="text-xs text-primary hover:text-blue-800 font-medium mr-3">Edit</a>
                    <form action="{{ route('admin.product-subcategories.destroy', $sub) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-secondary/50">No subcategories yet</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $subcategories->links() }}</div>
</div>
@endsection
