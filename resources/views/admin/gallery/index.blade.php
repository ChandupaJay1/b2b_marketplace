@extends('layouts.admin')
@section('title', 'Gallery Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900">Gallery Images</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary text-sm py-2.5">+ Add Image</a>
</div>

{{-- Filters --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-40">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field text-sm" placeholder="Image title...">
        </div>
        <div class="w-48">
            <label class="label">Category</label>
            <select name="category" class="input-field text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn-secondary text-sm py-2.5 px-5">Reset</a>
    </form>
</div>

{{-- Grid --}}
@if($items->count())
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @foreach($items as $item)
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden group">
        <div class="relative aspect-square overflow-hidden bg-gray-50">
            <img src="{{ asset('storage/' . $item->image) }}"
                 alt="{{ $item->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            {{-- Status badge --}}
            <div class="absolute top-2 left-2">
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $item->is_active ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                    {{ $item->is_active ? 'Active' : 'Hidden' }}
                </span>
            </div>
            {{-- Actions overlay --}}
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                <a href="{{ route('admin.gallery.edit', $item) }}"
                   class="w-9 h-9 bg-white rounded-lg flex items-center justify-center text-gray-700 hover:bg-green-600 hover:text-white transition-colors shadow-md"
                   title="Edit">
                    <i class="fas fa-pen text-xs"></i>
                </a>
                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Delete this image permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-9 h-9 bg-white rounded-lg flex items-center justify-center text-gray-700 hover:bg-red-600 hover:text-white transition-colors shadow-md"
                            title="Delete">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="p-3">
            <p class="font-semibold text-gray-900 text-xs truncate">{{ $item->title }}</p>
            @if($item->category)
            <p class="text-[10px] text-green-600 font-medium mt-0.5">{{ $item->category }}</p>
            @endif
            <p class="text-[10px] text-gray-400 mt-0.5">Order: {{ $item->sort_order }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $items->withQueryString()->links() }}</div>
@else
<div class="bg-white rounded-xl border border-gray-100 shadow-sm py-20 text-center">
    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-images text-gray-400 text-2xl"></i>
    </div>
    <p class="text-gray-500 font-medium text-sm">No gallery images yet</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary text-sm py-2 px-5 mt-4 inline-block">Add First Image</a>
</div>
@endif

@endsection
