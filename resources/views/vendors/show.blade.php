@extends('layouts.app')
@section('title', $vendor->company_name . ' — B2B Marketplace')

@section('content')
{{-- Banner --}}
<div class="relative h-64 bg-secondary overflow-hidden">
    @if($vendor->banner)
        <img src="{{ asset('storage/' . $vendor->banner) }}" alt="{{ $vendor->company_name }}" class="w-full h-full object-cover opacity-60 animate-kenburns">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-secondary/90 via-secondary/40 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-secondary/60 to-transparent"></div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Vendor Header Card --}}
    <div class="relative -mt-20 z-10 bg-white rounded-3xl shadow-premium p-6 sm:p-8 mb-8 border border-secondary/6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
            <div class="w-24 h-24 bg-white rounded-2xl shadow-lg border border-secondary/8 flex items-center justify-center flex-shrink-0">
                @if($vendor->logo)
                    <img src="{{ asset('storage/' . $vendor->logo) }}" alt="" class="w-20 h-20 object-contain rounded-2xl">
                @else
                    <span class="font-heading font-black text-primary text-4xl">{{ strtoupper(substr($vendor->company_name,0,1)) }}</span>
                @endif
            </div>
            <div class="flex-1">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <h1 class="font-heading font-black text-secondary text-2xl sm:text-3xl">{{ $vendor->company_name }}</h1>
                    @if($vendor->is_featured)
                        <span class="badge-yellow text-[9px]">⭐ Featured</span>
                    @endif
                    <span class="badge-green text-[9px]">✓ Verified</span>
                </div>
                <div class="flex flex-wrap gap-4 text-sm text-secondary/50 font-semibold mb-4">
                    <span class="flex items-center gap-1.5"><i class="fas fa-tag text-primary text-[10px]"></i>{{ $vendor->category->name ?? 'General' }}</span>
                    @if($vendor->country) <span class="flex items-center gap-1.5"><i class="fas fa-map-marker-alt text-primary text-[10px]"></i>{{ $vendor->city ? $vendor->city.', ' : '' }}{{ $vendor->country }}</span> @endif
                    @if($vendor->established_year) <span class="flex items-center gap-1.5"><i class="fas fa-calendar text-primary text-[10px]"></i>Est. {{ $vendor->established_year }}</span> @endif
                    @if($vendor->employees_count) <span class="flex items-center gap-1.5"><i class="fas fa-users text-primary text-[10px]"></i>{{ $vendor->employees_count }}+ Employees</span> @endif
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('rfq.create', ['vendor' => $vendor->slug]) }}" class="btn-primary text-[11px]">
                        <i class="fas fa-paper-plane"></i> Request Quotation
                    </a>
                    @if($vendor->website)
                        <a href="{{ $vendor->website }}" target="_blank" rel="noopener" class="btn-secondary text-[11px]">
                            <i class="fas fa-globe"></i> Website
                        </a>
                    @endif
                    @if($vendor->email)
                        <a href="mailto:{{ $vendor->email }}" class="btn-secondary text-[11px]">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-20">
        {{-- Main --}}
        <div class="lg:col-span-2 space-y-8">
            @if($vendor->description)
            <div class="card p-7">
                <h2 class="font-heading font-black text-secondary text-xl mb-4">About {{ $vendor->company_name }}</h2>
                <p class="text-secondary/60 leading-relaxed">{{ $vendor->description }}</p>
            </div>
            @endif

            {{--
            <div>
                <h2 class="font-heading font-black text-secondary text-xl mb-5">Products <span class="text-primary">({{ $products->total() }})</span></h2>
                @if($products->isEmpty())
                    <div class="card p-12 text-center">
                        <i class="fas fa-box text-4xl text-secondary/15 mb-3 block"></i>
                        <p class="text-secondary/40 font-semibold">No products listed yet.</p>
                    </div>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="group card-hover flex gap-4 p-4">
                        <div class="w-20 h-20 bg-surface-dark rounded-2xl flex-shrink-0 overflow-hidden">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-secondary/20 text-xl">📦</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] text-primary font-black uppercase tracking-widest mb-0.5">{{ $product->category->name ?? '' }}</p>
                            <h3 class="font-heading font-black text-secondary text-sm group-hover:text-primary transition-colors line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-xs text-secondary/40 mt-0.5 line-clamp-2">{{ $product->short_description }}</p>
                            @if($product->price)
                                <p class="font-heading font-black text-primary text-sm mt-1">${{ number_format($product->price,2) }}</p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="mt-6">{{ $products->links() }}</div>
                @endif
            </div>
            --}}
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="card p-6">
                <h3 class="font-heading font-black text-secondary text-sm mb-5 uppercase tracking-widest text-[11px] text-secondary/50">Contact Information</h3>
                <dl class="space-y-4">
                    @foreach([
                        ['fas fa-envelope', 'Email', $vendor->email],
                        ['fas fa-phone', 'Phone', $vendor->phone],
                        ['fas fa-map-marker-alt', 'Address', $vendor->address ? $vendor->address.($vendor->city?', '.$vendor->city:'') : null],
                        ['fas fa-mail-bulk', 'Postal Code', $vendor->postal_code],
                    ] as [$icon, $label, $value])
                    @if($value)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-primary/8 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="{{ $icon }} text-primary text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-secondary/40 font-bold uppercase tracking-widest">{{ $label }}</p>
                            <p class="text-sm font-semibold text-secondary mt-0.5">{{ $value }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </dl>
            </div>

            <div class="rounded-3xl p-6 bg-gradient-to-br from-primary to-primary-dark text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                <div class="relative">
                    <div class="w-10 h-10 bg-white/10 rounded-2xl flex items-center justify-center mb-4">
                        <i class="fas fa-file-invoice text-accent text-lg"></i>
                    </div>
                    <h3 class="font-heading font-black text-white mb-2">Interested in products?</h3>
                    <p class="text-white/60 text-xs mb-4 leading-relaxed">Send an RFQ and receive the best pricing directly from this vendor.</p>
                    <a href="{{ route('rfq.create', ['vendor' => $vendor->slug]) }}"
                       class="block text-center bg-accent text-secondary font-black text-[10px] uppercase tracking-widest py-3 rounded-2xl hover:bg-accent-dark transition-all hover:scale-[1.02]">
                        Submit RFQ <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
