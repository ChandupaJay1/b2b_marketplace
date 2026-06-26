@extends('layouts.admin')
@section('title', 'Vendor Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900">All Vendors</h2>
    <a href="{{ route('admin.vendors.create') }}" class="btn-primary text-sm py-2.5">+ Add Vendor</a>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-40">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field text-sm" placeholder="Company name...">
        </div>
        <div class="w-44">
            <label class="label">Status</label>
            <select name="status" class="input-field text-sm">
                <option value="">All Status</option>
                @foreach(['pending','approved','rejected','suspended'] as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
        <a href="{{ route('admin.vendors.index') }}" class="btn-secondary text-sm py-2.5 px-5">Reset</a>
    </form>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Vendor</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Country</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($vendors as $vendor)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4">
                    <div>
                        <p class="font-medium text-gray-900">{{ $vendor->company_name }}</p>
                        <p class="text-xs text-gray-500">{{ $vendor->email }}</p>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-600 text-xs">{{ $vendor->category?->name }}</td>
                <td class="px-5 py-4 text-gray-600 text-xs">{{ $vendor->country }}</td>
                <td class="px-5 py-4">
                    <span class="badge text-xs
                        @if($vendor->status === 'approved') badge-green
                        @elseif($vendor->status === 'pending') badge-yellow
                        @elseif($vendor->status === 'rejected') badge-red
                        @else badge-gray @endif">
                        {{ ucfirst($vendor->status) }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-3 flex-wrap">
                        <a href="{{ route('admin.vendors.show', $vendor) }}" class="text-xs text-gray-600 hover:text-gray-900 font-medium">View</a>
                        <a href="{{ route('admin.vendors.edit', $vendor) }}" class="text-xs text-green-600 hover:text-blue-800 font-medium">Edit</a>
                        @if($vendor->status !== 'approved')
                        <form action="{{ route('admin.vendors.status', $vendor) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="text-xs text-green-600 hover:text-green-800 font-medium">Approve</button>
                        </form>
                        @endif
                        @if($vendor->status === 'approved')
                        <form action="{{ route('admin.vendors.status', $vendor) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="suspended">
                            <button type="submit" class="text-xs text-orange-600 hover:text-orange-800 font-medium">Suspend</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.vendors.destroy', $vendor) }}" method="POST" onsubmit="return confirm('Delete this vendor?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-gray-400 hover:text-red-600 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-gray-400">No vendors found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-gray-100">{{ $vendors->withQueryString()->links() }}</div>
</div>
@endsection
