@extends('layouts.admin')
@section('title', 'Vendor Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900">Vendor Categories</h2>
    <a href="{{ route('admin.vendor-categories.create') }}" class="btn-primary text-sm py-2.5">+ New Category</a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Vendors</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Order</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categories as $cat)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" class="w-9 h-9 rounded-xl object-cover" alt="">
                        @else
                            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-lg">{{ $cat->icon ?? '📁' }}</div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $cat->name }}</p>
                            <p class="text-xs text-gray-400">{{ $cat->slug }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-600">{{ $cat->vendors_count }}</td>
                <td class="px-5 py-4"><span class="{{ $cat->is_active ? 'badge-green' : 'badge-gray' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-5 py-4 text-gray-500">{{ $cat->sort_order }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.vendor-categories.edit', $cat) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                        <form action="{{ route('admin.vendor-categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-gray-400 hover:text-red-600 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-gray-400">No categories yet</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">{{ $categories->links() }}</div>
</div>
@endsection
