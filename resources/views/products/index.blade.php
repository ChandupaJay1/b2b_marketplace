@extends('layouts.app')
@section('title', 'Products — B2B Marketplace')

@section('content')

{{-- ── Hero ──────────────────────────────────────────────────────────── --}}
<section class="relative bg-secondary py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative reveal-left">
        <span class="section-label text-accent">
            <span class="w-5 h-px bg-accent inline-block"></span> Product Catalog
        </span>
        <h1 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-4">
            Browse <span class="text-gradient-gold italic">Products</span>
        </h1>
        <p class="text-white/50 text-lg max-w-xl">
            Thousands of quality products from verified manufacturers, organised by category.
        </p>
    </div>
</section>

{{-- ── Search & Filter strip ─────────────────────────────────────────── --}}
<div class="bg-white border-b border-secondary/8 sticky top-[65px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-3 items-center">
            <div class="flex-1 min-w-48 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-secondary/30 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search products..."
                       class="input-field pl-10 py-2.5 text-sm">
            </div>
            <select name="category" class="input-field w-44 py-2.5 text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>
                        {{ $cat->name }} ({{ $cat->products_count }})
                    </option>
                @endforeach
            </select>
            <select name="subcategory" class="input-field w-44 py-2.5 text-sm">
                <option value="">All Subcategories</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->slug }}" @selected(request('subcategory') == $sub->slug)>
                        {{ $sub->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-primary text-white text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-all flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if($filterActive)
                <a href="{{ route('products.index') }}"
                   class="text-xs text-secondary/40 hover:text-danger font-bold transition-colors flex items-center gap-1">
                    <i class="fas fa-times text-[10px]"></i> Clear
                </a>
            @endif
        </form>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════
     FILTERED VIEW (search / category / subcategory active)
══════════════════════════════════════════════════════════════════ --}}
@if($filterActive)
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-secondary/50 font-semibold">
            Showing <span class="text-secondary font-black">{{ $products->total() }}</span> products
        </p>
        <a href="{{ route('products.index') }}"
           class="text-xs text-primary font-bold hover:underline flex items-center gap-1">
            <i class="fas fa-th-large text-[10px]"></i> Browse by category
        </a>
    </div>

    @if($products->isEmpty())
        <div class="card py-24 text-center">
            <div class="w-20 h-20 bg-secondary/5 rounded-3xl flex items-center justify-center mx-auto mb-5">
                <i class="fas fa-box text-3xl text-secondary/20"></i>
            </div>
            <h3 class="font-heading font-black text-secondary text-xl mb-2">No products found</h3>
            <p class="text-secondary/40 text-sm mb-6">Try adjusting your search or filters.</p>
            <a href="{{ route('products.index') }}" class="btn-primary text-[11px]">Clear Filters</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            @include('products._card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">
            {{ $products->withQueryString()->links() }}
        </div>
    @endif
</div>

{{-- ══════════════════════════════════════════════════════════════════
     CATEGORY-WISE VIEW (default)
══════════════════════════════════════════════════════════════════ --}}
@else

{{-- Category quick-jump pills --}}
<div class="bg-white border-b border-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
            @foreach($categories as $cat)
            <a href="#cat-{{ $cat->slug }}"
               class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-bold bg-surface-dark text-secondary/60
                      hover:bg-primary hover:text-white transition-all duration-200 flex items-center gap-1.5">
                {{ $cat->name }}
                <span class="opacity-50 text-[10px]">{{ $cat->products_count }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-surface py-10 space-y-14">
    @foreach($categories as $cat)
    @if($cat->featuredProducts->count())

    {{-- ── Category Section ──────────────────────────────────── --}}
    <div id="cat-{{ $cat->slug }}" class="scroll-mt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Category header --}}
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-4">
                    {{-- Accent bar --}}
                    <div class="w-1 h-10 bg-gradient-to-b from-primary to-primary-dark rounded-full"></div>
                    <div>
                        <h2 class="font-heading font-black text-secondary text-xl sm:text-2xl leading-none">
                            {{ $cat->name }}
                        </h2>
                        <p class="text-secondary/40 text-xs font-semibold mt-0.5">
                            {{ $cat->products_count }} {{ Str::plural('product', $cat->products_count) }} available
                        </p>
                    </div>
                </div>
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                   class="flex-shrink-0 flex items-center gap-2 text-xs font-bold text-primary
                          hover:text-primary-dark transition-colors group">
                    View all
                    <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Horizontal scroll row --}}
            <div class="relative">
                {{-- Fade edge right --}}
                <div class="absolute right-0 top-0 bottom-0 w-16 bg-gradient-to-l from-surface to-transparent z-10 pointer-events-none"></div>

                <div class="flex gap-5 overflow-x-auto scrollbar-hide pb-3 -mx-1 px-1">
                    @foreach($cat->featuredProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="flex-shrink-0 w-52 group bg-white rounded-2xl border border-secondary/6
                              hover:border-primary/20 hover:shadow-lg transition-all duration-300 overflow-hidden">

                        {{-- Image --}}
                        <div class="relative h-40 bg-surface-dark overflow-hidden">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}"
                                     alt="{{ $product->name }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-box text-2xl text-secondary/10"></i>
                                </div>
                            @endif
                            @if($product->is_featured)
                                <span class="absolute top-2 left-2 px-2 py-0.5 bg-accent text-secondary text-[8px] font-black uppercase tracking-widest rounded-full shadow-gold">
                                    ★ Featured
                                </span>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-3.5">
                            <h3 class="font-heading font-black text-secondary text-sm leading-tight line-clamp-1
                                       group-hover:text-primary transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-secondary/35 text-[10px] mt-1 line-clamp-2 leading-snug">
                                {{ $product->short_description }}
                            </p>
                            <div class="flex items-center justify-between mt-3 pt-2.5 border-t border-secondary/5">
                                @if($product->price)
                                    <span class="font-heading font-black text-primary text-sm">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                @else
                                    <span class="text-secondary/30 text-[10px] font-semibold">On request</span>
                                @endif
                                <span class="text-secondary/25 text-[9px] font-bold">
                                    MOQ {{ $product->min_order_quantity }}
                                </span>
                            </div>
                            <p class="text-secondary/25 text-[9px] mt-1 truncate">
                                {{ $product->vendor->company_name ?? '' }}
                            </p>
                        </div>
                    </a>
                    @endforeach

                    {{-- "See more" card at the end --}}
                    @if($cat->products_count > 8)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                       class="flex-shrink-0 w-40 rounded-2xl border-2 border-dashed border-secondary/10
                              hover:border-primary/30 hover:bg-white flex flex-col items-center justify-center
                              text-center p-4 transition-all duration-300 group">
                        <div class="w-12 h-12 rounded-2xl bg-primary/5 group-hover:bg-primary/10
                                    flex items-center justify-center mb-3 transition-colors">
                            <i class="fas fa-plus text-primary text-base"></i>
                        </div>
                        <p class="text-xs font-black text-secondary/50 group-hover:text-primary transition-colors">
                            +{{ $cat->products_count - 8 }} more
                        </p>
                        <p class="text-[9px] text-secondary/30 mt-0.5">View all</p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endif
    @endforeach
</div>
@endif

@endsection
