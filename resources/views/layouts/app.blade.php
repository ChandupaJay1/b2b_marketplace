<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ethical Offerings Expo Market')</title>
    <meta name="description" content="@yield('meta_description', 'Discover local manufacturers and connect with verified vendors for international trade.')">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/logos/ethical_logo.jpeg') }}" type="image/jpeg">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-b from-surface via-white to-surface font-sans text-secondary overflow-x-hidden transition-colors duration-300">

{{-- ══ NAVBAR ════════════════════════════════════════════════════════════════════════════════ --}}
<header id="main-header" class="fixed top-0 inset-x-0 z-50">
    <nav class="bg-[#2d2d2d] border-b border-[#3d3d3d]">
        <div class="max-w-full mx-auto px-8 lg:px-12">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group flex-shrink-0">
                    <img src="{{ asset('images/logos/ethical_logo.jpeg') }}" alt="Ethical Offerings Expo Market logo" class="w-8 h-8 object-cover rounded-lg" />
                    <span class="hidden sm:block font-heading font-bold text-white text-sm">Ethical Offerings Expo Market</span>
                </a>

                {{-- Desktop Nav Menu --}}
                <div class="hidden lg:flex items-center gap-8 flex-1 justify-center ml-12">
                    @foreach([
                        ['home',            'Home',         route('home')],
                        ['vendors.index',   'Vendors',      route('vendors.index')],
                        ['products.index',  'Products',     route('products.index')],
                        ['gallery',         'Gallery',      route('gallery')],
                        ['about',           'About',        route('about')],
                        ['contact',         'Contact',      route('contact')],
                    ] as [$routeName, $label, $url])
                    <a href="{{ $url }}" class="text-[13px] font-semibold transition-all duration-200
                        {{ request()->routeIs($routeName . '*')
                            ? 'text-white'
                            : 'text-white/50 hover:text-white' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    {{-- Get Quote Button --}}
                    <a href="{{ route('rfq.create') }}" class="hidden md:inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus text-[10px]"></i>
                        <span>Get Quote</span>
                    </a>

                    {{-- Auth Section --}}
                    @auth
                        {{-- Notification Bell --}}
                        <button class="relative w-9 h-9 flex items-center justify-center text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                            <i class="fas fa-bell text-sm"></i>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-primary rounded-full"></span>
                        </button>

                        {{-- User Dropdown --}}
                        <div class="relative group">
                            <button class="flex items-center gap-2 hover:bg-[#3d3d3d] px-2 py-1.5 rounded-lg transition-all">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-[#3d3d3d]" alt="">
                                @else
                                    <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-xs">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                    </div>
                                @endif
                            </button>

                            {{-- Dropdown Menu --}}
                            <div class="absolute right-0 top-full mt-2 w-64 bg-[#2d2d2d] rounded-xl border border-[#3d3d3d] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden shadow-2xl z-50">
                                {{-- User Info --}}
                                <div class="px-4 py-3 border-b border-[#3d3d3d]">
                                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-white/50 text-xs mt-0.5">{{ Auth::user()->email }}</p>
                                </div>

                                {{-- Menu Items --}}
                                <div class="p-2">
                                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                                        <i class="fas fa-user w-4 text-center text-white/50"></i>
                                        <span>My Profile</span>
                                    </a>
                                    @role('admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                                        <i class="fas fa-gauge-high w-4 text-center text-white/50"></i>
                                        <span>Admin Panel</span>
                                    </a>
                                    @endrole

                                    <div class="h-px bg-[#3d3d3d] my-2"></div>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all text-left">
                                            <i class="fas fa-sign-out-alt w-4 text-center text-white/50"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Guest Actions --}}
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-white/50 hover:text-white transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex bg-primary hover:bg-primary-dark text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors">
                            Sign Up
                        </a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button id="mobile-menu-btn" class="lg:hidden w-9 h-9 flex items-center justify-center text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                        <i class="fas fa-bars text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden transform translate-x-full transition-transform duration-300 ease-out">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="mobile-overlay"></div>
        <div class="absolute right-0 top-0 h-full w-full max-w-sm bg-[#2d2d2d] shadow-2xl flex flex-col">

            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b border-[#3d3d3d]">
                <span class="font-heading font-bold text-white">Menu</span>
                <button id="mobile-close-btn" class="w-9 h-9 flex items-center justify-center text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            {{-- Navigation Links --}}
            <div class="flex-1 overflow-y-auto p-4 space-y-1">
                @foreach([
                    [route('home'),           'Home',           'fas fa-home'],
                    [route('vendors.index'),  'Browse Vendors', 'fas fa-store'],
                    [route('products.index'), 'Browse Products','fas fa-boxes'],
                    [route('about'),          'About Us',       'fas fa-info-circle'],
                    [route('contact'),        'Contact',        'fas fa-envelope'],
                    [route('rfq.create'),     'Get Quote',      'fas fa-file-invoice'],
                ] as [$url, $label, $icon])
                <a href="{{ $url }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                    <i class="{{ $icon }} w-4 text-center text-white/50"></i>
                    <span>{{ $label }}</span>
                </a>
                @endforeach
            </div>

            {{-- Auth Section --}}
            <div class="p-4 border-t border-[#3d3d3d] space-y-2">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2.5 rounded-lg border border-[#3d3d3d] font-semibold text-sm text-white/50 hover:text-white hover:bg-[#3d3d3d] transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-2.5 rounded-lg bg-primary hover:bg-primary-dark font-semibold text-sm text-white transition-all">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </a>
                @endguest
                @auth
                    <div class="pb-3 mb-3 border-b border-[#3d3d3d]">
                        <div class="flex items-center gap-3">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-[#3d3d3d]" alt="">
                            @else
                                <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-sm text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-white/50">{{ Str::limit(Auth::user()->email, 22) }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                        <i class="fas fa-user w-4 text-center text-white/50"></i> Profile
                    </a>
                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-white/50 hover:text-white hover:bg-[#3d3d3d] rounded-lg transition-all">
                        <i class="fas fa-gauge-high w-4 text-center text-white/50"></i> Admin
                    </a>
                    @endrole
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all text-left">
                            <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-msg" class="fixed top-24 right-4 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-primary p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-primary text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-secondary">Success</p>
        <p class="text-sm font-medium text-secondary/60">{{ session('success') }}</p>
    </div>
</div>
@endif
@if(session('error'))
<div id="flash-msg" class="fixed top-24 right-4 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-danger p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-danger/10 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-exclamation-circle text-danger text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-secondary">Error</p>
        <p class="text-sm font-medium text-secondary/60">{{ session('error') }}</p>
    </div>
</div>
@endif

{{-- Main --}}
<main class="flex-1 pt-16">
    @yield('content')
</main>

{{-- ══ FOOTER ════════════════════════════════════════════════════════════════════════════════ --}}
<footer class="bg-gradient-to-b from-secondary via-[#3d3d3d] to-[#1d1d1d] text-white relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary-dark rounded-full blur-3xl"></div>
    </div>

    {{-- Newsletter Section --}}
    <div class="border-b border-white/10 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-accent text-xs font-bold uppercase tracking-[0.25em] block mb-3">Stay Updated</span>
                    <h3 class="font-heading font-black text-2xl md:text-3xl leading-snug mb-2">
                        Latest <span class="bg-gradient-to-r from-primary via-accent to-primary bg-clip-text text-transparent">Vendors & Products</span>
                    </h3>
                    <p class="text-white/50 text-sm">Never miss new opportunities from verified manufacturers</p>
                </div>
                <form class="flex flex-col sm:flex-row gap-3"
                      onsubmit="event.preventDefault();const btn=this.querySelector('button');btn.innerHTML='<i class=\'fas fa-check\'></i> Subscribed';btn.disabled=true;">
                    <input type="email" placeholder="your@company.com" required
                        class="flex-1 bg-white/10 border border-white/20 text-white placeholder:text-white/40 text-sm font-medium rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-primary/60 focus:border-transparent transition-all hover:bg-white/20">
                    <button type="submit" class="bg-gradient-to-r from-primary to-primary-dark hover:shadow-xl hover:shadow-primary/40 text-white font-bold text-xs uppercase tracking-wide px-7 py-3 rounded-lg transition-all duration-300 whitespace-nowrap hover:scale-105 active:scale-95">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main footer content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logos/ethical_logo.jpeg') }}" alt="Ethical Offerings Expo Market logo" class="w-10 h-10 object-cover rounded-lg shadow-lg shadow-accent/50" />
                    <div>
                        <p class="font-heading font-black text-white text-xs">Ethical Offering Expo Market</p>
                        <p class="text-[8px] text-white/40 uppercase tracking-[0.15em]">Global Trade</p>
                    </div>
                </div>
                <p class="text-white/40 text-xs leading-relaxed max-w-xs mb-5">Connecting manufacturers with buyers worldwide for authentic B2B trade.</p>
                <div class="flex gap-2">
                    @foreach([
                        ['fab fa-facebook-f', '#'],
                        ['fab fa-linkedin-in', '#'],
                        ['fab fa-twitter', '#'],
                        ['fab fa-instagram', '#'],
                    ] as [$icon, $url])
                    <a href="{{ $url }}" class="w-8 h-8 rounded-lg bg-white/10 border border-white/20 flex items-center justify-center text-white/50 hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 text-xs hover:scale-110">
                        <i class="{{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Platform
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Home', route('home')],
                        ['Vendors', route('vendors.index')],
                        ['Products', route('products.index')],
                        ['Gallery', route('gallery')],
                        ['About Us', route('about')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-white/50 text-xs hover:text-primary transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-1 h-px bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- For Buyers --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span> For Buyers
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Get Quote', route('rfq.create')],
                        ['Browse Vendors', route('vendors.index')],
                        ['Browse Products', route('products.index')],
                        ['Contact Support', route('contact')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-white/50 text-xs hover:text-primary transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-1 h-px bg-primary opacity-0 group-hover:opacity-100 transition-opacity"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span> Contact
                </h4>
                <div class="space-y-3.5">
                    <div>
                        <p class="text-xs text-white/50 font-bold mb-1">Email</p>
                        <a href="mailto:ethicalofferingsl@gmail.com" class="text-white/60 text-xs hover:text-primary transition-colors">ethicalofferingsl@gmail.com</a>
                    </div>
                    <div>
                        <p class="text-xs text-white/50 font-bold mb-1">Phone</p>
                        <a href="tel:+94772842275" class="text-white/60 text-xs hover:text-primary transition-colors">+94 77 284 2275</a>
                        <a href="tel:+94783807154" class="text-white/60 text-xs hover:text-primary transition-colors">+94 78 380 7154</a>
                    </div>
                    <div class="pt-2">
                        @auth
                            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-primary text-xs font-bold hover:text-primary/70 transition-colors">
                                <i class="fas fa-user"></i> Account
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-primary text-xs font-bold hover:text-primary/70 transition-colors">
                                <i class="fas fa-user-plus"></i> Register Free
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer bottom --}}
        <div class="border-t border-white/10 pt-8 md:pt-10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/40 font-medium">
            <p>&copy; {{ date('Y') }} Ethical Offering Expo Market. All rights reserved.</p>
            <p class="flex items-center gap-2">&copy; Developed By NerdTech Labs.</p>
        </div>
    </div>
</footer>

<script>
    // Sticky header with scroll effects
    const header = document.getElementById('main-header');
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const current = window.scrollY;
        header.classList.toggle('shadow-md', current > 50);
        lastScroll = current;
    });

    // Mobile menu toggle
    const sidebar  = document.getElementById('mobile-menu');
    const overlay  = document.getElementById('mobile-overlay');
    const openBtn  = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('mobile-close-btn');
    const menuLinks = sidebar?.querySelectorAll('a') || [];

    const open  = () => sidebar?.classList.replace('translate-x-full', 'translate-x-0');
    const close = () => sidebar?.classList.replace('translate-x-0', 'translate-x-full');

    openBtn?.addEventListener('click', open);
    closeBtn?.addEventListener('click', close);
    overlay?.addEventListener('click', close);
    menuLinks.forEach(link => link.addEventListener('click', close));

    // Scroll reveal animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-revealed');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right').forEach(el => observer.observe(el));

    // Auto-dismiss flash messages
    const flash = document.getElementById('flash-msg');
    if (flash) setTimeout(() => {
        flash.style.opacity = '0';
        flash.style.transform = 'translateY(-20px)';
        setTimeout(() => flash.remove(), 400);
    }, 5000);

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
