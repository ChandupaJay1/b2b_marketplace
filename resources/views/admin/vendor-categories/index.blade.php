@extends('layouts.admin')
@section('title', 'Vendor Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">Vendor Categories</h2>
    <a href="{{ route('admin.vendor-categories.create') }}" class="btn-primary text-sm py-2.5">+ New Category</a>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Vendors</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Order</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($categories as $cat)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" class="w-9 h-9 rounded-xl object-cover" alt="">
                        @else
                            <div class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center text-lg">{{ $cat->icon ?? '📁' }}</div>
                        @endif
                        <div>
                            <p class="font-medium text-secondary">{{ $cat->name }}</p>
                            <p class="text-xs text-secondary/50">{{ $cat->slug }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-secondary/60">{{ $cat->vendors_count }}</td>
                <td class="px-5 py-4"><span class="{{ $cat->is_active ? 'badge-success' : 'badge-gray' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-5 py-4 text-secondary/50">{{ $cat->sort_order }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.vendor-categories.edit', $cat) }}" class="text-xs text-primary hover:text-primary-dark font-medium">Edit</a>
                        <form action="{{ route('admin.vendor-categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                        </form>
                    </div>
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
