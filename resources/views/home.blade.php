@extends('layouts.app')
@section('title', 'B2B Marketplace — Global Trade Platform')

@section('content')

{{-- ══ HERO SLIDER ═════════════════════════════════════════════════════════════════════════ --}}
<section class="relative h-screen min-h-[700px] overflow-hidden bg-secondary">
    <div class="swiper hero-swiper h-full"
         data-autoplay="7000" data-loop="true" data-effect="fade" data-speed="1500">
        <div class="swiper-wrapper h-full">

            {{-- Slide 1 --}}
            <div class="swiper-slide group relative h-full">
                <div class="absolute inset-0 scale-110 transition-transform duration-[10000ms] group-[.swiper-slide-active]:scale-100">
                    <div class="w-full h-full bg-gradient-to-br from-secondary via-secondary-light to-primary/30"></div>
                    <div class="absolute inset-0 bg-noise before:opacity-[0.015]"></div>
                </div>
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-accent/15 rounded-full blur-3xl animate-pulse" style="animation-delay:1s"></div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                    <div class="max-w-3xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0" style="transition-delay:400ms">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 backdrop-blur-md border border-primary/20 text-accent rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                            <span class="w-2 h-2 bg-accent rounded-full animate-ping"></span>
                            Global B2B Trade Platform
                        </span>
                        <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                            Connect with <br><span class="text-gradient-gold italic">Local</span><br>Manufacturers
                        </h1>
                        <p class="text-xl text-white/60 mb-10 max-w-xl leading-relaxed font-medium">
                            Discover verified vendors and source authentic products directly for your international trade needs.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('vendors.index') }}" class="btn-primary text-[11px]">
                                <i class="fas fa-store"></i> Browse Vendors
                            </a>
                            <a href="{{ route('rfq.create') }}" class="btn-outline-white text-[11px]">
                                <i class="fas fa-file-invoice"></i> Request Quote
                            </a>
                        </div>
                        <div class="flex items-center gap-8 mt-12 pt-8 border-t border-white/10">
                            <div><p class="text-3xl font-heading font-black text-white">{{ number_format($totalVendors) }}+</p><p class="text-white/40 text-xs uppercase tracking-widest font-bold">Verified Vendors</p></div>
                            <div class="w-px h-10 bg-white/10"></div>
                            <div><p class="text-3xl font-heading font-black text-white">{{ number_format($totalProducts) }}+</p><p class="text-white/40 text-xs uppercase tracking-widest font-bold">Products Listed</p></div>
                            <div class="w-px h-10 bg-white/10"></div>
                            <div><p class="text-3xl font-heading font-black text-white">50+</p><p class="text-white/40 text-xs uppercase tracking-widest font-bold">Countries</p></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 2 --}}
            <div class="swiper-slide group relative h-full">
                <div class="absolute inset-0">
                    <div class="w-full h-full bg-gradient-to-br from-secondary via-primary-dark/80 to-secondary"></div>
                </div>
                <div class="absolute inset-0">
                    <div class="absolute top-1/3 left-1/4 w-80 h-80 bg-accent/10 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-1/3 right-1/4 w-64 h-64 bg-primary/20 rounded-full blur-3xl animate-pulse" style="animation-delay:.7s"></div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                    <div class="max-w-3xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0" style="transition-delay:400ms">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-accent/20 backdrop-blur-md border border-accent/20 text-white rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                            <span class="w-2 h-2 bg-accent rounded-full animate-ping"></span>
                            Global Logistics Ready
                        </span>
                        <h2 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                            Source Quality<br><span class="text-gradient italic">Products</span><br>Worldwide
                        </h2>
                        <p class="text-xl text-white/60 mb-10 max-w-xl leading-relaxed font-medium">
                            Browse thousands of products across every industry category with direct access to manufacturers.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('products.index') }}" class="btn-accent text-[11px]">
                                <i class="fas fa-boxes"></i> Browse Products
                            </a>
                            <a href="{{ route('about') }}" class="btn-outline-white text-[11px]">
                                <i class="fas fa-info-circle"></i> Our Platform
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Slide 3 --}}
            <div class="swiper-slide group relative h-full">
                <div class="absolute inset-0">
                    <div class="w-full h-full bg-gradient-to-bl from-secondary via-secondary-light to-accent/20"></div>
                </div>
                <div class="absolute inset-0">
                    <div class="absolute top-1/4 right-1/3 w-96 h-96 bg-success/10 rounded-full blur-3xl animate-pulse"></div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                    <div class="max-w-3xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0" style="transition-delay:400ms">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-success/20 backdrop-blur-md border border-success/20 text-white rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                            <span class="w-2 h-2 bg-success rounded-full animate-ping"></span>
                            Easy Procurement
                        </span>
                        <h2 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                            Submit Your<br><span class="text-accent italic">RFQ</span> Today
                        </h2>
                        <p class="text-xl text-white/60 mb-10 max-w-xl leading-relaxed font-medium">
                            Fill in a Request for Quotation and get connected with the right vendors instantly.
                        </p>
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('rfq.create') }}" class="btn-primary text-[11px]">
                                <i class="fas fa-paper-plane"></i> Submit RFQ Now
                            </a>
                            <a href="{{ route('contact') }}" class="btn-outline-white text-[11px]">
                                <i class="fas fa-headset"></i> Get Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="hero-pagination swiper-pagination absolute bottom-8 left-0 right-0 flex justify-center gap-2 z-20"></div>

        {{-- Arrows --}}
        <div class="hero-prev swiper-button-prev absolute left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 glass-dark rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-primary/80 transition-all after:content-none">
            <i class="fas fa-chevron-left text-sm"></i>
        </div>
        <div class="hero-next swiper-button-next absolute right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 glass-dark rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-primary/80 transition-all after:content-none">
            <i class="fas fa-chevron-right text-sm"></i>
        </div>
    </div>
</section>

{{-- ══ TRUST BAR ════════════════════════════════════════════════════════════════════════════ --}}
<section class="bg-secondary/5 border-y border-secondary/8 py-5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-12 text-secondary/40 text-xs font-black uppercase tracking-widest">
            @foreach(['✓ Verified Vendors', '✓ Secure Inquiries', '✓ Global Reach', '✓ Direct Sourcing', '✓ Multi-category Platform'] as $item)
            <span class="flex items-center gap-2 hover:text-primary transition-colors cursor-default">{{ $item }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ PRODUCT CATEGORIES ═══════════════════════════════════════════════════════════════════ --}}
@if($productCategories->count())
<section class="py-24 bg-dot-pattern relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal-up">
            <span class="section-label"><span class="w-5 h-px bg-primary inline-block"></span> Browse by Category</span>
            <h2 class="section-title text-4xl sm:text-5xl">Explore Industry <span class="text-gradient italic">Sectors</span></h2>
            <div class="section-divider mx-auto"></div>
            <p class="text-secondary/50 text-lg max-w-xl mx-auto mt-3">Find products across a wide range of industries from verified manufacturers</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($productCategories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
               class="reveal-up group relative bg-white rounded-2xl border border-secondary/6 p-6 text-center hover:-translate-y-2 hover:shadow-premium hover:border-primary/15 transition-all duration-500 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/3 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative">
                    <div class="w-14 h-14 bg-primary/8 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300 shadow-sm">
                        <i class="fas fa-boxes text-primary text-xl group-hover:text-white transition-colors duration-300"></i>
                    </div>
                    <h3 class="font-heading font-black text-secondary text-sm mb-1 group-hover:text-primary transition-colors">{{ $category->name }}</h3>
                    <p class="text-secondary/40 text-xs font-semibold">{{ $category->products_count }} products</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══ FEATURED VENDORS ═════════════════════════════════════════════════════════════════════ --}}
@if($featuredVendors->count())
<section class="py-24 bg-secondary relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-0 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-end justify-between mb-14">
            <div class="reveal-left">
                <span class="section-label text-accent"><span class="w-5 h-px bg-accent inline-block"></span> Top Vendors</span>
                <h2 class="font-heading font-black text-white text-4xl sm:text-5xl leading-tight">Featured <span class="text-gradient-gold italic">Manufacturers</span></h2>
                <div class="w-12 h-1 bg-gradient-to-r from-accent to-primary rounded-full mt-4"></div>
            </div>
            <a href="{{ route('vendors.index') }}" class="reveal-right hidden sm:flex items-center gap-2 text-white/40 hover:text-accent text-xs font-black uppercase tracking-widest transition-colors group">
                View All <span class="w-0 group-hover:w-5 h-px bg-accent transition-all duration-300 ml-1"></span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredVendors as $vendor)
            <a href="{{ route('vendors.show', $vendor->slug) }}" class="reveal-up group relative glass-dark rounded-2xl border border-white/8 overflow-hidden hover:border-primary/40 hover:-translate-y-1 transition-all duration-500">
                {{-- Banner --}}
                <div class="h-28 bg-gradient-to-br from-primary/40 to-secondary relative overflow-hidden">
                    @if($vendor->banner)
                        <img src="{{ asset('storage/' . $vendor->banner) }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-secondary/40"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/30 via-secondary to-accent/10"></div>
                    @endif
                    @if($vendor->is_featured)
                        <span class="absolute top-3 right-3 px-2.5 py-1 bg-accent/90 text-secondary text-[9px] font-black uppercase tracking-widest rounded-full">⭐ Featured</span>
                    @endif
                </div>
                {{-- Content --}}
                <div class="p-5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-white/10 flex items-center justify-center flex-shrink-0 -mt-8 relative z-10">
                            @if($vendor->logo)
                                <img src="{{ asset('storage/' . $vendor->logo) }}" alt="" class="w-10 h-10 object-contain rounded-xl">
                            @else
                                <span class="text-primary font-black text-xl font-heading">{{ strtoupper(substr($vendor->company_name,0,1)) }}</span>
                            @endif
                        </div>
                        <div class="pt-1">
                            <h3 class="font-heading font-black text-white text-sm group-hover:text-accent transition-colors">{{ $vendor->company_name }}</h3>
                            <p class="text-white/35 text-xs">{{ $vendor->category->name ?? '' }} @if($vendor->country)· {{ $vendor->country }}@endif</p>
                        </div>
                    </div>
                    @if($vendor->description)
                        <p class="text-white/40 text-xs leading-relaxed line-clamp-2">{{ $vendor->description }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/8">
                        <span class="text-[10px] font-black text-white/30 uppercase tracking-widest">{{ $vendor->products_count ?? 0 }} products</span>
                        @if($vendor->established_year)
                            <span class="text-[10px] font-bold text-white/20">Est. {{ $vendor->established_year }}</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10 sm:hidden">
            <a href="{{ route('vendors.index') }}" class="btn-outline-white text-[11px]">View All Vendors</a>
        </div>
    </div>
</section>
@endif

{{-- ══ FEATURED PRODUCTS ════════════════════════════════════════════════════════════════════ --}}
@if($featuredProducts->count())
<section class="py-24 bg-surface relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-14">
            <div class="reveal-left">
                <span class="section-label"><span class="w-5 h-px bg-primary inline-block"></span> Curated Selection</span>
                <h2 class="section-title text-4xl sm:text-5xl">Featured <span class="text-gradient italic">Products</span></h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('products.index') }}" class="reveal-right hidden sm:flex items-center gap-2 text-secondary/40 hover:text-primary text-xs font-black uppercase tracking-widest transition-colors group">
                View All <span class="w-0 group-hover:w-5 h-px bg-primary transition-all duration-300 ml-1"></span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="reveal-up group card-hover">
                <div class="relative h-52 bg-surface-dark overflow-hidden">
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-box text-4xl text-secondary/15"></i>
                        </div>
                    @endif
                    @if($product->is_featured)
                        <span class="absolute top-3 left-3 px-2.5 py-1 bg-accent text-secondary text-[9px] font-black uppercase tracking-widest rounded-full shadow-gold">★ Featured</span>
                    @endif
                </div>
                <div class="p-5">
                    <p class="text-primary text-[10px] font-black uppercase tracking-widest mb-1">{{ $product->category->name ?? '' }}</p>
                    <h3 class="font-heading font-black text-secondary text-sm mb-2 group-hover:text-primary transition-colors line-clamp-1">{{ $product->name }}</h3>
                    @if($product->short_description)
                        <p class="text-secondary/40 text-xs mb-3 line-clamp-2 leading-relaxed">{{ $product->short_description }}</p>
                    @endif
                    <div class="flex items-center justify-between border-t border-secondary/5 pt-3">
                        @if($product->price)
                            <span class="font-heading font-black text-primary text-base">${{ number_format($product->price,2) }}</span>
                        @else
                            <span class="text-secondary/30 text-xs font-semibold">Price on request</span>
                        @endif
                        <span class="text-secondary/30 text-[10px] font-bold">MOQ: {{ $product->min_order_quantity }} {{ $product->unit }}</span>
                    </div>
                    <p class="text-secondary/30 text-[10px] mt-2">by {{ $product->vendor->company_name ?? '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══ WHY US ═══════════════════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-dot-pattern relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal-up">
            <span class="section-label"><span class="w-5 h-px bg-primary inline-block"></span> Why Choose Us</span>
            <h2 class="section-title text-4xl sm:text-5xl">Built for <span class="text-gradient italic">Global Trade</span></h2>
            <div class="section-divider mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['fas fa-shield-check', 'Verified Vendors', 'Every vendor goes through rigorous verification before being listed on our platform.', 'bg-primary/8 text-primary'],
                ['fas fa-globe-americas', 'Global Reach', 'Connect with buyers from over 50 countries worldwide through our network.', 'bg-accent/10 text-accent-dark'],
                ['fas fa-file-invoice', 'Easy RFQ Process', 'Submit a Request for Quotation in minutes and receive competitive offers fast.', 'bg-success/8 text-success'],
                ['fas fa-lock', 'Secure Platform', 'Your inquiries and data are fully encrypted and protected at every step.', 'bg-primary/8 text-primary'],
            ] as [$icon, $title, $desc, $iconBg])
            <div class="reveal-up group card p-7 hover:-translate-y-2 hover:shadow-premium hover:border-primary/10 transition-all duration-500">
                <div class="w-14 h-14 {{ $iconBg }} rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                    <i class="{{ $icon }} text-xl"></i>
                </div>
                <h3 class="font-heading font-black text-secondary text-lg mb-3">{{ $title }}</h3>
                <p class="text-secondary/50 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CTA BANNER ═══════════════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-secondary py-20">
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-accent/15 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative reveal-up">
        <span class="inline-block px-4 py-2 bg-accent/15 border border-accent/20 text-accent text-[10px] font-black uppercase tracking-[0.25em] rounded-full mb-6">Start Trading Today</span>
        <h2 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-6">
            Ready to Source <span class="text-gradient-gold italic">Globally?</span>
        </h2>
        <p class="text-white/50 text-lg mb-10 max-w-xl mx-auto leading-relaxed">Submit a Request for Quotation and connect with verified manufacturers. No hidden fees, no middlemen.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('rfq.create') }}" class="btn-accent text-[11px]"><i class="fas fa-paper-plane"></i> Submit RFQ Now</a>
            <a href="{{ route('register') }}" class="btn-outline-white text-[11px]"><i class="fas fa-user-plus"></i> Register Free</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Hero Swiper
    new Swiper('.hero-swiper', {
        loop: true,
        effect: 'fade',
        speed: 1500,
        autoplay: { delay: 7000, disableOnInteraction: false },
        pagination: { el: '.hero-pagination', clickable: true, bulletClass: 'w-2 h-2 bg-white/30 rounded-full cursor-pointer transition-all', bulletActiveClass: '!bg-white !w-8' },
        navigation: { nextEl: '.hero-next', prevEl: '.hero-prev' },
    });
</script>
@endpush
