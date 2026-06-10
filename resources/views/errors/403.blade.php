@extends('layouts.app')
@section('title', '403 — Access Denied')

@section('content')
<div class="min-h-screen bg-dot-pattern flex items-center justify-center px-4">
    <div class="text-center max-w-md">
        <div class="w-24 h-24 bg-danger/8 rounded-3xl flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-lock text-danger text-4xl"></i>
        </div>
        <h1 class="font-heading font-black text-secondary text-6xl mb-2">403</h1>
        <h2 class="font-heading font-black text-secondary text-2xl mb-4">Access Denied</h2>
        <p class="text-secondary/50 mb-8 leading-relaxed">You don't have permission to access this page. If you believe this is a mistake, please contact an administrator.</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('home') }}" class="btn-primary text-[11px]"><i class="fas fa-home"></i> Go Home</a>
            <a href="{{ route('login') }}" class="btn-secondary text-[11px]"><i class="fas fa-sign-in-alt"></i> Login</a>
        </div>
    </div>
</div>
@endsection
