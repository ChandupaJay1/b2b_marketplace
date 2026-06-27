@extends('layouts.app')

@section('title', 'B2B Marketplace | Global Trade Platform')

@section('content')
    {{-- [HERO] Cinematic Immersive Slider --}}
    <section class="relative h-screen min-h-[700px] overflow-hidden bg-gradient-to-br from-secondary via-primary-dark to-secondary">
        <div class="swiper thm-swiper__slider h-full bg-noise-overlay" data-swiper-options='{
            "slidesPerView": 1,
            "loop": true,
            "effect": "fade",
            "speed": 1500,
            "autoplay": { "delay": 7000, "disableOnInteraction": false },
            "pagination": { "el": ".hero-pagination", "clickable": true }
        }'>
            <div class="swiper-wrapper h-full">
                {{-- Slide 1: Connect with Vendors --}}
                <div class="swiper-slide group relative h-full">
                    <div class="absolute inset-0 scale-110 transition-transform duration-[10000ms] group-[.swiper-slide-active]:scale-100">
                        <img src="{{ asset('images/slider/img-1.jpg') }}" class="w-full h-full object-cover" alt="B2B Marketplace">
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/60 to-transparent"></div>
                        {{-- Liquid Glass Effect --}}
                        <div class="absolute inset-0 backdrop-blur-[2px]">
                            <div class="absolute top-0 left-0 w-full h-full">
                                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-blob"></div>
                                <div class="absolute top-1/3 right-1/3 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                                <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-4xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0 delay-500">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary/60 rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                                <span class="w-2 h-2 bg-primary rounded-full animate-ping"></span>
                                Global B2B Platform
                            </span>
                            <h1 class="text-5xl sm:text-7xl lg:text-[90px] xl:text-[100px] font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                                Connect with <br> <span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Verified</span> <br> Vendors
                            </h1>
                            <p class="text-xl sm:text-2xl font-medium text-white/60 mb-12 max-w-xl leading-relaxed">
                                Source quality products from verified suppliers worldwide. Secure, transparent, and efficient B2B trading platform.
                            </p>
                            <div class="flex items-center gap-6">
                                <a href="{{ route('vendors.index') }}" class="group relative px-9 py-4.5 bg-primary text-white rounded-full font-black text-sm tracking-wider uppercase overflow-hidden transition-all shadow-lg shadow-primary/30 flex items-center justify-center scale-100 hover:scale-105 active:scale-95">
                                    <span class="relative z-10 transition-all duration-300 group-hover:-translate-y-12 group-hover:opacity-0">Explore Vendors</span>
                                    <div class="absolute inset-0 bg-white translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                    <span class="absolute inset-0 flex items-center justify-center text-primary font-black translate-y-12 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">Browse Now</span>
                                </a>
                                <div class="hidden sm:flex items-center gap-4 text-white/50">
                                    <div class="w-12 h-[1px] bg-white/20"></div>
                                    <span class="text-xs font-bold uppercase tracking-widest italic">Trusted Platform</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2: Request Quotations --}}
                <div class="swiper-slide group relative h-full">
                    <div class="absolute inset-0 scale-110 transition-transform duration-[10000ms] group-[.swiper-slide-active]:scale-100">
                        <img src="{{ asset('images/slider/img-2.jpg') }}" class="w-full h-full object-cover" alt="Request for Quotation">
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/60 to-transparent"></div>
                        {{-- Liquid Glass Effect --}}
                        <div class="absolute inset-0 backdrop-blur-[2px]">
                            <div class="absolute top-0 left-0 w-full h-full">
                                <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl animate-blob"></div>
                                <div class="absolute bottom-1/3 left-1/4 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                                <div class="absolute top-1/2 right-1/3 w-96 h-96 bg-yellow-500/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-4xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0 delay-500">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/20 backdrop-blur-md border border-amber-400/30 text-amber-300 rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                                <span class="w-2 h-2 bg-amber-400 rounded-full animate-ping"></span>
                                Smart Sourcing
                            </span>
                            <h2 class="text-5xl sm:text-7xl lg:text-[90px] xl:text-[100px] font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                                Request for <br> <span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Quotation</span>
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-white/60 mb-12 max-w-xl leading-relaxed">
                                Submit your requirements once. Receive competitive quotes from multiple verified vendors within 48 hours.
                            </p>
                            <div class="flex items-center gap-6">
                                <a href="{{ route('rfq.create') }}" class="px-9 py-4.5 bg-transparent border-2 border-white text-white rounded-full font-black text-sm tracking-wider uppercase hover:bg-white hover:text-secondary transition-all shadow-lg hover:scale-105 active:scale-95">
                                    Get Quotes Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 3: Global Trade Network --}}
                <div class="swiper-slide group relative h-full">
                    <div class="absolute inset-0 scale-110 transition-transform duration-[10000ms] group-[.swiper-slide-active]:scale-100">
                        <img src="{{ asset('images/slider/img-3.jpg') }}" class="w-full h-full object-cover" alt="Global Trade Network">
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/60 to-transparent"></div>
                        {{-- Liquid Glass Effect --}}
                        <div class="absolute inset-0 backdrop-blur-[2px]">
                            <div class="absolute top-0 left-0 w-full h-full">
                                <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-blob"></div>
                                <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                                <div class="absolute bottom-1/3 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center relative z-10">
                        <div class="max-w-4xl opacity-0 translate-y-10 transition-all duration-1000 group-[.swiper-slide-active]:opacity-100 group-[.swiper-slide-active]:translate-y-0 delay-500">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 backdrop-blur-md border border-primary/30 text-primary/60 rounded-full text-xs font-black uppercase tracking-[0.2em] mb-8">
                                <span class="w-2 h-2 bg-primary rounded-full animate-ping"></span>
                                Secure Trading
                            </span>
                            <h2 class="text-5xl sm:text-7xl lg:text-[90px] xl:text-[100px] font-heading font-black text-white leading-[0.95] mb-8 tracking-tight">
                                Global Trade <br> <span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Network</span>
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-white/60 mb-12 max-w-xl leading-relaxed">
                                Join 1000+ verified vendors serving buyers across 50+ countries. Trusted, transparent, and efficient.
                            </p>
                            <div class="flex items-center gap-6">
                                <a href="{{ route('register') }}" class="px-9 py-4.5 bg-white text-secondary rounded-full font-black text-sm tracking-wider uppercase hover:bg-primary hover:text-white transition-all shadow-xl hover:scale-105 active:scale-95">
                                    Join Platform
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero Extras --}}
            <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex justify-between items-end pointer-events-none">
                <div class="hero-pagination flex gap-2 pointer-events-auto"></div>
                <div class="hidden lg:block animate-bounce opacity-30">
                    <div class="w-px h-24 bg-gradient-to-b from-white to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- [BENTO GRID] Why Choose Us --}}
    <section class="py-20 lg:py-32 bg-gradient-to-b from-surface to-white relative overflow-hidden">
        {{-- Background texture --}}
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-blue-200/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-indigo-200/20 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Section heading --}}
            <div class="text-center mb-16 max-w-2xl mx-auto reveal-section">
                <span class="inline-flex items-center gap-2 text-primary font-black uppercase tracking-[0.25em] text-[10px] mb-5">
                    <span class="w-6 h-[1px] bg-primary"></span>
                    Platform Benefits
                    <span class="w-6 h-[1px] bg-primary"></span>
                </span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-black text-secondary leading-[1.05]">
                    Where Quality Meets <br><span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Trust</span>
                </h2>
            </div>

            {{-- Modern Bento Grid Design --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-6">
                
                {{-- Card 1: Verified Vendors (Large - 2 cols, tall) --}}
                <div class="lg:col-span-2 lg:row-span-2 relative rounded-3xl overflow-hidden group reveal-left shadow-2xl bg-gradient-to-br from-primary to-primary-dark p-10">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
                    <div class="relative z-10 h-full flex flex-col">
                        <div class="inline-flex items-center gap-2 w-fit px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                            <div class="w-2 h-2 bg-accent rounded-full animate-pulse"></div>
                            <span class="text-white text-[10px] font-bold uppercase tracking-wider">Verified & Trusted</span>
                        </div>
                        <h3 class="text-4xl lg:text-5xl font-black text-white leading-[1.1] mb-4">
                            100%<br/>Verified<br/><span class="text-amber-300">Vendors</span>
                        </h3>
                        <p class="text-white/70 text-sm leading-relaxed mb-auto">
                            Every vendor undergoes rigorous verification before joining our platform.
                        </p>
                        <div class="mt-8 flex items-center gap-3 p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                            <div class="w-12 h-12 bg-amber-400 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-check text-secondary text-xl"></i>
                            </div>
                            <div>
                                <div class="text-white font-black text-sm">Quality Assured</div>
                                <div class="text-white/60 text-xs">Trusted by 1000+ businesses</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: 50+ Countries --}}
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden group reveal-up shadow-xl bg-secondary p-8">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-globe text-white text-2xl"></i>
                        </div>
                        <div class="text-5xl font-black text-white mb-2">50<span class="text-primary">+</span></div>
                        <h4 class="text-lg font-bold text-white mb-2">Countries</h4>
                        <p class="text-secondary/50 text-sm">Connect with vendors and buyers worldwide</p>
                    </div>
                </div>

                {{-- Card 3: Secure Transactions --}}
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden group reveal-up shadow-xl bg-white p-8 border border-secondary/10">
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-primary/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-all">
                            <i class="fas fa-lock text-primary text-2xl group-hover:text-white transition-colors"></i>
                        </div>
                        <h4 class="text-2xl font-black text-secondary mb-2">Secure<br/>Transactions</h4>
                        <p class="text-secondary/60 text-sm">Protected payment processing and secure communication</p>
                    </div>
                </div>

                {{-- Card 4: RFQ System --}}
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden group reveal-up shadow-xl bg-gradient-to-br from-amber-400 to-orange-500 p-8">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2240%22 height=%2240%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M0 20h40M20 0v40%22 stroke=%22white%22 stroke-width=%220.5%22 opacity=%220.1%22/%3E%3C/svg%3E')]"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-file-invoice text-white text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-white mb-2">RFQ System</h4>
                        <p class="text-white/80 text-sm">One request, multiple competitive quotes</p>
                    </div>
                </div>

                {{-- Card 5: 24/7 Support --}}
                <div class="lg:col-span-2 relative rounded-3xl overflow-hidden group reveal-up shadow-xl bg-surface p-8 border-2 border-secondary/10">
                    <div class="flex flex-col h-full">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-secondary mb-2">24/7 Support</h4>
                        <p class="text-secondary/60 text-sm">Dedicated team ready to assist you anytime</p>
                    </div>
                </div>

                {{-- Card 6: Start Trading (CTA) --}}
                <div class="lg:col-span-6 relative rounded-3xl overflow-hidden group reveal-up shadow-2xl bg-gradient-to-br from-indigo-600 to-blue-600 p-10">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_70%,rgba(255,255,255,0.1)_0%,transparent_50%)]"></div>
                    <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-rocket text-white text-3xl"></i>
                            </div>
                            <div>
                                <h4 class="text-3xl font-black text-white">Start Trading Today</h4>
                                <p class="text-white/70 text-sm mt-1">Join thousands of businesses on our platform</p>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary rounded-xl font-bold text-sm hover:bg-amber-300 hover:text-secondary transition-all group-hover:gap-4 flex-shrink-0 shadow-xl">
                            <span>Get Started Free</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- [STORY & TIMELINE] Our Journey --}}
    <section class="py-24 lg:py-36 bg-white relative overflow-hidden border-t border-secondary/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-20 lg:gap-24">
                {{-- Visual Story --}}
                <div class="lg:w-1/2 relative reveal-left">
                    <span class="text-primary font-black uppercase tracking-[0.2em] text-xs mb-4 block">How It Works</span>
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-black text-secondary mb-10 leading-[1.05]">Your Path to <br> <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Global Trade</span></h2>
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-primary/10 rounded-[50px] blur-2xl group-hover:bg-blue-200 transition-all opacity-0 group-hover:opacity-100"></div>
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=600&fit=crop" 
                             class="rounded-[50px] shadow-2xl relative z-10 transition-all duration-700 group-hover:scale-[1.01]" alt="B2B Trading Platform">
                        
                        <div class="absolute -bottom-10 -right-10 bg-white p-8 rounded-[30px] shadow-2xl z-20 max-w-[260px] hidden xl:block border border-secondary/10">
                            <p class="text-secondary font-bold text-sm italic leading-relaxed">"Connecting businesses worldwide with trust, transparency, and efficiency at the core of everything we do."</p>
                            <span class="text-primary text-[10px] font-black uppercase tracking-widest mt-4 block">- Our Mission</span>
                        </div>
                    </div>
                </div>

                {{-- Timeline Journey --}}
                <div class="lg:w-1/2 space-y-12 py-10">
                    <div class="relative pl-12 reveal-up">
                        <div class="absolute left-0 top-0 w-[2px] h-full bg-blue-200"></div>
                        <div class="absolute left-[-5px] top-1.5 w-[12px] h-[12px] rounded-full bg-primary shadow-lg shadow-primary/30"></div>
                        <h4 class="text-2xl font-black text-secondary mb-3">1. Register & Verify</h4>
                        <p class="text-secondary/60 leading-relaxed text-sm">Create your account and complete the verification process. We ensure all platform members are legitimate businesses.</p>
                    </div>

                    <div class="relative pl-12 reveal-up">
                        <div class="absolute left-0 top-0 w-[2px] h-full bg-blue-200"></div>
                        <div class="absolute left-[-5px] top-1.5 w-[12px] h-[12px] rounded-full bg-primary animate-pulse"></div>
                        <h4 class="text-2xl font-black text-secondary mb-3">2. Browse & Connect</h4>
                        <p class="text-secondary/60 leading-relaxed text-sm">Search thousands of verified vendors, review their profiles, products, and ratings. Connect directly with suppliers.</p>
                    </div>

                    <div class="relative pl-12 reveal-up">
                        <div class="absolute left-[-5px] top-1.5 w-[12px] h-[12px] rounded-full bg-secondary"></div>
                        <h4 class="text-2xl font-black text-secondary mb-3">3. Request & Trade</h4>
                        <p class="text-secondary/60 leading-relaxed text-sm">Submit RFQs, receive competitive quotes, negotiate terms, and complete secure transactions with confidence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- [QUOTE] Platform Philosophy --}}
    <section class="py-24 lg:py-36 bg-gradient-to-b from-surface to-white relative overflow-hidden border-t border-secondary/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-5xl mx-auto text-center bg-gradient-to-br from-slate-900 via-primary-dark to-indigo-900 text-white rounded-[50px] p-12 lg:p-20 shadow-2xl border border-slate-800 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-80 h-80 bg-primary/10 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
                <i class="fas fa-quote-left text-amber-300/20 text-8xl mb-8"></i>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-heading font-bold leading-snug italic mb-10 tracking-tight max-w-4xl mx-auto">
                    "In global trade, trust is everything. <br> <span class="text-amber-300 underline decoration-amber-300/20">B2B Marketplace</span> connects businesses with verified partners worldwide."
                </h2>
                <div class="flex flex-col items-center gap-4">
                    <div class="w-16 h-[2px] bg-amber-300/30"></div>
                    <span class="text-amber-300 font-black tracking-[0.3em] uppercase text-[10px]">Global Trade Excellence</span>
                </div>
            </div>
        </div>
    </section>

    {{-- [STATS] Platform Impact --}}
    <section class="py-20 bg-primary relative overflow-hidden shadow-2xl">
        <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
                @foreach([['50', 'Verified Vendors'], ['20', 'Countries Served'], ['500', 'Products Listed'], ['99', 'Success Rate %']] as [$count, $label])
                <div class="text-center group">
                    <div class="text-5xl sm:text-6xl font-heading font-black text-white mb-3 transition-transform group-hover:scale-105">
                        <span class="odometer" data-count="{{ $count }}">0</span><span class="text-2xl text-amber-300 inline-block -ml-1">+</span>
                    </div>
                    <span class="text-white/70 font-black uppercase tracking-[0.2em] text-[10px] block">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- [VENDORS] Featured Vendors Section --}}
    <section class="py-24 lg:py-36 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 lg:mb-24 max-w-3xl mx-auto">
                <span class="text-primary font-black uppercase tracking-[0.2em] text-xs mb-4 block">Trusted Partners</span>
                <h2 class="text-4xl sm:text-5xl font-heading font-black text-secondary leading-none">Featured <br> <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Verified Vendors</span></h2>
            </div>

            @php
                $featuredVendors = \App\Models\Vendor::where('status', 'approved')
                    ->where('is_featured', true)
                    ->withCount('products')
                    ->limit(6)
                    ->get();
            @endphp

            @if($featuredVendors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredVendors as $vendor)
                <a href="{{ route('vendors.show', $vendor->slug) }}" class="group relative bg-white rounded-[32px] p-8 overflow-hidden hover:-translate-y-2 transition-all duration-500 shadow-xl border border-secondary/10 hover:border-primary/20">
                    <div class="absolute top-6 right-6">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 border border-primary/20 rounded-full text-primary-dark text-[9px] font-black uppercase tracking-wider">
                            <i class="fas fa-certificate text-[8px]"></i> Verified
                        </span>
                    </div>
                    
                    @if($vendor->logo)
                    <div class="w-20 h-20 bg-surface-dark rounded-2xl flex items-center justify-center mb-6 overflow-hidden group-hover:scale-110 transition-transform">
                        <img src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->company_name }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-6 group-hover:scale-110 transition-transform">
                        {{ substr($vendor->company_name, 0, 1) }}
                    </div>
                    @endif

                    <h4 class="text-xl font-black text-secondary mb-2 group-hover:text-primary transition-colors">{{ $vendor->company_name }}</h4>
                    
                    @if($vendor->category)
                    <p class="text-secondary/60 text-xs font-medium mb-4">{{ $vendor->category->name }}</p>
                    @endif

                    <div class="flex items-center justify-between pt-4 border-t border-secondary/10">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-box text-primary text-xs"></i>
                            <span class="text-secondary font-bold text-sm">{{ $vendor->products_count }} Products</span>
                        </div>
                        @if($vendor->country)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-secondary/50 text-xs"></i>
                            <span class="text-secondary/60 text-xs font-medium">{{ $vendor->country }}</span>
                        </div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('vendors.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white rounded-full font-black text-sm tracking-wider uppercase hover:bg-primary-dark transition-all shadow-xl hover:scale-105">
                    <span>View All Vendors</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-secondary/60 text-lg">No featured vendors available at the moment.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- [CTA] Call to Action --}}
    <section class="py-12 lg:py-24 bg-gradient-to-b from-surface to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-[40px] p-12 lg:p-20 text-center relative overflow-hidden reveal-section shadow-2xl">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.08]"></div>
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/10 to-transparent"></div>
                <div class="absolute -top-32 -left-32 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-heading font-black text-white mb-6 leading-none">Ready to Start <span class="italic text-amber-300">Trading?</span></h2>
                    <p class="text-white/80 mb-10 text-sm sm:text-base leading-relaxed">Join thousands of businesses using our platform to source products, connect with suppliers, and grow their trade networks globally.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-primary rounded-full font-black text-sm tracking-wider uppercase hover:bg-secondary hover:text-white transition-all shadow-lg scale-100 hover:scale-105 active:scale-95">
                            Create Account
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 text-white font-black text-sm tracking-wider uppercase group hover:text-amber-300 transition-colors">
                            <div class="w-12 h-12 bg-white/10 border border-white/25 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all shadow-md">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-minimal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/odometer.min.js"></script>
    
    <style>
        /* Swiper Pagination Styling */
        .hero-pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .hero-pagination .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .hero-pagination .swiper-pagination-bullet-active {
            width: 32px;
            background: rgba(255, 255, 255, 0.9);
        }
        .hero-pagination .swiper-pagination-bullet:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Liquid Glass Blob Animation */
        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(20px, -50px) scale(1.1);
            }
            50% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            75% {
                transform: translate(50px, 50px) scale(1.05);
            }
        }

        .animate-blob {
            animation: blob 20s infinite ease-in-out;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Glass morphism effect */
        .backdrop-blur-\[2px\] {
            backdrop-filter: blur(2px);
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Hero Swiper Slider
            if (typeof Swiper !== 'undefined') {
                const heroSwiper = new Swiper('.thm-swiper__slider', {
                    slidesPerView: 1,
                    loop: true,
                    effect: 'fade',
                    speed: 1500,
                    autoplay: {
                        delay: 7000,
                        disableOnInteraction: false,
                    },
                    fadeEffect: {
                        crossFade: true
                    },
                    pagination: {
                        el: '.hero-pagination',
                        clickable: true,
                    },
                    on: {
                        init: function () {
                            console.log('Hero Swiper initialized successfully');
                        }
                    }
                });
            } else {
                console.error('Swiper is not loaded');
            }

            // Odometer Logic
            const odometers = document.querySelectorAll('.odometer');
            const oObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        target.innerHTML = target.getAttribute('data-count');
                        oObserver.unobserve(target);
                    }
                });
            }, { threshold: 0.5 });
            odometers.forEach(o => oObserver.observe(o));

            // Reveal Animation Logic
            const reveals = document.querySelectorAll('.reveal-section, .reveal-left, .reveal-right, .reveal-up');
            const rObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        rObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            reveals.forEach(r => rObserver.observe(r));
        });
    </script>
@endpush
