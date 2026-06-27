@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    @foreach([
        ['👥', 'Total Users',     $stats['total_users'],     'blue'],
        ['🏭', 'Total Vendors',   $stats['total_vendors'],   'indigo'],
        ['✅', 'Active Vendors',  $stats['approved_vendors'],'green'],
        ['📦', 'Total Products',  $stats['total_products'],  'purple'],
        ['📋', 'Total RFQs',      $stats['total_rfqs'],      'amber'],
    ] as [$icon, $label, $value, $color])
    <div class="bg-white rounded-xl shadow-sm p-5 border border-secondary/5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-2xl">{{ $icon }}</span>
            <span class="text-xs font-medium text-{{ $color }}-600 bg-{{ $color }}-50 px-2 py-0.5 rounded-full">Total</span>
        </div>
        <p class="text-2xl font-bold text-secondary">{{ number_format($value) }}</p>
        <p class="text-xs text-secondary/50 mt-1">{{ $label }}</p>
    </div>
    @endforeach
</div>

{{-- Alert Rows --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="font-semibold text-yellow-800 text-sm">Pending Vendors</p>
            <p class="text-2xl font-bold text-yellow-700">{{ $stats['pending_vendors'] }}</p>
        </div>
        <a href="{{ route('admin.vendors.index', ['status' => 'pending']) }}" class="text-xs text-yellow-700 hover:underline font-medium">Review →</a>
    </div>
    <div class="bg-primary/10 border border-primary/20 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="font-semibold text-blue-800 text-sm">New RFQs</p>
            <p class="text-2xl font-bold text-primary-dark">{{ $stats['new_rfqs'] }}</p>
        </div>
        <a href="{{ route('admin.rfqs.index', ['status' => 'new']) }}" class="text-xs text-primary-dark hover:underline font-medium">View →</a>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center justify-between">
        <div>
            <p class="font-semibold text-red-800 text-sm">Unread Messages</p>
            <p class="text-2xl font-bold text-red-700">{{ $stats['unread_contacts'] }}</p>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="text-xs text-red-700 hover:underline font-medium">Read →</a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Vendors --}}
    <div class="bg-white rounded-xl shadow-sm border border-secondary/5 overflow-hidden">
        <div class="p-5 border-b border-secondary/5 flex justify-between items-center">
            <h3 class="font-bold text-secondary">Recent Vendors</h3>
            <a href="{{ route('admin.vendors.index') }}" class="text-xs text-primary hover:underline">View all</a>
        </div>
        <div class="divide-y divide-secondary/5">
            @forelse($recentVendors as $vendor)
            <div class="p-4 flex items-center gap-3">
                <div class="w-9 h-9 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <span class="text-primary-dark font-bold text-sm">{{ strtoupper(substr($vendor->company_name, 0, 1)) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-sm text-secondary truncate">{{ $vendor->company_name }}</p>
                    <p class="text-xs text-secondary/50">{{ $vendor->country }} • {{ $vendor->category?->name }}</p>
                </div>
                <span class="badge text-xs
                    @if($vendor->status === 'approved') badge-success
                    @elseif($vendor->status === 'pending') badge-yellow
                    @elseif($vendor->status === 'rejected') badge-red
                    @else badge-gray @endif">
                    {{ ucfirst($vendor->status) }}
                </span>
            </div>
            @empty
            <p class="p-5 text-sm text-secondary/50 text-center">No vendors yet</p>
            @endforelse
        </div>
    </div>

    {{-- Recent RFQs --}}
    <div class="bg-white rounded-xl shadow-sm border border-secondary/5 overflow-hidden">
        <div class="p-5 border-b border-secondary/5 flex justify-between items-center">
            <h3 class="font-bold text-secondary">Recent RFQs</h3>
            <a href="{{ route('admin.rfqs.index') }}" class="text-xs text-primary hover:underline">View all</a>
        </div>
        <div class="divide-y divide-secondary/5">
            @forelse($recentRfqs as $rfq)
            <div class="p-4">
                <div class="flex items-center justify-between mb-1">
                    <p class="font-medium text-sm text-secondary">{{ $rfq->name }}</p>
                    <span class="badge text-xs
                        @if($rfq->status === 'new') badge-primary
                        @elseif($rfq->status === 'reviewed') badge-yellow
                        @elseif($rfq->status === 'responded') badge-success
                        @else badge-gray @endif">
                        {{ ucfirst($rfq->status) }}
                    </span>
                </div>
                <p class="text-xs text-secondary/50 truncate">{{ Str::limit($rfq->product_description, 60) }}</p>
                <p class="text-xs text-secondary/50 mt-1">{{ $rfq->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <p class="p-5 text-sm text-secondary/50 text-center">No RFQs yet</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
