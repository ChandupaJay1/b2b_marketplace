@extends('layouts.app')
@section('title', 'Products — B2B Marketplace')

@section('content')

{{-- Header --}}
<section class="relative bg-secondary py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative reveal-left">
        <span class="section-label text-accent"><span class="w-5 h-px bg-accent inline-block"></span> Product Catalog</span>
        <h1 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-4">Browse <span class="text-gradient-gold italic">Products</span></h1>
        <p class="text-white/50 text-lg max-w-xl">Thousands of quality products from verified manufacturers ready for international trade</p>
    </div>
</section>

{{-- Search strip --}}
<div class="bg-white border-b border-secondary/8 sticky top-[65px] z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-3 items-center">
            <div class="flex-1 min-w-48 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-secondary/30 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="input-field pl-10 py-2.5 text-sm">
            </div>
            <select name="category" class="input-field w-44 py-2.5 text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('category') == $cat->slug)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="subcategory" class="input-field w-44 py-2.5 text-sm">
                <option value="">All Subcategories</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->slug }}" @selected(request('subcategory') == $sub->slug)>{{ $sub->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-primary text-white text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-all flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request()->hasAny(['search','category','subcategory']))
                <a href="{{ route('products.index') }}" class="text-xs text-secondary/40 hover:text-danger font-bold transition-colors flex items-center gap-1">
                    <i class="fas fa-times text-[10px]"></i> Clear
                </a>
            @endif
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <p class="text-sm text-secondary/50 font-semibold">Showing <span class="text-secondary font-black">{{ $products->total() }}</span> products</p>
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
            <a href="{{ route('products.show', $product->slug) }}" class="reveal-up group card-hover">
                <div class="relative h-48 bg-surface-dark overflow-hidden">
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-box text-3xl text-secondary/15"></i>
                        </div>
                    @endif
                    @if($product->is_featured)
                        <span class="absolute top-3 left-3 px-2.5 py-1 bg-accent text-secondary text-[9px] font-black uppercase tracking-widest rounded-full shadow-gold">★ Featured</span>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-primary text-[10px] font-black uppercase tracking-widest mb-1">{{ $product->category->name ?? '' }}</p>
                    <h3 class="font-heading font-black text-secondary text-sm mb-2 group-hover:text-primary transition-colors line-clamp-1">{{ $product->name }}</h3>
                    @if($product->short_description)
                        <p class="text-secondary/40 text-xs mb-3 line-clamp-2 leading-relaxed">{{ $product->short_description }}</p>
                    @endif
                    <div class="flex items-center justify-between border-t border-secondary/6 pt-3">
                        @if($product->price)
                            <span class="font-heading font-black text-primary">${{ number_format($product->price,2) }}</span>
                        @else
                            <span class="text-secondary/30 text-xs font-semibold">On request</span>
                        @endif
                        <span class="text-secondary/30 text-[10px] font-bold">MOQ: {{ $product->min_order_quantity }} {{ $product->unit }}</span>
                    </div>
                    <p class="text-secondary/30 text-[10px] mt-1.5">by {{ $product->vendor->company_name ?? '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">{{ $products->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
