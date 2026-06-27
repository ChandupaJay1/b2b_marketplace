@extends('layouts.admin')
@section('title', 'Vendor Management')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-secondary">All Vendors</h2>
    <a href="{{ route('admin.vendors.create') }}" class="btn-primary text-sm py-2.5">+ Add Vendor</a>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-4 mb-5">
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

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Vendor</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Country</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($vendors as $vendor)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4">
                    <div>
                        <p class="font-medium text-secondary">{{ $vendor->company_name }}</p>
                        <p class="text-xs text-secondary/50">{{ $vendor->email }}</p>
                    </div>
                </td>
                <td class="px-5 py-4 text-secondary/60 text-xs">{{ $vendor->category?->name }}</td>
                <td class="px-5 py-4 text-secondary/60 text-xs">{{ $vendor->country }}</td>
                <td class="px-5 py-4">
                    <span class="badge text-xs
                        @if($vendor->status === 'approved') badge-success
                        @elseif($vendor->status === 'pending') badge-yellow
                        @elseif($vendor->status === 'rejected') badge-red
                        @else badge-gray @endif">
                        {{ ucfirst($vendor->status) }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-3 flex-wrap">
                        <a href="{{ route('admin.vendors.show', $vendor) }}" class="text-xs text-secondary/60 hover:text-secondary font-medium">View</a>
                        <a href="{{ route('admin.vendors.edit', $vendor) }}" class="text-xs text-primary hover:text-blue-800 font-medium">Edit</a>
                        @if($vendor->status !== 'approved')
                        <form action="{{ route('admin.vendors.status', $vendor) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="text-xs text-primary hover:text-primary-dark font-medium">Approve</button>
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
                            <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-10 text-center text-secondary/50">No vendors found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $vendors->withQueryString()->links() }}</div>
</div>
@endsection
