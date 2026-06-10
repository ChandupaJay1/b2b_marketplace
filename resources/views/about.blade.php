@extends('layouts.app')
@section('title', 'About Us | B2B Marketplace')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO HEADER
═══════════════════════════════════════════════ --}}
<section class="relative py-28 lg:py-40 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
    {{-- Gradient lines --}}
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-400/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-400/40 to-transparent"></div>

    {{-- Glow orbs --}}
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 py-2 px-5 bg-white/5 border border-white/10 backdrop-blur-md text-blue-300 text-[10px] font-bold uppercase tracking-[0.25em] rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                Our Story
            </span>
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-heading font-black text-white leading-[0.9] mb-6 tracking-tight">
                About <br><span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">B2B Marketplace</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-medium max-w-xl mx-auto leading-relaxed mb-10">
                Connecting verified vendors with global buyers. Building trust, transparency, and trade excellence since day one.
            </p>
            <nav class="flex justify-center items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Home</a>
                <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                <span class="text-slate-300">About Us</span>
            </nav>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     INTRO STATS STRIP
═══════════════════════════════════════════════ --}}
<div class="bg-blue-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.08]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-white/10">
            @foreach([
                ['fa-users', '1000+', 'Verified Vendors'],
                ['fa-globe', '50+', 'Countries Served'],
                ['fa-box', '10,000+', 'Products Listed'],
                ['fa-handshake', '99%', 'Success Rate'],
            ] as [$icon, $val, $label])
            <div class="py-8 px-6 lg:px-10 text-center group">
                <i class="fas {{ $icon }} text-white/30 text-lg mb-3 block group-hover:text-amber-300 transition-colors"></i>
                <div class="text-2xl font-heading font-black text-white mb-1">{{ $val }}</div>
                <div class="text-white/50 text-[9px] font-bold uppercase tracking-widest">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     ABOUT SECTION
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
    <div class="absolute -top-40 right-0 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-indigo-200/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            {{-- Image Block --}}
            <div class="lg:w-1/2 relative group">
                <div class="relative">
                    <div class="absolute -inset-4 bg-blue-600/10 rounded-[50px] blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-700"></div>
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=600&fit=crop" 
                         class="rounded-[50px] shadow-2xl w-full relative z-10 transition-all duration-700 group-hover:scale-[1.02]"
                         alt="B2B Marketplace Team">
                    
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-8 -right-8 bg-blue-600 text-white p-8 rounded-[30px] shadow-2xl z-20 hidden xl:block">
                        <div class="text-4xl font-heading font-black leading-none">50+</div>
                        <div class="text-xs font-bold uppercase tracking-widest text-white/70 mt-1">Countries</div>
                    </div>
                </div>
            </div>

            {{-- Text Block --}}
            <div class="lg:w-1/2">
                <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Get to Know Us</span>
                <h2 class="text-3xl sm:text-4xl lg:text-6xl font-heading font-black text-slate-900 leading-tight mb-8">
                    Building <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Global Trade</span> Connections
                </h2>
                <p class="text-slate-600 mb-6 leading-relaxed text-sm">
                    B2B Marketplace is the premier platform connecting verified vendors with global buyers. We facilitate seamless business-to-business transactions across diverse industries, from agriculture and manufacturing to technology and services.
                </p>
                <p class="text-slate-600 mb-6 leading-relaxed text-sm">
                    Our mission is to create a trusted ecosystem where businesses can discover, connect, and trade with confidence. Every vendor on our platform undergoes rigorous verification to ensure quality, reliability, and professionalism.
                </p>
                <p class="text-slate-600 mb-10 leading-relaxed text-sm">
                    With advanced features like Request for Quotation (RFQ), multi-vendor product support, and comprehensive vendor profiles, we're transforming how businesses source products and services globally.
                </p>

                <div class="grid grid-cols-2 gap-6 mt-10">
                    @foreach([
                        ['shield-halved', 'Verified Vendors'], 
                        ['earth-americas', 'Global Reach'], 
                        ['lock', 'Secure Transactions'], 
                        ['headset', '24/7 Support']
                    ] as [$icon, $label])
                    <div class="flex items-center gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-200 hover:border-blue-300 hover:bg-white group transition-all">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                            <i class="fa-solid fa-{{ $icon }} text-xl"></i>
                        </div>
                        <span class="font-bold text-slate-900 text-base">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     MISSION & VALUES
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-white relative overflow-hidden border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">What Drives Us</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                Our Mission & <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Core Values</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['fa-bullseye', 'Our Mission', 'To empower businesses worldwide by providing a trusted platform for discovering quality products, connecting with verified vendors, and executing seamless B2B transactions.'],
                ['fa-eye', 'Our Vision', 'To become the world\'s most trusted B2B marketplace, where every business—regardless of size—can access global trade opportunities with confidence and ease.'],
                ['fa-heart', 'Our Values', 'Integrity, transparency, and customer success drive everything we do. We believe in building lasting relationships through trust, quality, and exceptional service.']
            ] as [$icon, $title, $desc])
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-[40px] p-10 lg:p-12 group hover:shadow-2xl hover:scale-105 transition-all duration-500 relative overflow-hidden">
                {{-- Background decoration --}}
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/5 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/5 rounded-full translate-x-1/2 translate-y-1/2"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white text-2xl mb-8 group-hover:scale-110 transition-transform">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <h4 class="text-xl font-black text-white mb-4">{{ $title }}</h4>
                    <p class="text-white/80 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     HOW IT WORKS
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Simple Process</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                How It <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Works</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['1', 'fa-user-plus', 'Register', 'Create your free account as a buyer or vendor in minutes'],
                ['2', 'fa-search', 'Discover', 'Browse verified vendors and thousands of quality products'],
                ['3', 'fa-file-invoice-dollar', 'Request Quotes', 'Submit RFQs and receive competitive quotations'],
                ['4', 'fa-handshake', 'Trade', 'Connect directly with vendors and complete transactions'],
            ] as [$num, $icon, $title, $desc])
            <div class="text-center group">
                <div class="relative inline-block mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center text-sm font-black">
                        {{ $num }}
                    </div>
                </div>
                <h3 class="font-heading font-black text-slate-900 text-lg mb-2">{{ $title }}</h3>
                <p class="text-slate-600 text-sm font-medium">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     FEATURES GRID
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Platform Features</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                Why Choose <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Our Platform</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['shield-check', 'Verified Vendors', 'Every vendor undergoes strict verification before joining our platform'],
                ['magnifying-glass', 'Advanced Search', 'Find exactly what you need with powerful filters and categories'],
                ['file-invoice', 'RFQ System', 'Submit requests and receive multiple competitive quotations'],
                ['store', 'Multi-Vendor Products', 'Compare prices from different vendors for the same product'],
                ['comments', 'Direct Communication', 'Connect with vendors through our secure messaging system'],
                ['chart-line', 'Analytics Dashboard', 'Track your orders, quotes, and business performance'],
            ] as [$icon, $title, $desc])
            <div class="bg-white rounded-2xl p-8 group hover:shadow-xl transition-all duration-300 border border-slate-200 relative overflow-hidden">
                {{-- Hover gradient background --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center text-blue-600 text-xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
                        <i class="fa-solid fa-{{ $icon }}"></i>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-3">{{ $title }}</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     SUPPORTED BY COMPANIES
═══════════════════════════════════════════════ --}}
<section class="py-16 lg:py-24 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-slate-400 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Trusted Partners</span>
            <h2 class="text-3xl sm:text-4xl font-heading font-black text-slate-900">
                Supported By <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Leading Organizations</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            {{-- Logo 1 - JICA --}}
            <div class="group flex items-center justify-center p-8 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-200">
                <img src="{{ asset('images/logos/japan-international-cooperation-agency-seeklogo.png') }}" 
                     alt="Japan International Cooperation Agency" 
                     class="max-h-20 w-auto object-contain grayscale group-hover:grayscale-0 transition-all duration-300 opacity-60 group-hover:opacity-100">
            </div>

            {{-- Logo 2 - Placeholder --}}
            <div class="group flex items-center justify-center p-8 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-building text-3xl text-blue-600"></i>
                    </div>
                    <p class="text-sm font-bold text-slate-400">Partner Logo</p>
                </div>
            </div>

            {{-- Logo 3 - Placeholder --}}
            <div class="group flex items-center justify-center p-8 bg-slate-50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-slate-200">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-handshake text-3xl text-purple-600"></i>
                    </div>
                    <p class="text-sm font-bold text-slate-400">Partner Logo</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <p class="text-slate-500 text-sm font-medium">
                Supported by international organizations committed to fostering global trade and economic development
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     PARALLAX SECTION
═══════════════════════════════════════════════ --}}
<section class="py-24 lg:py-40 relative text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-fixed bg-center" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&h=1080&fit=crop');"></div>
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="text-amber-300 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Join Our Community</span>
        <h2 class="text-3xl sm:text-4xl lg:text-6xl font-heading font-black mb-6 leading-tight">
            Trusted by Businesses <br> <span class="text-amber-300 italic">Around the Globe</span>
        </h2>
        <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed mb-10">
            From small enterprises to large corporations, businesses worldwide trust our platform for their B2B sourcing needs.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('register') }}" class="px-10 py-5 bg-blue-600 text-white rounded-full font-bold text-sm uppercase tracking-wider hover:bg-blue-700 transition-all shadow-xl hover:scale-105">
                Get Started Free
            </a>
            <a href="{{ route('contact') }}" class="px-10 py-5 bg-transparent border-2 border-white text-white rounded-full font-bold text-sm uppercase tracking-wider hover:bg-white hover:text-slate-900 transition-all hover:scale-105">
                Contact Us
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     CTA SECTION
═══════════════════════════════════════════════ --}}
<section class="py-16 lg:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-[40px] p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.05]"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black text-white mb-6 leading-none">
                    Ready to Start <span class="italic text-amber-300">Trading?</span>
                </h2>
                <p class="text-white/80 mb-10 text-sm leading-relaxed">
                    Join thousands of businesses already using our platform to source products, connect with suppliers, and grow their trade networks.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-blue-600 rounded-full font-black text-sm tracking-wider uppercase hover:bg-slate-900 hover:text-white transition-all shadow-lg hover:scale-105">
                        Create Account
                    </a>
                    <a href="{{ route('vendors.index') }}" class="w-full sm:w-auto px-10 py-5 bg-transparent border-2 border-white text-white rounded-full font-black text-sm tracking-wider uppercase hover:bg-white hover:text-blue-600 transition-all hover:scale-105">
                        Browse Vendors
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Smooth scroll animations
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    });
</script>
@endpush
