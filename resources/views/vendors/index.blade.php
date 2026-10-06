@extends('layouts.app')
@section('title', 'Vendors — B2B Marketplace')

@section('content')

{{-- Page Header --}}
<section class="relative bg-secondary py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-2xl reveal-left">
            <span class="section-label text-accent"><span class="w-5 h-px bg-accent inline-block"></span> Directory</span>
            <h1 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-4">Browse <span class="text-gradient-gold italic">Vendors</span></h1>
            <p class="text-white/50 text-lg">Discover verified manufacturers and exporters from around the world</p>
        </div>
    </div>
</section>

{{-- Search bar strip --}}
<div class="bg-white border-b border-secondary/8 sticky top-[65px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <form method="GET" action="{{ route('vendors.index') }}" class="flex flex-wrap gap-3 items-center">
            <div class="flex-1 min-w-48 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-secondary/30 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search company name..." class="input-field pl-10 py-2.5 text-sm">
            </div>
            <select name="category" class="input-field w-44 py-2.5 text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>{{ $cat->name }} ({{ $cat->vendors_count }})</option>
                @endforeach
            </select>
            <select name="country" class="input-field w-40 py-2.5 text-sm">
                <option value="">All Countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}" @selected(request('country') == $country)>{{ $country }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary text-white text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-all flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request()->hasAny(['search','category','country']))
                <a href="{{ route('vendors.index') }}" class="text-xs text-secondary/40 hover:text-danger font-bold transition-colors flex items-center gap-1">
                    <i class="fas fa-times text-[10px]"></i> Clear
                </a>
            @endif
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Results count --}}
    <div class="flex items-center justify-between mb-8">
        <p class="text-sm text-secondary/50 font-semibold">
            Showing <span class="text-secondary font-black">{{ $vendors->total() }}</span> vendors
            @if(request('search')) for "<span class="text-primary">{{ request('search') }}</span>"@endif
        </p>
    </div>

    @if($vendors->isEmpty())
        <div class="card py-24 text-center">
            <div class="w-20 h-20 bg-secondary/5 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-store text-3xl text-secondary/20"></i>
            </div>
            <h3 class="font-heading font-black text-secondary text-xl mb-2">No vendors found</h3>
            <p class="text-secondary/40 text-sm">Try adjusting your filters or search terms.</p>
            <a href="{{ route('vendors.index') }}" class="btn-primary mt-6 text-[11px]">Clear Filters</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vendors as $vendor)
            <a href="{{ route('vendors.show', $vendor->slug) }}" class="reveal-up group block">
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.18)] transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">

                    {{-- Banner --}}
                    <div class="relative h-44 overflow-hidden">
                        @if($vendor->banner)
                            <img src="{{ asset('storage/' . $vendor->banner) }}" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary via-secondary to-accent/80">
                                <div class="absolute inset-0">
                                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent/20 rounded-full blur-2xl"></div>
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-primary/20 rounded-full blur-xl"></div>
                                </div>
                                {{-- Pattern dots --}}
                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                            </div>
                        @endif

                        {{-- Top badges row --}}
                        <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                            {{-- Category pill --}}
                            @if($vendor->category)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-black/40 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-wide rounded-full border border-white/20 shadow">
                                    <i class="fas fa-th-large text-[8px] text-accent"></i>
                                    {{ $vendor->category->name }}
                                </span>
                            @else
                                <span></span>
                            @endif

                            {{-- Featured badge --}}
                            @if($vendor->is_featured)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gradient-to-r from-yellow-400 to-amber-500 text-white text-[10px] font-black uppercase tracking-wider rounded-full shadow-lg">
                                    <i class="fas fa-star text-[8px]"></i> Featured
                                </span>
                            @endif
                        </div>

                        {{-- Shimmer line on hover --}}
                        <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    {{-- Card body --}}
                    <div class="p-5 -mt-10 relative">

                        {{-- Logo + verified row --}}
                        <div class="flex items-end justify-between mb-4">
                            {{-- Logo --}}
                            <div class="relative">
                                <div class="w-[72px] h-[72px] bg-white rounded-2xl shadow-xl border-[3px] border-white ring-2 ring-gray-100 flex items-center justify-center overflow-hidden transform group-hover:scale-105 group-hover:ring-primary/30 transition-all duration-300">
                                    @if($vendor->logo)
                                        <img src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->company_name }}" class="w-full h-full object-contain p-2">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                                            <span class="font-heading font-black text-primary text-2xl">{{ strtoupper(substr($vendor->company_name,0,1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                {{-- Verified dot --}}
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-primary rounded-full flex items-center justify-center border-2 border-white shadow">
                                    <i class="fas fa-check text-white text-[9px]"></i>
                                </div>
                            </div>

                            {{-- Products count pill --}}
                            <div class="mb-1 flex flex-col items-end gap-1.5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary/8 text-primary text-[11px] font-bold rounded-xl border border-primary/15">
                                    <i class="fas fa-cube text-[9px]"></i>
                                    {{ $vendor->products_count }} {{ Str::plural('Product', $vendor->products_count) }}
                                </span>
                                @if($vendor->established_year)
                                    <span class="inline-flex items-center gap-1 text-[10px] text-secondary/40 font-semibold">
                                        <i class="fas fa-calendar-alt text-[9px]"></i>
                                        Est. {{ $vendor->established_year }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Company name --}}
                        <h3 class="font-heading font-black text-secondary text-[17px] leading-snug mb-1.5 group-hover:text-primary transition-colors duration-300 line-clamp-1">
                            {{ $vendor->company_name }}
                        </h3>

                        {{-- Location --}}
                        @if($vendor->country)
                            <div class="flex items-center gap-1.5 text-secondary/50 text-xs font-semibold mb-3">
                                <i class="fas fa-map-marker-alt text-primary/70 text-xs"></i>
                                <span>{{ $vendor->city ? $vendor->city.', ' : '' }}{{ $vendor->country }}</span>
                            </div>
                        @endif

                        {{-- Description --}}
                        @if($vendor->description)
                            <p class="text-secondary/55 text-[13px] leading-relaxed line-clamp-2 mb-4">
                                {{ $vendor->description }}
                            </p>
                        @else
                            <div class="mb-4 h-9"></div>
                        @endif

                        {{-- Divider --}}
                        <div class="border-t border-secondary/8 pt-4">
                            {{-- CTA row --}}
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] font-bold text-secondary/35 uppercase tracking-widest group-hover:text-primary transition-colors duration-300">View Profile</span>
                                <div class="flex items-center gap-2 px-4 py-2 bg-primary text-white text-xs font-bold rounded-xl group-hover:bg-primary-dark group-hover:shadow-lg group-hover:shadow-primary/30 transition-all duration-300">
                                    <span>Explore</span>
                                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom accent line --}}
                    <div class="absolute bottom-0 left-0 right-0 h-[3px] bg-gradient-to-r from-primary/60 via-primary to-accent/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">
            {{ $vendors->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
