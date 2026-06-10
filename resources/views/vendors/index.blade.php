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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vendors as $vendor)
            <a href="{{ route('vendors.show', $vendor->slug) }}" class="reveal-up group block">
                <div class="relative bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    {{-- Banner with gradient overlay --}}
                    <div class="relative h-40 bg-gradient-to-br from-primary/30 via-secondary/90 to-accent/20 overflow-hidden">
                        @if($vendor->banner)
                            <img src="{{ asset('storage/' . $vendor->banner) }}" alt="" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-secondary/30 to-transparent"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary/30 via-secondary/90 to-accent/20">
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full blur-2xl"></div>
                                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-accent rounded-full blur-xl"></div>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Featured badge --}}
                        @if($vendor->is_featured)
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-accent to-yellow-500 text-secondary text-[10px] font-black uppercase tracking-wider rounded-full shadow-lg backdrop-blur-sm">
                                    <i class="fas fa-star text-[9px]"></i>
                                    Featured
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Card body --}}
                    <div class="p-6 -mt-10 relative">
                        {{-- Logo section --}}
                        <div class="flex items-start justify-between mb-4">
                            <div class="relative">
                                <div class="w-20 h-20 bg-white rounded-2xl shadow-xl border-4 border-white flex items-center justify-center overflow-hidden transform group-hover:scale-105 transition-transform duration-300">
                                    @if($vendor->logo)
                                        <img src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->company_name }}" class="w-full h-full object-contain p-2">
                                    @else
                                        <span class="font-heading font-black text-primary text-3xl">{{ strtoupper(substr($vendor->company_name,0,1)) }}</span>
                                    @endif
                                </div>
                                {{-- Verified badge --}}
                                <div class="absolute -bottom-1 -right-1 w-7 h-7 bg-green-500 rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                                    <i class="fas fa-check text-white text-[10px]"></i>
                                </div>
                            </div>
                            
                            {{-- Category badge --}}
                            <span class="inline-block px-3 py-1.5 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wide rounded-lg">
                                {{ $vendor->category->name ?? 'General' }}
                            </span>
                        </div>

                        {{-- Company info --}}
                        <div class="mb-4">
                            <h3 class="font-heading font-black text-secondary text-lg leading-tight mb-2 group-hover:text-primary transition-colors line-clamp-1">
                                {{ $vendor->company_name }}
                            </h3>
                            @if($vendor->country)
                                <div class="flex items-center gap-1.5 text-secondary/60 text-xs font-semibold mb-3">
                                    <i class="fas fa-map-marker-alt text-primary text-xs"></i>
                                    <span>{{ $vendor->city ? $vendor->city.', ' : '' }}{{ $vendor->country }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Description --}}
                        @if($vendor->description)
                            <p class="text-secondary/60 text-sm leading-relaxed line-clamp-3 mb-4 min-h-[60px]">
                                {{ $vendor->description }}
                            </p>
                        @else
                            <div class="mb-4 min-h-[60px]"></div>
                        @endif

                        {{-- Meta info --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4 pb-4 border-b border-secondary/8">
                            @if($vendor->established_year)
                                <div class="flex items-center gap-1.5 text-xs">
                                    <i class="fas fa-calendar-alt text-primary/60"></i>
                                    <span class="text-secondary/50 font-semibold">Est. {{ $vendor->established_year }}</span>
                                </div>
                            @endif
                            <div class="flex items-center gap-1.5 text-xs">
                                <i class="fas fa-boxes text-primary/60"></i>
                                <span class="text-secondary/50 font-semibold">{{ $vendor->products_count }} {{ Str::plural('Product', $vendor->products_count) }}</span>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-secondary/40 uppercase tracking-wide">View Profile</span>
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center group-hover:bg-primary-dark group-hover:shadow-lg transition-all">
                                <i class="fas fa-arrow-right text-white text-sm group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </div>
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
