@extends('layouts.app')
@section('title', $product->name . ' — B2B Marketplace')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-secondary/40 font-semibold mb-8 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Products</a>
        @if($product->category)
        <i class="fas fa-chevron-right text-[8px]"></i>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
        @endif
        <i class="fas fa-chevron-right text-[8px]"></i>
        <span class="text-secondary font-bold">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        {{-- Images --}}
        <div>
            <div class="rounded-3xl overflow-hidden bg-surface-dark mb-4 h-96 relative">
                @if($product->main_image)
                    <img id="main-img" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-box text-6xl text-secondary/15"></i>
                    </div>
                @endif
                @if($product->is_featured)
                    <span class="absolute top-4 left-4 px-3 py-1.5 bg-accent text-secondary text-[9px] font-black uppercase tracking-widest rounded-full shadow-gold">★ Featured</span>
                @endif
            </div>
            @if($product->images->count())
            <div class="flex gap-3 overflow-x-auto pb-2">
                @if($product->main_image)
                <button onclick="document.getElementById('main-img').src='{{ asset('storage/' . $product->main_image) }}'"
                    class="w-18 h-18 flex-shrink-0 rounded-2xl overflow-hidden border-2 border-primary shadow-green">
                    <img src="{{ asset('storage/' . $product->main_image) }}" class="w-full h-full object-cover" alt="">
                </button>
                @endif
                @foreach($product->images as $img)
                <button onclick="document.getElementById('main-img').src='{{ asset('storage/' . $img->image) }}'"
                    class="w-18 h-18 flex-shrink-0 rounded-2xl overflow-hidden border-2 border-secondary/10 hover:border-primary transition-colors">
                    <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover" alt="">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Details --}}
        <div>
            <div class="flex flex-wrap gap-2 mb-4">
                @if($product->category)
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="badge badge-primary text-[10px]">{{ $product->category->name }}</a>
                @endif
                @if($product->subcategory)
                    <span class="badge-gray text-[10px]">{{ $product->subcategory->name }}</span>
                @endif
            </div>
            <h1 class="font-heading font-black text-secondary text-3xl sm:text-4xl leading-tight mb-5">{{ $product->name }}</h1>
            @if($product->short_description)
                <p class="text-secondary/60 text-lg mb-6 leading-relaxed">{{ $product->short_description }}</p>
            @endif

            {{-- Pricing Card --}}
            <div class="bg-surface-dark rounded-2xl p-5 mb-6 space-y-3 border border-secondary/8">
                @php $primaryVendor = $product->vendors->firstWhere('pivot.is_primary', true) ?? $product->vendors->first(); @endphp
                @if($primaryVendor && $primaryVendor->pivot->price)
                <div class="flex justify-between items-center pb-3 border-b border-secondary/8">
                    <span class="text-secondary/50 text-sm font-semibold">Starting Price</span>
                    <span class="font-heading font-black text-primary text-2xl">
                        ${{ number_format($primaryVendor->pivot->price, 2) }}
                        <span class="text-sm text-secondary/40 font-semibold"> / {{ $product->unit }}</span>
                    </span>
                </div>
                @elseif($product->price)
                <div class="flex justify-between items-center pb-3 border-b border-secondary/8">
                    <span class="text-secondary/50 text-sm font-semibold">Unit Price</span>
                    <span class="font-heading font-black text-primary text-2xl">
                        ${{ number_format($product->price, 2) }}
                        <span class="text-sm text-secondary/40 font-semibold"> / {{ $product->unit }}</span>
                    </span>
                </div>
                @endif
                <div class="flex justify-between items-center text-sm">
                    <span class="text-secondary/50 font-semibold">Min. Order Qty</span>
                    <span class="font-black text-secondary">{{ $product->min_order_quantity }} {{ $product->unit }}</span>
                </div>
                @if($product->sku)
                <div class="flex justify-between items-center text-sm">
                    <span class="text-secondary/50 font-semibold">SKU</span>
                    <span class="font-black text-secondary font-mono text-xs bg-secondary/5 px-3 py-1 rounded-lg">{{ $product->sku }}</span>
                </div>
                @endif
                @if($product->origin_country)
                <div class="flex justify-between items-center text-sm">
                    <span class="text-secondary/50 font-semibold">Country of Origin</span>
                    <span class="font-black text-secondary flex items-center gap-1.5">
                        <i class="fas fa-globe text-primary text-xs"></i>{{ $product->origin_country }}
                    </span>
                </div>
                @endif
                <div class="flex justify-between items-center text-sm">
                    <span class="text-secondary/50 font-semibold">Suppliers</span>
                    <span class="font-black text-secondary flex items-center gap-1.5">
                        <i class="fas fa-store text-primary text-xs"></i>
                        {{ $product->vendors->count() }} vendor{{ $product->vendors->count() > 1 ? 's' : '' }}
                    </span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-secondary/50 font-semibold">Views</span>
                    <span class="font-semibold text-secondary/40">{{ number_format($product->views) }}</span>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('rfq.create', ['product' => $product->slug]) }}" class="btn-primary flex-1 text-[11px]">
                    <i class="fas fa-paper-plane"></i> Request Quotation
                </a>
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if($product->description)
    <div class="card p-8 mb-12">
        <h2 class="font-heading font-black text-secondary text-2xl mb-5">Product Description</h2>
        <p class="text-secondary/60 leading-relaxed">{{ $product->description }}</p>
    </div>
    @endif

    {{-- ── All Vendors for this Product ─────────────────────────── --}}
    @if($product->vendors->count())
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-heading font-black text-secondary text-2xl">
                    {{ $product->vendors->count() > 1 ? 'Compare Vendors' : 'Supplier' }}
                </h2>
                <p class="text-secondary/40 text-sm font-semibold mt-1">
                    {{ $product->vendors->count() }} verified supplier{{ $product->vendors->count() > 1 ? 's' : '' }} offering this product
                </p>
            </div>
            @if($product->vendors->count() > 1)
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary/5 border border-primary/20 text-primary-dark text-xs font-bold rounded-full">
                <i class="fas fa-balance-scale text-[10px]"></i> Price Comparison
            </span>
            @endif
        </div>

        {{-- Vendor comparison grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($product->vendors as $vendor)
            @php
                $isPrimary = $vendor->pivot->is_primary;
                $price     = $vendor->pivot->price;
                $moq       = $vendor->pivot->min_order_quantity ?? $product->min_order_quantity;
                $sku       = $vendor->pivot->sku ?? $product->sku;

                // Find cheapest vendor for badge
                $allPrices = $product->vendors->pluck('pivot.price')->filter()->sort()->values();
                $isCheapest = $allPrices->count() > 1 && $price && $price == $allPrices->first();
            @endphp

            <div class="relative bg-white rounded-2xl border-2 p-5 transition-all duration-300
                        hover:shadow-lg group
                        {{ $isPrimary ? 'border-primary shadow-sm' : 'border-secondary/8 hover:border-primary/30' }}">

                {{-- Badges --}}
                <div class="absolute -top-3 left-4 flex gap-2">
                    @if($isPrimary)
                    <span class="px-2.5 py-1 bg-primary text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-sm">
                        ✓ Primary
                    </span>
                    @endif
                    @if($isCheapest)
                    <span class="px-2.5 py-1 bg-primary/50 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-sm">
                        💰 Best Price
                    </span>
                    @endif
                </div>

                {{-- Vendor logo & name --}}
                <div class="flex items-center gap-3 mb-4 pt-1">
                    <div class="w-12 h-12 bg-surface-dark rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        @if($vendor->logo)
                            <img src="{{ asset('storage/' . $vendor->logo) }}"
                                 class="w-10 h-10 object-contain rounded-lg" alt="{{ $vendor->company_name }}">
                        @else
                            <span class="font-heading font-black text-primary text-xl">
                                {{ strtoupper(substr($vendor->company_name, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <div class="min-w-0">
                        <p class="font-heading font-black text-secondary text-sm leading-tight truncate">
                            {{ $vendor->company_name }}
                        </p>
                        <p class="text-secondary/40 text-xs font-semibold flex items-center gap-1 mt-0.5">
                            <i class="fas fa-map-marker-alt text-[9px]"></i>
                            {{ $vendor->city ? $vendor->city . ', ' : '' }}{{ $vendor->country }}
                        </p>
                    </div>
                </div>

                {{-- Pricing details --}}
                <div class="space-y-2.5 py-3 border-t border-b border-secondary/6 mb-4">
                    <div class="flex items-center justify-between">
                        <span class="text-secondary/45 text-xs font-semibold">Unit Price</span>
                        @if($price)
                            <span class="font-heading font-black text-primary text-lg">
                                ${{ number_format($price, 2) }}
                                <span class="text-xs text-secondary/40 font-semibold">/{{ $product->unit }}</span>
                            </span>
                        @else
                            <span class="text-xs font-bold text-secondary/35 italic">On request</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-secondary/45 text-xs font-semibold">Min. Order</span>
                        <span class="font-bold text-secondary text-xs">{{ $moq }} {{ $product->unit }}</span>
                    </div>
                    @if($sku)
                    <div class="flex items-center justify-between">
                        <span class="text-secondary/45 text-xs font-semibold">SKU</span>
                        <span class="font-mono text-xs bg-secondary/5 px-2 py-0.5 rounded text-secondary/60">{{ $sku }}</span>
                    </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <a href="{{ route('rfq.create', ['product' => $product->slug, 'vendor' => $vendor->slug]) }}"
                       class="flex-1 flex items-center justify-center gap-1.5 py-2.5 px-3 text-[10px] font-black uppercase tracking-wide
                              bg-primary text-white rounded-xl hover:bg-primary-dark transition-all hover:scale-105 active:scale-95">
                        <i class="fas fa-paper-plane text-[9px]"></i> Get Quote
                    </a>
                    <a href="{{ route('vendors.show', $vendor->slug) }}"
                       class="flex items-center justify-center gap-1.5 py-2.5 px-3 text-[10px] font-black uppercase tracking-wide
                              border-2 border-secondary/10 text-secondary/60 rounded-xl hover:border-primary hover:text-primary
                              transition-all hover:scale-105 active:scale-95">
                        <i class="fas fa-store text-[9px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Related --}}
    @if($related->count())
    <div>
        <h2 class="font-heading font-black text-secondary text-2xl mb-6">Related Products</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            @foreach($related as $rel)
            <a href="{{ route('products.show', $rel->slug) }}" class="group card-hover">
                <div class="h-40 bg-surface-dark overflow-hidden">
                    @if($rel->main_image)
                        <img src="{{ asset('storage/' . $rel->main_image) }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-secondary/15 text-3xl">📦</div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-heading font-black text-sm text-secondary group-hover:text-primary transition-colors line-clamp-1">{{ $rel->name }}</h3>
                    @if($rel->price)
                        <p class="font-heading font-black text-primary text-base mt-1">${{ number_format($rel->price,2) }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
