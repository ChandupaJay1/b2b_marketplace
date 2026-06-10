@extends('layouts.admin')
@section('title', 'RFQ Details')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.rfqs.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to RFQs</a></div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-5">
        <div class="flex justify-between items-start mb-5">
            <h2 class="font-bold text-gray-900 text-lg">RFQ #{{ $rfq->id }}</h2>
            <span class="badge text-sm
                @if($rfq->status === 'new') badge-blue
                @elseif($rfq->status === 'reviewed') badge-yellow
                @elseif($rfq->status === 'responded') badge-green
                @else badge-gray @endif">{{ ucfirst($rfq->status) }}</span>
        </div>
        <dl class="grid grid-cols-2 gap-4 text-sm mb-5">
            <div><dt class="text-gray-500 text-xs mb-0.5">Name</dt><dd class="font-medium">{{ $rfq->name }}</dd></div>
            <div><dt class="text-gray-500 text-xs mb-0.5">Email</dt><dd class="font-medium">{{ $rfq->email }}</dd></div>
            @if($rfq->phone) <div><dt class="text-gray-500 text-xs mb-0.5">Phone</dt><dd class="font-medium">{{ $rfq->phone }}</dd></div> @endif
            @if($rfq->company) <div><dt class="text-gray-500 text-xs mb-0.5">Company</dt><dd class="font-medium">{{ $rfq->company }}</dd></div> @endif
            @if($rfq->country) <div><dt class="text-gray-500 text-xs mb-0.5">Country</dt><dd class="font-medium">{{ $rfq->country }}</dd></div> @endif
            @if($rfq->quantity) <div><dt class="text-gray-500 text-xs mb-0.5">Quantity</dt><dd class="font-medium">{{ $rfq->quantity }} {{ $rfq->unit }}</dd></div> @endif
        </dl>
        @if($rfq->vendor || $rfq->product)
        <div class="bg-gray-50 rounded-xl p-4 mb-4 text-sm">
            @if($rfq->vendor) <p><span class="text-gray-500">Vendor:</span> <strong>{{ $rfq->vendor->company_name }}</strong></p> @endif
            @if($rfq->product) <p><span class="text-gray-500">Product:</span> <strong>{{ $rfq->product->name }}</strong></p> @endif
        </div>
        @endif
        <div class="mb-4">
            <p class="text-gray-500 text-xs mb-1">Product Description</p>
            <p class="text-gray-800 text-sm bg-gray-50 rounded-xl p-4">{{ $rfq->product_description }}</p>
        </div>
        @if($rfq->additional_requirements)
        <div>
            <p class="text-gray-500 text-xs mb-1">Additional Requirements</p>
            <p class="text-gray-800 text-sm bg-gray-50 rounded-xl p-4">{{ $rfq->additional_requirements }}</p>
        </div>
        @endif
        <p class="text-xs text-gray-400 mt-4">Submitted {{ $rfq->created_at->format('M d, Y \a\t h:i A') }}</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-bold text-gray-900 mb-4">Update Status</h3>
        <form action="{{ route('admin.rfqs.status', $rfq) }}" method="POST" class="flex gap-3">
            @csrf @method('PATCH')
            <select name="status" class="input-field text-sm flex-1">
                @foreach(['new','reviewed','responded','closed'] as $s)
                    <option value="{{ $s }}" @selected($rfq->status == $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary text-sm px-5">Update</button>
        </form>
    </div>
</div>
@endsection
