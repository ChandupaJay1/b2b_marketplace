<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logos/ethical_logo.jpeg') }}" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin — @yield('title', 'Dashboard') | B2B Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface min-h-screen">

<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-secondary text-white/50 flex flex-col transition-transform duration-300 md:translate-x-0 -translate-x-full">
        {{-- Logo --}}
        <div class="h-16 flex items-center justify-between px-6 bg-[#1d1d1d] flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">B</span>
                </div>
                <span class="font-bold text-white text-sm">B2B Admin</span>
            </a>
            <button id="close-sidebar" class="md:hidden text-white/50 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3">
            @php
                function adminNavLink($route, $icon, $label, $activeRoutes = null) {
                    $isActive = $activeRoutes ? request()->routeIs($activeRoutes) : request()->routeIs($route);
                    $activeClass = $isActive ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white';
                    echo '<a href="' . route($route) . '" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors ' . $activeClass . '">' .
                         '<span class="text-lg opacity-50">' . $icon . '</span>' . $label . '</a>';
                }
            @endphp

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider">Overview</p>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>📊</span> Dashboard
                </a>
            </div>

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider mt-3">User Management</p>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>👥</span> Users
                </a>
            </div>

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider mt-3">Vendor Management</p>
                <a href="{{ route('admin.vendor-categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.vendor-categories.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>📁</span> Vendor Categories
                </a>
                <a href="{{ route('admin.vendors.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.vendors.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>🏭</span> Vendors
                </a>
            </div>

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider mt-3">Product Management</p>
                <a href="{{ route('admin.product-categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.product-categories.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>📂</span> Product Categories
                </a>
                <a href="{{ route('admin.product-subcategories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.product-subcategories.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>🗂️</span> Subcategories
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>📦</span> Products
                </a>
            </div>

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider mt-3">Content</p>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>🖼️</span> Gallery
                </a>
            </div>

            <div class="mb-2">
                <p class="px-3 py-1 text-xs font-semibold text-white/50 uppercase tracking-wider mt-3">Inquiries</p>
                <a href="{{ route('admin.rfqs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.rfqs.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>📋</span> RFQs
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-primary text-white' : 'text-white/50 hover:bg-[#3d3d3d] hover:text-white' }}">
                    <span>✉️</span> Messages
                </a>
            </div>
        </nav>

        {{-- User Profile --}}
        <div class="border-t border-gray-800 p-4 flex-shrink-0">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 bg-primary-dark rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                    <p class="text-white/50 text-xs truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="flex-1 text-center px-3 py-1.5 text-xs bg-[#3d3d3d] text-white/30 rounded-lg hover:bg-gray-700 transition-colors">View Site</a>
                <form action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full px-3 py-1.5 text-xs bg-danger/20 text-danger rounded-lg hover:bg-danger/30 transition-colors">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">
        {{-- Top Bar --}}
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 flex-shrink-0">
            <button id="open-sidebar" class="md:hidden p-2 rounded-lg text-white/60 hover:bg-surface">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div>
                <h1 class="text-lg font-bold text-secondary">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-white/50">@yield('breadcrumb', 'Admin Panel')</p>
            </div>
            <div class="text-sm text-white/50">{{ now()->format('M d, Y') }}</div>
        </header>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="mb-4 bg-primary/10 border border-primary/20 rounded-xl px-4 py-3 flex items-center gap-3">
                    <span class="text-primary">✓</span>
                    <p class="text-primary-dark text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 rounded-xl px-4 py-3 flex items-center gap-3">
                    <span class="text-red-500">✕</span>
                    <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

{{-- Sidebar overlay (mobile) --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    document.getElementById('open-sidebar')?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });
    document.getElementById('close-sidebar')?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
