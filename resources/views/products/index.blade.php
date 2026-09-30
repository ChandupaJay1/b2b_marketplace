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
            <div class="relative group/slider slider-container">
                {{-- Left Arrow --}}
                <button type="button" 
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-secondary/10 flex items-center justify-center text-secondary hover:text-primary hover:scale-110 transition-all duration-300 opacity-0 group-hover/slider:opacity-100 hidden sm:flex"
                        onclick="scrollSlider(this, 'left')">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>

                {{-- Right Arrow --}}
                <button type="button" 
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-20 w-10 h-10 bg-white rounded-full shadow-lg border border-secondary/10 flex items-center justify-center text-secondary hover:text-primary hover:scale-110 transition-all duration-300 opacity-0 group-hover/slider:opacity-100 hidden sm:flex"
                        onclick="scrollSlider(this, 'right')">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>

                {{-- Fade edge right --}}
                <div class="absolute right-0 top-0 bottom-0 w-16 bg-gradient-to-l from-surface to-transparent z-10 pointer-events-none"></div>

                <div class="flex gap-5 overflow-x-auto pb-4 pt-1 -mx-1 px-1 scroll-smooth snap-x snap-mandatory [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] product-slider"
                     onmouseenter="pauseAutoScroll(this)"
                     onmouseleave="resumeAutoScroll(this)">
                    @foreach($cat->featuredProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="snap-start flex-shrink-0 w-52 group bg-white rounded-2xl border border-secondary/6
                              hover:border-primary/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                        {{-- Image --}}
                        <div class="relative h-44 bg-surface-dark overflow-hidden">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}"
                                     alt="{{ $product->name }}"
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                    <i class="fas fa-box text-3xl text-secondary/10"></i>
                                </div>
                            @endif
                            @if($product->is_featured)
                                <span class="absolute top-2 left-2 px-2 py-0.5 bg-accent text-secondary text-[8px] font-black uppercase tracking-widest rounded-full shadow-gold">
                                    ★ Featured
                                </span>
                            @endif
                            {{-- Quick view overlay --}}
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="bg-white text-secondary text-xs font-bold px-4 py-2 rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                    View Details
                                </span>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-4">
                            <h3 class="font-heading font-black text-secondary text-sm leading-tight line-clamp-1
                                       group-hover:text-primary transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-secondary/40 text-[10px] mt-1.5 line-clamp-2 leading-relaxed min-h-[30px]">
                                {{ $product->short_description ?: 'High quality ' . $product->name . ' processed under hygienic conditions.' }}
                            </p>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-secondary/5">
                                @if($product->price)
                                    <span class="font-heading font-black text-primary text-[15px]">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                @else
                                    <span class="text-secondary/40 text-[10px] font-bold uppercase tracking-wider">On request</span>
                                @endif
                                <span class="bg-surface-dark text-secondary/60 text-[9px] font-bold px-2 py-1 rounded-md">
                                    MOQ {{ $product->min_order_quantity }}
                                </span>
                            </div>
                            <p class="text-secondary/30 text-[9px] mt-2 truncate font-semibold flex items-center gap-1.5">
                                <i class="fas fa-store opacity-50"></i> {{ $product->vendor->company_name ?? 'Verified Vendor' }}
                            </p>
                        </div>
                    </a>
                    @endforeach

                    {{-- "See more" card at the end --}}
                    @if($cat->products_count > 10)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                       class="snap-start flex-shrink-0 w-48 rounded-2xl border-2 border-dashed border-secondary/15
                              hover:border-primary hover:bg-primary/5 flex flex-col items-center justify-center
                              text-center p-6 transition-all duration-300 group cursor-pointer">
                        <div class="w-14 h-14 rounded-full bg-surface-dark group-hover:bg-white group-hover:shadow-md
                                    flex items-center justify-center mb-4 transition-all duration-300 group-hover:scale-110">
                            <i class="fas fa-arrow-right text-secondary/40 group-hover:text-primary text-xl transition-colors"></i>
                        </div>
                        <h4 class="font-heading font-black text-secondary text-sm mb-1 group-hover:text-primary transition-colors">
                            View More
                        </h4>
                        <p class="text-[10px] font-bold text-secondary/40 group-hover:text-primary/70 transition-colors">
                            Explore {{ $cat->products_count - 10 }} more products in this category
                        </p>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endif
    @endforeach
</div>

@push('scripts')
<script>
    // Auto-scrolling logic for product sliders
    let sliderIntervals = new WeakMap();

    function scrollSlider(btn, direction) {
        const container = btn.closest('.slider-container').querySelector('.product-slider');
        const scrollAmount = container.clientWidth * 0.8;
        
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    function initAutoScroll() {
        const sliders = document.querySelectorAll('.product-slider');
        sliders.forEach(slider => {
            // Auto scroll every 3 seconds
            const interval = setInterval(() => {
                // If reached end, scroll back to start, else scroll right
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    slider.scrollBy({ left: slider.clientWidth * 0.5, behavior: 'smooth' });
                }
            }, 4000);
            
            sliderIntervals.set(slider, interval);
        });
    }

    function pauseAutoScroll(slider) {
        if (sliderIntervals.has(slider)) {
            clearInterval(sliderIntervals.get(slider));
            sliderIntervals.delete(slider);
        }
    }

    function resumeAutoScroll(slider) {
        // Only resume if it's not already running
        if (!sliderIntervals.has(slider)) {
            const interval = setInterval(() => {
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    slider.scrollBy({ left: slider.clientWidth * 0.5, behavior: 'smooth' });
                }
            }, 4000);
            sliderIntervals.set(slider, interval);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initAutoScroll();
    });
</script>
@endpush

@endif

@endsection
