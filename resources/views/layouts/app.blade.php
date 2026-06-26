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
<body class="bg-gradient-to-b from-slate-50 via-white to-slate-50 font-sans text-slate-700 overflow-x-hidden transition-colors duration-300">

{{-- ══ PRELOADER ═══════════════════════════════════════════════════════════════════════════ --}}
{{-- <div id="preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-900 via-green-900 to-slate-900 transition-opacity duration-300 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-green-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 rounded-full blur-3xl animate-pulse" style="animation-delay:.5s"></div>
    </div>
    <div class="relative flex flex-col items-center gap-6 px-4">
        <div class="relative">
            <div class="absolute inset-0 -m-8">
                <svg class="w-40 h-40 animate-spin-slow" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="url(#g1)" stroke-width="0.5" stroke-dasharray="10 5" opacity="0.3"/>
                    <defs><linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1"/>
                        <stop offset="100%" style="stop-color:#6366f1;stop-opacity:1"/>
                    </linearGradient></defs>
                </svg>
            </div>
            <div class="absolute inset-0 -m-6">
                <svg class="w-36 h-36 animate-spin-reverse" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#3b82f6" stroke-width="1" stroke-dasharray="5 10" opacity="0.2"/>
                </svg>
            </div>
            <div class="relative w-20 h-20 flex items-center justify-center animate-float">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl flex items-center justify-center shadow-2xl shadow-green-500/50">
                    <span class="text-white font-black text-3xl" style="font-family: var(--font-heading);">B</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center gap-2">
            <h3 class="text-white font-heading font-black text-lg tracking-widest animate-pulse">B2B MARKETPLACE</h3>
            <p class="text-white/50 text-[10px] font-bold uppercase tracking-[0.3em] animate-pulse" style="animation-delay:.2s">Global Trade Platform</p>
            <div class="w-40 h-0.5 bg-white/10 rounded-full overflow-hidden mt-3">
                <div class="h-full bg-gradient-to-r from-transparent via-blue-400 to-transparent animate-loading-bar"></div>
            </div>
        </div>
    </div>
</div> --}}

{{-- ══ NAVBAR ════════════════════════════════════════════════════════════════════════════════ --}}
<header id="main-header" class="fixed top-0 inset-x-0 z-50">
    <nav class="bg-[#1a1d29] border-b border-[#2a2d3a]">
        <div class="max-w-full mx-auto px-8 lg:px-12">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group flex-shrink-0">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-700 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-black text-base" style="font-family: var(--font-heading);">B</span>
                    </div>
                    <span class="hidden sm:block font-heading font-bold text-white text-sm">B2B Marketplace</span>
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
                            : 'text-slate-400 hover:text-white' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    {{-- Get Quote Button --}}
                    <a href="{{ route('rfq.create') }}" class="hidden md:inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-plus text-[10px]"></i>
                        <span>Get Quote</span>
                    </a>

                    {{-- Auth Section --}}
                    @auth
                        {{-- Notification Bell --}}
                        <button class="relative w-9 h-9 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                            <i class="fas fa-bell text-sm"></i>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-green-500 rounded-full"></span>
                        </button>

                        {{-- User Dropdown --}}
                        <div class="relative group">
                            <button class="flex items-center gap-2 hover:bg-[#2a2d3a] px-2 py-1.5 rounded-lg transition-all">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-[#2a2d3a]" alt="">
                                @else
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-700 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-xs">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                    </div>
                                @endif
                            </button>
                            
                            {{-- Dropdown Menu --}}
                            <div class="absolute right-0 top-full mt-2 w-64 bg-[#1a1d29] rounded-xl border border-[#2a2d3a] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden shadow-2xl z-50">
                                {{-- User Info --}}
                                <div class="px-4 py-3 border-b border-[#2a2d3a]">
                                    <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                                    <p class="text-slate-400 text-xs mt-0.5">{{ Auth::user()->email }}</p>
                                </div>
                                
                                {{-- Menu Items --}}
                                <div class="p-2">
                                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                                        <i class="fas fa-user w-4 text-center text-slate-400"></i>
                                        <span>My Profile</span>
                                    </a>
                                    @role('admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                                        <i class="fas fa-gauge-high w-4 text-center text-slate-400"></i>
                                        <span>Admin Panel</span>
                                    </a>
                                    @endrole
                                    
                                    <div class="h-px bg-[#2a2d3a] my-2"></div>
                                    
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all text-left">
                                            <i class="fas fa-sign-out-alt w-4 text-center text-slate-400"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Guest Actions --}}
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-slate-400 hover:text-white transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors">
                            Sign Up
                        </a>
                    @endauth

                    {{-- Mobile Menu Toggle --}}
                    <button id="mobile-menu-btn" class="lg:hidden w-9 h-9 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                        <i class="fas fa-bars text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden transform translate-x-full transition-transform duration-300 ease-out">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="mobile-overlay"></div>
        <div class="absolute right-0 top-0 h-full w-full max-w-sm bg-[#1a1d29] shadow-2xl flex flex-col">
            
            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b border-[#2a2d3a]">
                <span class="font-heading font-bold text-white">Menu</span>
                <button id="mobile-close-btn" class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
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
                <a href="{{ $url }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                    <i class="{{ $icon }} w-4 text-center text-slate-400"></i>
                    <span>{{ $label }}</span>
                </a>
                @endforeach
            </div>

            {{-- Auth Section --}}
            <div class="p-4 border-t border-[#2a2d3a] space-y-2">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2.5 rounded-lg border border-[#2a2d3a] font-semibold text-sm text-slate-300 hover:text-white hover:bg-[#2a2d3a] transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 font-semibold text-sm text-white transition-all">
                        <i class="fas fa-user-plus mr-2"></i> Sign Up
                    </a>
                @endguest
                @auth
                    <div class="pb-3 mb-3 border-b border-[#2a2d3a]">
                        <div class="flex items-center gap-3">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-[#2a2d3a]" alt="">
                            @else
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-700 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-sm text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400">{{ Str::limit(Auth::user()->email, 22) }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                        <i class="fas fa-user w-4 text-center text-slate-400"></i> Profile
                    </a>
                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-300 hover:text-white hover:bg-[#2a2d3a] rounded-lg transition-all">
                        <i class="fas fa-gauge-high w-4 text-center text-slate-400"></i> Admin
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

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="fixed inset-0 z-40 lg:hidden transform translate-x-full transition-transform duration-500 ease-out">
        <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-xl" id="mobile-overlay"></div>
        <div class="absolute right-0 top-0 h-full w-full max-w-md bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 shadow-2xl flex flex-col">
            
            {{-- Header with gradient --}}
            <div class="relative p-6 border-b border-white/10 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-green-600\/20 via-purple-600/20 to-pink-600/20"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSA2MCAwIEwgMCAwIDAgNjAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMC41IiBvcGFjaXR5PSIwLjA1Ii8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-30"></div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 bg-gradient-to-tr from-green-500 via-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-xl">
                            <span class="text-white font-black text-xl drop-shadow-lg" style="font-family: var(--font-heading);">B</span>
                        </div>
                        <div>
                            <p class="font-heading font-black text-white text-base drop-shadow">Menu</p>
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Navigation</p>
                        </div>
                    </div>
                    <button id="mobile-close-btn" class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 rounded-xl transition-all border border-white/10">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            {{-- Navigation Links --}}
            <div class="flex-1 overflow-y-auto p-5 space-y-2">
                @foreach([
                    [route('home'),           'Home',           'fas fa-home',         'from-green-600 to-green-500'],
                    [route('vendors.index'),  'Browse Vendors', 'fas fa-store',        'from-purple-600 to-purple-500'],
                    [route('products.index'), 'Browse Products','fas fa-boxes',        'from-emerald-600 to-emerald-500'],
                    [route('gallery'),        'Gallery',        'fas fa-images',       'from-pink-600 to-pink-500'],
                    [route('about'),          'About Us',       'fas fa-info-circle',  'from-emerald-600 to-emerald-500'],
                    [route('contact'),        'Contact',        'fas fa-envelope',     'from-orange-600 to-orange-500'],
                ] as [$url, $label, $icon, $gradient])
                <a href="{{ $url }}" class="group block bg-slate-800/50 hover:bg-slate-700/50 rounded-2xl border border-white/10 hover:border-white/20 backdrop-blur-xl transition-all">
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-11 h-11 bg-gradient-to-br {{ $gradient }} rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="{{ $icon }} text-white text-base drop-shadow"></i>
                        </div>
                        <span class="text-slate-200 font-bold text-[15px] group-hover:text-white transition-colors">{{ $label }}</span>
                        <i class="fas fa-chevron-right text-[11px] text-slate-500 ml-auto group-hover:text-slate-300 group-hover:translate-x-1 transition-all"></i>
                    </div>
                </a>
                @endforeach
                
                {{-- Quote Button --}}
                <a href="{{ route('rfq.create') }}" class="group block relative overflow-hidden rounded-2xl mt-6">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500 via-orange-500 to-pink-600"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-400 via-orange-400 to-pink-500 blur opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <div class="relative flex items-center gap-4 px-5 py-4 border border-white/20">
                        <div class="w-11 h-11 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-bolt text-white text-base drop-shadow"></i>
                        </div>
                        <span class="text-white font-black text-[15px] drop-shadow uppercase tracking-wide">Get Quote</span>
                        <i class="fas fa-arrow-right text-[11px] text-white/80 ml-auto group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>
            </div>

            {{-- Auth Section --}}
            <div class="p-5 border-t border-white/10 bg-slate-900/50 backdrop-blur-sm space-y-3">
                @guest
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2.5 px-6 py-4 rounded-2xl border-2 border-white/20 font-bold text-[15px] text-slate-300 hover:text-white hover:bg-white/5 transition-all backdrop-blur-xl">
                        <i class="fas fa-sign-in-alt text-base"></i> 
                        <span>Login to Account</span>
                    </a>
                    <a href="{{ route('register') }}" class="group relative overflow-hidden flex items-center justify-center gap-2.5 px-6 py-4 rounded-2xl font-bold text-[15px] text-white transition-all">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 blur opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <i class="fas fa-sparkles text-base relative z-10"></i> 
                        <span class="relative z-10 drop-shadow">Create Account</span>
                    </a>
                @endguest
                @auth
                    {{-- User Profile Card --}}
                    <div class="relative mb-4 p-4 rounded-2xl overflow-hidden bg-slate-800/50 border border-white/10 backdrop-blur-xl">
                        <div class="flex items-center gap-3.5">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-12 h-12 rounded-xl object-cover ring-2 ring-purple-500/50 shadow-lg" alt="">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-white font-bold text-base drop-shadow">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="text-white font-bold text-sm leading-tight">{{ Str::limit(Auth::user()->name, 18) }}</p>
                                <p class="text-slate-400 text-xs mt-1">{{ Str::limit(Auth::user()->email, 24) }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile') }}" class="flex items-center gap-3.5 px-5 py-3.5 text-sm font-bold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition-all group border border-transparent hover:border-white/10">
                        <div class="w-9 h-9 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-green-400"></i>
                        </div>
                        <span>My Profile</span>
                        <i class="fas fa-arrow-right text-[10px] ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-5 py-3.5 text-sm font-bold text-slate-300 hover:text-white hover:bg-white/5 rounded-xl transition-all group border border-transparent hover:border-white/10">
                        <div class="w-9 h-9 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-gauge-high text-purple-400"></i>
                        </div>
                        <span>Admin Panel</span>
                        <i class="fas fa-arrow-right text-[10px] ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    @endrole
                    
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3.5 px-5 py-3.5 text-sm font-bold text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl transition-all text-left group border border-transparent hover:border-red-500/20">
                            <div class="w-9 h-9 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-sign-out-alt text-red-400"></i>
                            </div>
                            <span>Logout</span>
                            <i class="fas fa-arrow-right text-[10px] ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-msg" class="fixed top-24 right-4 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-emerald-500 p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-emerald-600 text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-slate-900">Success</p>
        <p class="text-sm font-medium text-slate-600">{{ session('success') }}</p>
    </div>
</div>
@endif
@if(session('error'))
<div id="flash-msg" class="fixed top-24 right-4 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-red-500 p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-exclamation-circle text-red-600 text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-slate-900">Error</p>
        <p class="text-sm font-medium text-slate-600">{{ session('error') }}</p>
    </div>
</div>
@endif

{{-- Main --}}
<main class="flex-1 pt-16">
    @yield('content')
</main>

{{-- ══ FOOTER ════════════════════════════════════════════════════════════════════════════════ --}}
<footer class="bg-gradient-to-b from-slate-900 via-slate-800 to-slate-950 text-white relative overflow-hidden">
    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 right-0 w-96 h-96 bg-green-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-emerald-500 rounded-full blur-3xl"></div>
    </div>

    {{-- Newsletter Section --}}
    <div class="border-b border-slate-700 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-[0.25em] block mb-3">Stay Updated</span>
                    <h3 class="font-heading font-black text-2xl md:text-3xl leading-snug mb-2">
                        Latest <span class="bg-gradient-to-r from-green-400 via-emerald-400 to-green-400 bg-clip-text text-transparent">Vendors & Products</span>
                    </h3>
                    <p class="text-slate-400 text-sm">Never miss new opportunities from verified manufacturers</p>
                </div>
                <form class="flex flex-col sm:flex-row gap-3"
                      onsubmit="event.preventDefault();const btn=this.querySelector('button');btn.innerHTML='<i class=\'fas fa-check\'></i> Subscribed';btn.disabled=true;">
                    <input type="email" placeholder="your@company.com" required
                        class="flex-1 bg-slate-700/50 border border-slate-600 text-white placeholder:text-slate-400 text-sm font-medium rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-500/60 focus:border-transparent transition-all hover:bg-slate-700">
                    <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-700 hover:shadow-xl hover:shadow-green-600/40 text-white font-bold text-xs uppercase tracking-wide px-7 py-3 rounded-lg transition-all duration-300 whitespace-nowrap hover:scale-105 active:scale-95">
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
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center shadow-lg shadow-amber-600/50">
                        <span class="text-white font-black text-lg" style="font-family:var(--font-heading)">B</span>
                    </div>
                    <div>
                        <p class="font-heading font-black text-white text-xs">B2B Marketplace</p>
                        <p class="text-[8px] text-slate-400 uppercase tracking-[0.15em]">Global Trade</p>
                    </div>
                </div>
                <p class="text-slate-400 text-xs leading-relaxed max-w-xs mb-5">Connecting manufacturers with buyers worldwide for authentic B2B trade.</p>
                <div class="flex gap-2">
                    @foreach([
                        ['fab fa-facebook-f', '#'],
                        ['fab fa-linkedin-in', '#'],
                        ['fab fa-twitter', '#'],
                        ['fab fa-instagram', '#'],
                    ] as [$icon, $url])
                    <a href="{{ $url }}" class="w-8 h-8 rounded-lg bg-slate-700 border border-slate-600 flex items-center justify-center text-slate-400 hover:text-white hover:bg-green-600 hover:border-green-600 transition-all duration-300 text-xs hover:scale-110">
                        <i class="{{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Platform
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Home', route('home')],
                        ['Vendors', route('vendors.index')],
                        ['Products', route('products.index')],
                        ['Gallery', route('gallery')],
                        ['About Us', route('about')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-slate-400 text-xs hover:text-green-400 transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-1 h-px bg-green-400 opacity-0 group-hover:opacity-100 transition-opacity"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- For Buyers --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> For Buyers
                </h4>
                <ul class="space-y-3">
                    @foreach([
                        ['Get Quote', route('rfq.create')],
                        ['Browse Vendors', route('vendors.index')],
                        ['Browse Products', route('products.index')],
                        ['Contact Support', route('contact')],
                    ] as [$label, $url])
                    <li><a href="{{ $url }}" class="text-slate-400 text-xs hover:text-green-400 transition-colors font-medium flex items-center gap-2 group">
                        <span class="w-1 h-px bg-green-400 opacity-0 group-hover:opacity-100 transition-opacity"></span>{{ $label }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="font-heading font-black text-white text-xs uppercase tracking-[0.2em] mb-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Contact
                </h4>
                <div class="space-y-3.5">
                    <div>
                        <p class="text-xs text-slate-400 font-bold mb-1">Email</p>
                        <a href="mailto:info@b2bmarket.com" class="text-slate-300 text-xs hover:text-green-400 transition-colors">info@b2bmarket.com</a>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-bold mb-1">Phone</p>
                        <a href="tel:+15551234567" class="text-slate-300 text-xs hover:text-green-400 transition-colors">+1 (555) 123-4567</a>
                    </div>
                    <div class="pt-2">
                        @auth
                            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-green-400 text-xs font-bold hover:text-green-300 transition-colors">
                                <i class="fas fa-user"></i> Account
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-green-400 text-xs font-bold hover:text-green-300 transition-colors">
                                <i class="fas fa-user-plus"></i> Register Free
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer bottom --}}
        <div class="border-t border-slate-700 pt-8 md:pt-10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 font-medium">
            <p>&copy; {{ date('Y') }} B2B Marketplace. All rights reserved.</p>
            <p class="flex items-center gap-2">&copy; Developed By NerdTech Labs.</p>
        </div>
    </div>
</footer>

{{-- Swiper JS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    {{-- // Preloader
    // window.addEventListener('load', () => {
    //     const el = document.getElementById('preloader');
    //     if (el) { 
    //         el.style.opacity = '0'; 
    //         setTimeout(() => el.remove(), 300); 
    //     }
    // }); --}}

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
