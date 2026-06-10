<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'B2B Marketplace — Global Trade Platform')</title>
    <meta name="description" content="@yield('meta_description', 'Discover local manufacturers and connect with verified vendors for international trade.')">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-surface font-sans text-secondary overflow-x-hidden">

{{-- ══ PRELOADER ═══════════════════════════════════════════════════════════════════════════ --}}
<div id="preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-secondary via-secondary-light to-secondary transition-opacity duration-500 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-primary rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-accent rounded-full blur-3xl animate-pulse" style="animation-delay:.5s"></div>
    </div>
    <div class="relative flex flex-col items-center gap-8">
        <div class="relative">
            <div class="absolute inset-0 -m-8">
                <svg class="w-40 h-40 animate-spin-slow" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="url(#g1)" stroke-width="0.5" stroke-dasharray="10 5" opacity="0.4"/>
                    <defs><linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#1a56db;stop-opacity:1"/>
                        <stop offset="100%" style="stop-color:#f59e0b;stop-opacity:1"/>
                    </linearGradient></defs>
                </svg>
            </div>
            <div class="absolute inset-0 -m-6">
                <svg class="w-36 h-36 animate-spin-reverse" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#1a56db" stroke-width="1" stroke-dasharray="5 10" opacity="0.3"/>
                </svg>
            </div>
            <div class="absolute inset-0 bg-primary/20 rounded-full blur-2xl animate-pulse"></div>
            <div class="relative w-24 h-24 flex items-center justify-center animate-float">
                <div class="w-20 h-20 bg-primary rounded-2xl flex items-center justify-center shadow-2xl">
                    <span class="text-white font-black text-4xl" style="font-family: var(--font-heading);">B</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center gap-3">
            <h3 class="text-white font-heading font-black text-xl tracking-widest animate-pulse">B2B MARKETPLACE</h3>
            <p class="text-white/50 text-xs font-bold uppercase tracking-[0.3em] animate-pulse" style="animation-delay:.2s">Global Trade Platform</p>
            <div class="w-48 h-1 bg-white/10 rounded-full overflow-hidden mt-2">
                <div class="h-full bg-gradient-to-r from-primary via-accent to-primary animate-loading-bar rounded-full"></div>
            </div>
        </div>
    </div>
</div>

{{-- ══ NAVBAR ════════════════════════════════════════════════════════════════════════════════ --}}
<header id="main-header" class="fixed top-0 inset-x-0 z-50 transition-all duration-500">
    <nav id="nav-element" class="w-full bg-white/90 backdrop-blur-xl border-b border-secondary/5 py-3 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-blue group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-black text-xl" style="font-family: var(--font-heading);">B</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-heading font-black text-secondary text-sm leading-none">B2B <span class="text-primary">Marketplace</span></p>
                        <p class="text-[9px] font-bold text-secondary/40 uppercase tracking-[0.2em] mt-0.5">Global Trade Platform</p>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-8">
                    @foreach([
                        ['home',            'Home',         route('home')],
                        ['vendors.index',   'Vendors',      route('vendors.index')],
                        ['products.index',  'Products',     route('products.index')],
                        ['about',           'About Us',     route('about')],
                        ['contact',         'Contact',      route('contact')],
                    ] as [$routeName, $label, $url])
                    <a href="{{ $url }}" class="relative py-2 text-xs font-black uppercase tracking-widest transition-colors group
                        {{ request()->routeIs($routeName . '*') ? 'text-primary' : 'text-secondary/70 hover:text-primary' }}">
                        {{ $label }}
                        <span class="absolute bottom-0 left-0 h-[2px] bg-primary transition-all duration-300 rounded-full
                            {{ request()->routeIs($routeName . '*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    @endforeach
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('rfq.create') }}" class="hidden sm:inline-flex items-center gap-2 bg-accent text-secondary text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-full hover:bg-accent-dark transition-all duration-300 hover:scale-105 active:scale-95 shadow-gold">
                        <i class="fas fa-file-invoice text-[10px]"></i> Get Quote
                    </a>

                    @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-sm font-bold text-secondary/80 hover:text-primary transition-colors">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-9 h-9 rounded-full object-cover border-2 border-primary/20" alt="">
                            @else
                                <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center border-2 border-primary/20">
                                    <span class="text-primary font-black text-sm">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                </div>
                            @endif
                            <i class="fas fa-chevron-down text-[9px] text-secondary/40"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-3 w-52 glass rounded-2xl shadow-premium border border-secondary/8 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden z-50">
                            <div class="p-3 border-b border-secondary/5">
                                <p class="text-xs font-bold text-secondary truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-secondary/40 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-secondary/70 hover:text-primary hover:bg-primary/5 rounded-xl transition-all">
                                    <i class="fas fa-user-circle w-4"></i> My Profile
                                </a>
                                @role('admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-xs font-bold text-primary hover:bg-primary/5 rounded-xl transition-all">
                                    <i class="fas fa-tachometer-alt w-4"></i> Admin Panel
                                </a>
                                @endrole
                                <form action="{{ route('logout') }}" method="POST" class="mt-1 border-t border-secondary/5 pt-1">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-xs font-semibold text-danger hover:bg-danger/5 rounded-xl transition-all text-left">
                                        <i class="fas fa-sign-out-alt w-4"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="hidden sm:block text-xs font-black uppercase tracking-widest text-secondary/70 hover:text-primary transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-secondary text-white text-[10px] font-black uppercase tracking-widest px-5 py-2.5 rounded-full hover:bg-primary transition-all duration-300 hover:scale-105 active:scale-95">
                        Register
                    </a>
                    @endauth

                    {{-- Mobile menu toggle --}}
                    <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 rounded-full bg-surface-dark border border-secondary/8 flex items-center justify-center text-secondary hover:text-primary transition-colors">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden transform translate-x-full transition-transform duration-500 ease-in-out">
        <div class="absolute inset-0 bg-secondary/80 backdrop-blur-md" id="mobile-overlay"></div>
        <div class="absolute right-0 top-0 h-full w-4/5 max-w-sm bg-surface shadow-2xl flex flex-col p-8 border-l border-secondary/8">
            <button id="mobile-close-btn" class="self-end w-10 h-10 rounded-full bg-surface-dark border border-secondary/8 flex items-center justify-center text-secondary hover:text-primary mb-8">
                <i class="fas fa-times text-sm"></i>
            </button>
            <div class="flex flex-col space-y-5">
                @foreach([
                    [route('home'),           'Home'],
                    [route('vendors.index'),  'Vendors'],
                    [route('products.index'), 'Products'],
                    [route('about'),          'About Us'],
                    [route('contact'),        'Contact'],
                    [route('rfq.create'),     'Request Quote'],
                ] as [$url, $label])
                <a href="{{ $url }}" class="font-heading font-black text-xl text-secondary hover:text-primary border-b border-secondary/8 pb-4 transition-colors">{{ $label }}</a>
                @endforeach
            </div>
            <div class="mt-auto pt-8 border-t border-secondary/10">
                @guest
                <div class="space-y-3">
                    <a href="{{ route('login') }}" class="block text-center py-3 rounded-2xl border-2 border-secondary/15 font-bold text-sm text-secondary hover:border-primary hover:text-primary transition-all">Login</a>
                    <a href="{{ route('register') }}" class="block text-center py-3 rounded-2xl bg-primary font-bold text-sm text-white hover:bg-primary-dark transition-all">Register Free</a>
                </div>
                @endguest
                @auth
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                        <span class="text-primary font-black">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                    </div>
                    <div>
                        <p class="font-bold text-sm text-secondary">{{ Auth::user()->name }}</p>
                        <a href="{{ route('profile') }}" class="text-xs text-primary">View Profile</a>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-2xl bg-danger/10 text-danger font-bold text-sm hover:bg-danger hover:text-white transition-all">Logout</button>
                </form>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-msg" class="fixed top-20 right-4 z-40 max-w-sm glass rounded-2xl px-5 py-4 border-l-4 border-success shadow-premium flex items-center gap-3">
    <div class="w-8 h-8 bg-success/10 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-success text-xs"></i></div>
    <p class="text-sm font-semibold text-secondary">{{ session('success') }}</p>
</div>
@endif
@if(session('error'))
<div id="flash-msg" class="fixed top-20 right-4 z-40 max-w-sm glass rounded-2xl px-5 py-4 border-l-4 border-danger shadow-premium flex items-center gap-3">
    <div class="w-8 h-8 bg-danger/10 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fas fa-times text-danger text-xs"></i></div>
    <p class="text-sm font-semibold text-secondary">{{ session('error') }}</p>
</div>
@endif

{{-- Main --}}
<main class="flex-1 pt-[65px]">
    @yield('content')
</main>

{{-- ══ FOOTER ════════════════════════════════════════════════════════════════════════════════ --}}
<footer class="bg-secondary relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
    </div>

    {{-- Newsletter strip --}}
    <div class="border-b border-white/5 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-6 h-px bg-accent"></span>
                        <span class="text-accent text-[9px] font-black uppercase tracking-[0.3em]">Trade Updates</span>
                    </div>
                    <h3 class="font-heading font-black text-white text-xl leading-snug">
                        Stay updated with new <span class="text-gradient-gold italic">vendors & products</span>
                    </h3>
                </div>
                <form class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto lg:min-w-[440px]"
                      onsubmit="event.preventDefault();this.querySelector('button').innerHTML='<i class=\'fas fa-check\'></i> Subscribed';this.querySelector('button').disabled=true;">
                    <input type="email" placeholder="your@company.com" required
                        class="flex-1 bg-white/8 border border-white/10 text-white placeholder:text-white/30 text-sm font-semibold rounded-2xl py-3.5 px-5 focus:outline-none focus:border-accent/60 transition-all">
                    <button type="submit" class="bg-primary hover:bg-accent hover:text-secondary text-white font-black text-[10px] uppercase tracking-widest px-7 py-3.5 rounded-2xl transition-all duration-300 whitespace-nowrap cursor-pointer shadow-blue">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 relative">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-11 h-11 bg-primary rounded-xl flex items-center justify-center shadow-blue">
                        <span class="text-white font-black text-2xl" style="font-family:var(--font-heading)">B</span>
                    </div>
                    <div>
                        <p class="font-heading font-black text-white text-base leading-none">B2B Marketplace</p>
                        <p class="text-[9px] text-white/30 uppercase tracking-[0.2em] mt-0.5">Global Trade Platform</p>
                    </div>
                </div>
                <p class="text-white/40 text-sm leading-relaxed max-w-xs mb-6">Connecting local manufacturers with international buyers. Discover quality products from verified vendors worldwide.</p>
                <div class="flex gap-3">
                    @foreach([
                        ['fab fa-facebook-f', '#'],
                        ['fab fa-linkedin-in', '#'],
                        ['fab fa-twitter', '#'],
                        ['fab fa-instagram', '#'],
                    ] as [$icon, $url])
                    <a href="{{ $url }}" class="w-9 h-9 rounded-xl bg-white/5 border border-white/8 flex items-center justify-center text-white/50 hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 text-xs">
                        <i class="{{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5">Navigate</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Home', route('home')],
                        ['Browse Vendors', route('vendors.index')],
                        ['Products', route('products.index')],
                        ['About Us', route('about')],
                        ['Contact', route('contact')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-white/40 text-sm hover:text-accent transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-0 group-hover:w-3 h-px bg-accent transition-all duration-300"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- For Buyers --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5">For Buyers</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Request a Quote', route('rfq.create')],
                        ['Browse Vendors', route('vendors.index')],
                        ['Browse Products', route('products.index')],
                        ['Register Free', route('register')],
                        ['Login', route('login')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-white/40 text-sm hover:text-accent transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-0 group-hover:w-3 h-px bg-accent transition-all duration-300"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
                <div class="mt-6 space-y-2 text-xs text-white/30">
                    <div class="flex items-center gap-2"><i class="fas fa-envelope text-primary text-[10px]"></i> info@b2bmarket.com</div>
                    <div class="flex items-center gap-2"><i class="fas fa-phone text-primary text-[10px]"></i> +1 (555) 123-4567</div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/5 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/25 font-medium">
            <p>&copy; {{ date('Y') }} B2B Marketplace. All rights reserved.</p>
            <p>Built with Laravel &amp; Tailwind CSS</p>
        </div>
    </div>
</footer>

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Preloader
    window.addEventListener('load', () => {
        const el = document.getElementById('preloader');
        if (el) { el.style.opacity = '0'; setTimeout(() => el.remove(), 600); }
    });

    // Sticky header
    const header = document.getElementById('main-header');
    window.addEventListener('scroll', () => {
        header.classList.toggle('shadow-premium', window.scrollY > 50);
    });

    // Mobile menu
    const sidebar  = document.getElementById('mobile-menu');
    const overlay  = document.getElementById('mobile-overlay');
    const openBtn  = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-close-btn');
    const open  = () => sidebar.classList.replace('translate-x-full', 'translate-x-0');
    const close = () => sidebar.classList.replace('translate-x-0', 'translate-x-full');
    openBtn?.addEventListener('click', open);
    closeBtn?.addEventListener('click', close);
    overlay?.addEventListener('click', close);

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-revealed'); observer.unobserve(e.target); } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-up,.reveal-left,.reveal-right').forEach(el => observer.observe(el));

    // Auto-dismiss flash
    const flash = document.getElementById('flash-msg');
    if (flash) setTimeout(() => { flash.style.opacity='0'; setTimeout(()=>flash.remove(),400); }, 4000);
</script>
@stack('scripts')
</body>
</html>
