@extends('layouts.app')
@section('title', 'About Us | B2B Marketplace')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO HEADER
═══════════════════════════════════════════════ --}}
<section class="relative py-28 lg:py-40 bg-gradient-to-br from-secondary via-primary-dark to-secondary overflow-hidden">
    {{-- Gradient lines --}}
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-primary/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-primary/40 to-transparent"></div>

    {{-- Glow orbs --}}
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 py-2 px-5 bg-white/5 border border-white/10 backdrop-blur-md text-primary/60 text-[10px] font-bold uppercase tracking-[0.25em] rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                Our Story
            </span>
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-heading font-black text-white leading-[0.9] mb-6 tracking-tight">
                About <br><span class="bg-gradient-to-r from-accent to-accent-dark bg-clip-text text-transparent italic">B2B Marketplace</span>
            </h1>
            <p class="text-white/60 text-sm sm:text-base font-medium max-w-xl mx-auto leading-relaxed mb-10">
                Connecting verified vendors with global buyers. Building trust, transparency, and trade excellence since day one.
            </p>
            <nav class="flex justify-center items-center gap-2 text-white/50 text-[10px] font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                <span class="text-white/60">About Us</span>
            </nav>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     INTRO STATS STRIP
═══════════════════════════════════════════════ --}}
<div class="bg-primary relative overflow-hidden">
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
                <i class="fas {{ $icon }} text-white/30 text-lg mb-3 block group-hover:text-accent transition-colors"></i>
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
<section class="py-20 lg:py-32 bg-gradient-to-b from-surface to-white relative overflow-hidden">
    <div class="absolute -top-40 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            {{-- Image Block --}}
            <div class="lg:w-1/2 relative group">
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary/10 rounded-[50px] blur-2xl opacity-0 group-hover:opacity-100 transition-all duration-700"></div>
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=600&fit=crop" 
                         class="rounded-[50px] shadow-2xl w-full relative z-10 transition-all duration-700 group-hover:scale-[1.02]"
                         alt="B2B Marketplace Team">
                    
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-8 -right-8 bg-primary text-white p-8 rounded-[30px] shadow-2xl z-20 hidden xl:block">
                        <div class="text-4xl font-heading font-black leading-none">50+</div>
                        <div class="text-xs font-bold uppercase tracking-widest text-white/70 mt-1">Countries</div>
                    </div>
                </div>
            </div>

            {{-- Text Block --}}
            <div class="lg:w-1/2">
                <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Get to Know Us</span>
                <h2 class="text-3xl sm:text-4xl lg:text-6xl font-heading font-black text-secondary leading-tight mb-8">
                    Building <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Global Trade</span> Connections
                </h2>
                <p class="text-secondary/70 mb-6 leading-relaxed text-sm">
                    B2B Marketplace is the premier platform connecting verified vendors with global buyers. We facilitate seamless business-to-business transactions across diverse industries, from agriculture and manufacturing to technology and services.
                </p>
                <p class="text-secondary/70 mb-6 leading-relaxed text-sm">
                    Our mission is to create a trusted ecosystem where businesses can discover, connect, and trade with confidence. Every vendor on our platform undergoes rigorous verification to ensure quality, reliability, and professionalism.
                </p>
                <p class="text-secondary/70 mb-10 leading-relaxed text-sm">
                    With advanced features like Request for Quotation (RFQ), multi-vendor product support, and comprehensive vendor profiles, we're transforming how businesses source products and services globally.
                </p>

                <div class="grid grid-cols-2 gap-6 mt-10">
                    @foreach([
                        ['shield-halved', 'Verified Vendors'], 
                        ['earth-americas', 'Global Reach'], 
                        ['lock', 'Secure Transactions'], 
                        ['headset', '24/7 Support']
                    ] as [$icon, $label])
                    <div class="flex items-center gap-4 p-5 bg-surface rounded-2xl border border-secondary/20 hover:border-primary hover:bg-white group transition-all">
                        <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary flex-shrink-0">
                            <i class="fa-solid fa-{{ $icon }} text-xl"></i>
                        </div>
                        <span class="font-bold text-secondary text-base">{{ $label }}</span>
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
<section class="py-20 lg:py-32 bg-white relative overflow-hidden border-t border-secondary/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-4 block">What Drives Us</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-secondary leading-none">
                Our Mission & <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Core Values</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['fa-bullseye', 'Our Mission', 'To empower businesses worldwide by providing a trusted platform for discovering quality products, connecting with verified vendors, and executing seamless B2B transactions.'],
                ['fa-eye', 'Our Vision', 'To become the world\'s most trusted B2B marketplace, where every business—regardless of size—can access global trade opportunities with confidence and ease.'],
                ['fa-heart', 'Our Values', 'Integrity, transparency, and customer success drive everything we do. We believe in building lasting relationships through trust, quality, and exceptional service.']
            ] as [$icon, $title, $desc])
            <div class="bg-gradient-to-br from-primary to-primary-dark rounded-[40px] p-10 lg:p-12 group hover:shadow-2xl hover:scale-105 transition-all duration-500 relative overflow-hidden">
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
<section class="py-20 lg:py-32 bg-gradient-to-b from-surface to-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Simple Process</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-secondary leading-none">
                How It <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Works</span>
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
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-accent text-white rounded-full flex items-center justify-center text-sm font-black">
                        {{ $num }}
                    </div>
                </div>
                <h3 class="font-heading font-black text-secondary text-lg mb-2">{{ $title }}</h3>
                <p class="text-secondary/70 text-sm font-medium">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     FEATURES GRID
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-white border-t border-secondary/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Platform Features</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-secondary leading-none">
                Why Choose <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Our Platform</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['shield-halved', 'Verified Vendors', 'Every vendor undergoes strict verification before joining our platform'],
                ['magnifying-glass', 'Advanced Search', 'Find exactly what you need with powerful filters and categories'],
                ['file-invoice', 'RFQ System', 'Submit requests and receive multiple competitive quotations'],
                ['store', 'Multi-Vendor Products', 'Compare prices from different vendors for the same product'],
                ['comments', 'Direct Communication', 'Connect with vendors through our secure messaging system'],
                ['chart-line', 'Analytics Dashboard', 'Track your orders, quotes, and business performance'],
            ] as [$icon, $title, $desc])
            <div class="bg-white rounded-2xl p-8 group hover:shadow-xl transition-all duration-300 border border-secondary/20 relative overflow-hidden">
                {{-- Hover gradient background --}}
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary/10 to-primary/20 rounded-xl flex items-center justify-center text-primary text-xl mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
                        <i class="fa-solid fa-{{ $icon }}"></i>
                    </div>
                    <h4 class="text-lg font-black text-secondary mb-3">{{ $title }}</h4>
                    <p class="text-secondary/70 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     SUPPORTED BY COMPANIES
═══════════════════════════════════════════════ --}}
<section class="py-16 lg:py-24 bg-white border-t border-secondary/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-white/50 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Trusted Partners</span>
            <h2 class="text-3xl sm:text-4xl font-heading font-black text-secondary">
                Supported By <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Leading Organizations</span>
            </h2>
        </div>

        @php
        $partners = [
            [
                'name'    => 'Ethical Offerings Expo Market',
                'short'   => 'Ethical',
                'color'   => 'primary',
                'logo'    => asset('images/logos/ethical_logo.jpeg'),
                'icon'    => null,
                'mission' => 'To connect manufacturers with buyers worldwide through a trusted, transparent, and efficient B2B marketplace platform that promotes ethical trade practices and sustainable business growth.',
                'vision'  => 'To be the premier global B2B marketplace where authenticity, quality, and trust drive every transaction — empowering businesses to thrive through ethical and responsible trade.',
            ],
            [
                'name'    => 'Japan International Cooperation Agency',
                'short'   => 'JICA',
                'color'   => 'primary',
                'logo'    => asset('images/logos/japan-international-cooperation-agency-seeklogo.png'),
                'icon'    => null,
                'mission' => 'To contribute to the promotion of international cooperation and the sound development of the Japanese and global economy by supporting the socioeconomic development, recovery, and economic stability of developing regions.',
                'vision'  => 'A world where all people can live with dignity and hope — a world without poverty where the global environment is sustained for future generations.',
            ],
            [
                'name'    => 'Industrial Development Authority',
                'short'   => 'IDA',
                'color'   => 'primary',
                'logo'    => asset('images/logos/ida_logo.jpeg'),
                'icon'    => null,
                'mission' => 'To facilitate and promote industrial development in Sri Lanka by attracting local and foreign investment, providing infrastructure, and supporting enterprises to enhance the country\'s industrial competitiveness.',
                'vision'  => 'To be the leading catalyst for a vibrant, sustainable, and globally competitive industrial sector that drives economic growth and creates quality employment opportunities for all Sri Lankans.',
            ],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            @foreach($partners as $i => $partner)
            <button type="button"
                    onclick="openPartnerModal({{ $i }})"
                    class="group w-full text-left flex flex-col items-center justify-center p-8 bg-surface rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 border border-secondary/20 hover:border-primary/20 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 relative">

                {{-- Click hint badge --}}
                <span class="absolute top-3 right-3 text-[9px] font-bold uppercase tracking-wider text-white/50 group-hover:text-primary/50 transition-colors flex items-center gap-1">
                    <i class="fas fa-mouse-pointer text-[8px]"></i> View Details
                </span>

                @if($partner['logo'])
                    <img src="{{ $partner['logo'] }}"
                         alt="{{ $partner['name'] }}"
                         class="max-h-20 w-auto object-contain grayscale group-hover:grayscale-0 transition-all duration-300 opacity-60 group-hover:opacity-100">
                @else
                    <div class="w-20 h-20 bg-gradient-to-br from-primary/10 to-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas {{ $partner['icon'] }} text-3xl text-primary"></i>
                    </div>
                    <p class="text-sm font-bold text-secondary/60 group-hover:text-secondary/80 transition-colors text-center">{{ $partner['name'] }}</p>
                @endif
            </button>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <p class="text-secondary/60 text-sm font-medium">
                Supported by international organizations committed to fostering global trade and economic development
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     PARTNER MODAL
═══════════════════════════════════════════════ --}}
<div id="partner-modal"
     class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden"
     aria-modal="true" role="dialog" aria-labelledby="modal-partner-name">

    {{-- Backdrop --}}
    <div id="modal-backdrop"
         class="absolute inset-0 bg-secondary/70 backdrop-blur-sm"
         onclick="closePartnerModal()"></div>

    {{-- Panel --}}
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden
                transform transition-all duration-300 scale-95 opacity-0"
         id="modal-panel">

        {{-- Top gradient bar --}}
        <div class="h-2 bg-gradient-to-r from-primary via-primary-dark to-primary"></div>

        {{-- Header --}}
        <div class="flex items-start justify-between p-7 pb-5">
            <div class="flex items-center gap-4">
                <div id="modal-icon-wrap"
                     class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 bg-primary/10">
                    {{-- filled by JS --}}
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-primary mb-0.5">Trusted Partner</p>
                    <h3 id="modal-partner-name" class="text-lg font-black text-secondary leading-tight"></h3>
                </div>
            </div>
            <button onclick="closePartnerModal()"
                    class="w-9 h-9 flex items-center justify-center rounded-xl text-white/50 hover:text-secondary/80 hover:bg-surface transition-all flex-shrink-0 ml-3">
                <i class="fas fa-times text-base"></i>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-7 pb-8 space-y-6">
            {{-- Mission --}}
            <div class="bg-primary/5 rounded-2xl p-5 border border-primary/10">
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="w-7 h-7 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bullseye text-white text-xs"></i>
                    </div>
                    <h4 class="font-black text-secondary text-sm uppercase tracking-wider">Our Mission</h4>
                </div>
                <p id="modal-mission" class="text-secondary/70 text-sm leading-relaxed"></p>
            </div>

            {{-- Vision --}}
            <div class="bg-primary/5 rounded-2xl p-5 border border-primary/10">
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="w-7 h-7 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-eye text-white text-xs"></i>
                    </div>
                    <h4 class="font-black text-secondary text-sm uppercase tracking-wider">Our Vision</h4>
                </div>
                <p id="modal-vision" class="text-secondary/70 text-sm leading-relaxed"></p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     PARALLAX SECTION
═══════════════════════════════════════════════ --}}
<section class="py-24 lg:py-40 relative text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-fixed bg-center" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&h=1080&fit=crop');"></div>
    <div class="absolute inset-0 bg-secondary/80 backdrop-blur-sm"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="text-accent font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Join Our Community</span>
        <h2 class="text-3xl sm:text-4xl lg:text-6xl font-heading font-black mb-6 leading-tight">
            Trusted by Businesses <br> <span class="text-accent italic">Around the Globe</span>
        </h2>
        <p class="text-xl text-white/80 max-w-2xl mx-auto leading-relaxed mb-10">
            From small enterprises to large corporations, businesses worldwide trust our platform for their B2B sourcing needs.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('register') }}" class="px-10 py-5 bg-primary text-white rounded-full font-bold text-sm uppercase tracking-wider hover:bg-primary-dark transition-all shadow-xl hover:scale-105">
                Get Started Free
            </a>
            <a href="{{ route('contact') }}" class="px-10 py-5 bg-transparent border-2 border-white text-white rounded-full font-bold text-sm uppercase tracking-wider hover:bg-white hover:text-secondary transition-all hover:scale-105">
                Contact Us
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     CTA SECTION
═══════════════════════════════════════════════ --}}
<section class="py-16 lg:py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-primary to-primary-dark rounded-[40px] p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.05]"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black text-white mb-6 leading-none">
                    Ready to Start <span class="italic text-accent">Trading?</span>
                </h2>
                <p class="text-white/80 mb-10 text-sm leading-relaxed">
                    Join thousands of businesses already using our platform to source products, connect with suppliers, and grow their trade networks.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-primary rounded-full font-black text-sm tracking-wider uppercase hover:bg-secondary hover:text-white transition-all shadow-lg hover:scale-105">
                        Create Account
                    </a>
                    <a href="{{ route('vendors.index') }}" class="w-full sm:w-auto px-10 py-5 bg-transparent border-2 border-white text-white rounded-full font-black text-sm tracking-wider uppercase hover:bg-white hover:text-primary transition-all hover:scale-105">
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
    // ── Partner Modal ────────────────────────────────────────────────
    const partners = [
        {
            name:    "Ethical Offerings Expo Market",
            logo:    "{{ asset('images/logos/ethical_logo.jpeg') }}",
            icon:    null,
            color:   "primary",
            mission: "To connect manufacturers with buyers worldwide through a trusted, transparent, and efficient B2B marketplace platform that promotes ethical trade practices and sustainable business growth.",
            vision:  "To be the premier global B2B marketplace where authenticity, quality, and trust drive every transaction — empowering businesses to thrive through ethical and responsible trade."
        },
        {
            name:    "Japan International Cooperation Agency",
            logo:    "{{ asset('images/logos/japan-international-cooperation-agency-seeklogo.png') }}",
            icon:    null,
            color:   "primary",
            mission: "To contribute to the promotion of international cooperation and the sound development of the Japanese and global economy by supporting the socioeconomic development, recovery, and economic stability of developing regions.",
            vision:  "A world where all people can live with dignity and hope — a world without poverty where the global environment is sustained for future generations."
        },
        {
            name:    "Industrial Development Authority",
            logo:    "{{ asset('images/logos/ida_logo.jpeg') }}",
            icon:    null,
            color:   "primary",
            mission: "To facilitate and promote industrial development in Sri Lanka by attracting local and foreign investment, providing infrastructure, and supporting enterprises to enhance the country's industrial competitiveness.",
            vision:  "To be the leading catalyst for a vibrant, sustainable, and globally competitive industrial sector that drives economic growth and creates quality employment opportunities for all Sri Lankans."
        }
    ];

    const modal    = document.getElementById('partner-modal');
    const panel    = document.getElementById('modal-panel');
    const iconWrap = document.getElementById('modal-icon-wrap');

    function openPartnerModal(index) {
        const p = partners[index];

        document.getElementById('modal-partner-name').textContent = p.name;
        document.getElementById('modal-mission').textContent      = p.mission;
        document.getElementById('modal-vision').textContent       = p.vision;

        if (p.logo) {
            iconWrap.innerHTML = `<img src="${p.logo}" alt="${p.name}" class="w-10 h-10 object-contain">`;
            iconWrap.className = 'w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 bg-surface p-2';
        } else {
            const cls = 'bg-primary/10 text-primary';
            iconWrap.innerHTML = `<i class="fas ${p.icon} text-2xl"></i>`;
            iconWrap.className = `w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0 ${cls}`;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            panel.classList.remove('scale-95', 'opacity-0');
            panel.classList.add('scale-100', 'opacity-100');
        });
    }

    function closePartnerModal() {
        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 200);
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closePartnerModal();
    });

    // ── Scroll reveal ────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });
    });
</script>
@endpush
