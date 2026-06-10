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
            <a href="{{ route('vendors.show', $vendor->slug) }}" class="reveal-up group card-hover">
                {{-- Banner --}}
                <div class="relative h-32 bg-gradient-to-br from-primary/20 to-secondary overflow-hidden">
                    @if($vendor->banner)
                        <img src="{{ asset('storage/' . $vendor->banner) }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-secondary/30"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-secondary/80 to-accent/10"></div>
                    @endif
                    @if($vendor->is_featured)
                        <span class="absolute top-3 right-3 px-2.5 py-1 bg-accent text-secondary text-[9px] font-black uppercase tracking-widest rounded-full shadow-gold">⭐ Featured</span>
                    @endif
                </div>
                {{-- Body --}}
                <div class="p-5 pt-0 -mt-6 relative">
                    <div class="flex items-end gap-3 mb-4">
                        <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-secondary/8 flex items-center justify-center flex-shrink-0">
                            @if($vendor->logo)
                                <img src="{{ asset('storage/' . $vendor->logo) }}" alt="" class="w-12 h-12 object-contain rounded-2xl">
                            @else
                                <span class="font-heading font-black text-primary text-2xl">{{ strtoupper(substr($vendor->company_name,0,1)) }}</span>
                            @endif
                        </div>
                        <div class="pb-0.5">
                            <h3 class="font-heading font-black text-secondary text-sm group-hover:text-primary transition-colors">{{ $vendor->company_name }}</h3>
                            @if($vendor->country)
                                <p class="text-secondary/40 text-[10px] font-semibold flex items-center gap-1 mt-0.5">
                                    <i class="fas fa-map-marker-alt text-primary text-[8px]"></i>{{ $vendor->city ? $vendor->city.', ' : '' }}{{ $vendor->country }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mb-3">
                        <span class="badge-blue text-[9px]">{{ $vendor->category->name ?? 'General' }}</span>
                        @if($vendor->established_year)
                            <span class="badge-gray text-[9px]">Est. {{ $vendor->established_year }}</span>
                        @endif
                    </div>

                    @if($vendor->description)
                        <p class="text-secondary/50 text-xs leading-relaxed line-clamp-2 mb-3">{{ $vendor->description }}</p>
                    @endif

                    <div class="flex items-center justify-between border-t border-secondary/6 pt-3">
                        <span class="text-[10px] text-secondary/40 font-bold flex items-center gap-1.5">
                            <i class="fas fa-boxes text-primary/60 text-[9px]"></i>{{ $vendor->products_count }} products
                        </span>
                        <span class="text-[10px] font-black text-primary uppercase tracking-widest group-hover:gap-3 flex items-center gap-1 transition-all">
                            View <i class="fas fa-arrow-right text-[8px] group-hover:translate-x-1 transition-transform"></i>
                        </span>
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
