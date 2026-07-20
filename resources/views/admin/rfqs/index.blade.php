@extends('layouts.admin')
@section('title', 'RFQ Management')

@section('content')
<div class="mb-6">
    <h2 class="text-lg font-bold text-secondary">Request for Quotations</h2>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm p-4 mb-5">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-40">
            <label class="label">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="input-field text-sm" placeholder="Name or email...">
        </div>
        <div class="w-40">
            <label class="label">Status</label>
            <select name="status" class="input-field text-sm">
                <option value="">All</option>
                @foreach(['new','reviewed','responded','closed'] as $s)
                    <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-primary text-sm py-2.5 px-5">Filter</button>
    </form>
</div>

<div class="bg-white rounded-xl border border-secondary/5 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-surface border-b border-secondary/5">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Buyer</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Product/Vendor</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Country</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-semibold text-secondary/50 uppercase">Date</th>
                <th class="px-5 py-3.5 text-right text-xs font-semibold text-secondary/50 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-secondary/5">
            @forelse($rfqs as $rfq)
            <tr class="hover:bg-surface">
                <td class="px-5 py-4">
                    <p class="font-medium text-secondary">{{ $rfq->name }}</p>
                    <p class="text-xs text-secondary/50">{{ $rfq->email }}</p>
                    @if($rfq->company) <p class="text-xs text-secondary/50">{{ $rfq->company }}</p> @endif
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">
                    @if($rfq->product) <p>📦 {{ $rfq->product->name }}</p> @endif
                    @if($rfq->vendor) <p>🏭 {{ $rfq->vendor->company_name }}</p> @endif
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $rfq->country }}</td>
                <td class="px-5 py-4">
                    <span class="badge text-xs
                        @if($rfq->status === 'new') badge-primary
                        @elseif($rfq->status === 'reviewed') badge-yellow
                        @elseif($rfq->status === 'responded') badge-success
                        @else badge-gray @endif">{{ ucfirst($rfq->status) }}</span>
                </td>
                <td class="px-5 py-4 text-secondary/50 text-xs">{{ $rfq->created_at->format('M d, Y') }}</td>
                <td class="px-5 py-4 text-right">
                    <a href="{{ route('admin.rfqs.show', $rfq) }}" class="text-xs text-primary hover:text-primary-dark font-medium mr-3">View</a>
                    <form action="{{ route('admin.rfqs.destroy', $rfq) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-secondary/50 hover:text-red-600 font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-10 text-center text-secondary/50">No RFQs found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-secondary/5">{{ $rfqs->withQueryString()->links() }}</div>
</div>
@endsection
