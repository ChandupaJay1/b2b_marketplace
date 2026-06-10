@extends('layouts.auth')
@section('title', 'Register — B2B Marketplace')

@section('content')
<div class="relative min-h-screen bg-gradient-to-br from-surface via-white to-surface-dark flex">
    {{-- Left panel --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-secondary via-secondary-light to-secondary flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-accent rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/3 left-1/4 w-48 h-48 bg-primary rounded-full blur-3xl animate-pulse" style="animation-delay:.5s"></div>
        </div>
        <a href="{{ route('home') }}" class="flex items-center gap-3 relative">
            <div class="w-11 h-11 bg-gradient-to-br from-primary to-primary-dark rounded-xl flex items-center justify-center shadow-blue">
                <span class="text-white font-black text-2xl" style="font-family:var(--font-heading)">B</span>
            </div>
            <div>
                <p class="font-heading font-black text-white text-sm leading-none">B2B Marketplace</p>
                <p class="text-[9px] text-white/30 uppercase tracking-[0.2em] mt-0.5">Global Trade Platform</p>
            </div>
        </a>
        <div class="relative">
            <h2 class="font-heading font-black text-white text-4xl leading-tight mb-4">Join <span class="bg-gradient-to-r from-accent via-primary to-accent bg-clip-text text-transparent italic">Thousands</span> of Global Traders</h2>
            <p class="text-white/40 leading-relaxed mb-8">Create a free account to start sourcing products from verified local manufacturers worldwide.</p>
            <div class="space-y-4">
                @foreach(['✓ Free account, no credit card required','✓ Browse thousands of verified vendors','✓ Submit RFQs instantly'] as $point)
                <div class="flex items-center gap-3 text-white/50 text-sm font-semibold">
                    <div class="w-6 h-6 bg-gradient-to-br from-accent/20 to-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent text-[9px]"></i>
                    </div>
                    {{ $point }}
                </div>
                @endforeach
            </div>
        </div>
        <p class="text-white/15 text-xs relative">© {{ date('Y') }} B2B Marketplace</p>
    </div>

    {{-- Right panel --}}
    <div class="flex-1 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            {{-- Back to Home Button - Above Create Account --}}
            <div class="mb-8 text-left">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 text-slate-600 hover:text-blue-600 text-sm font-semibold transition-all group">
                    <i class="fas fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                    <span>Back to Home</span>
                </a>
            </div>

            <a href="{{ route('home') }}" class="flex items-center gap-2 justify-center mb-10 lg:hidden">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-dark rounded-xl flex items-center justify-center shadow-blue">
                    <span class="text-white font-black text-xl" style="font-family:var(--font-heading)">B</span>
                </div>
            </a>
            <div class="mb-8 text-center lg:text-left">
                <h1 class="font-heading font-black text-secondary text-3xl mb-2">Create Account</h1>
                <p class="text-secondary/50 text-sm">Join the B2B Marketplace for free</p>
            </div>

            <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-3 w-full border-2 border-secondary/10 rounded-2xl py-3.5 text-sm font-bold text-secondary/80 hover:border-primary hover:text-primary hover:bg-primary/3 transition-all duration-300 mb-6 group">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Continue with Google
            </a>
            <div class="relative flex items-center mb-6">
                <div class="flex-1 border-t border-secondary/8"></div>
                <span class="mx-4 text-xs text-secondary/30 font-bold uppercase tracking-widest">or</span>
                <div class="flex-1 border-t border-secondary/8"></div>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white border-2 border-secondary/8 text-secondary placeholder:text-secondary/40 text-sm font-semibold rounded-2xl py-3.5 px-5 focus:outline-none focus:border-primary focus:bg-white transition-all @error('name') border-danger @enderror" required autofocus placeholder="John Smith">
                    @error('name') <p class="text-danger text-xs mt-2 font-semibold flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-white border-2 border-secondary/8 text-secondary placeholder:text-secondary/40 text-sm font-semibold rounded-2xl py-3.5 px-5 focus:outline-none focus:border-primary focus:bg-white transition-all @error('email') border-danger @enderror" required placeholder="you@company.com">
                    @error('email') <p class="text-danger text-xs mt-2 font-semibold flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-white border-2 border-secondary/8 text-secondary placeholder:text-secondary/40 text-sm font-semibold rounded-2xl py-3.5 px-5 focus:outline-none focus:border-primary focus:bg-white transition-all @error('password') border-danger @enderror" required placeholder="Min. 8 characters">
                    @error('password') <p class="text-danger text-xs mt-2 font-semibold flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-secondary mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full bg-white border-2 border-secondary/8 text-secondary placeholder:text-secondary/40 text-sm font-semibold rounded-2xl py-3.5 px-5 focus:outline-none focus:border-primary focus:bg-white transition-all" required placeholder="Repeat password">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-primary to-primary-dark text-white font-black text-[11px] uppercase tracking-widest py-4 rounded-2xl hover:shadow-blue transition-all duration-300 hover:scale-105 active:scale-95 flex items-center justify-center gap-2 mt-6">
                    <i class="fas fa-user-plus"></i> Create Free Account
                </button>
            </form>

            <p class="text-center text-sm text-secondary/50 font-semibold mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary font-black hover:underline">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection
