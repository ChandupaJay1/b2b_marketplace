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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-b from-slate-50 via-white to-slate-50 font-sans text-slate-700 overflow-x-hidden">

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-msg" class="fixed top-6 right-6 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-emerald-500 p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-emerald-600 text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-slate-900">Success</p>
        <p class="text-sm font-medium text-slate-600">{{ session('success') }}</p>
    </div>
</div>
@endif
@if(session('error'))
<div id="flash-msg" class="fixed top-6 right-6 z-40 max-w-sm bg-white rounded-xl shadow-xl border-l-4 border-red-500 p-4 flex items-center gap-3 animate-in slide-in-from-top">
    <div class="w-6 h-6 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-exclamation-circle text-red-600 text-xs"></i></div>
    <div>
        <p class="text-xs font-bold text-slate-900">Error</p>
        <p class="text-sm font-medium text-slate-600">{{ session('error') }}</p>
    </div>
</div>
@endif

{{-- Main Content --}}
<main>
    @yield('content')
</main>

<script>
    // Auto-dismiss flash messages
    const flash = document.getElementById('flash-msg');
    if (flash) setTimeout(() => { 
        flash.style.opacity = '0'; 
        flash.style.transform = 'translateY(-20px)';
        setTimeout(() => flash.remove(), 400); 
    }, 5000);
</script>
@stack('scripts')
</body>
</html>
