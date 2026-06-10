@extends('layouts.app')
@section('title', 'About Us — B2B Marketplace')

@section('content')

{{-- Hero --}}
<section class="relative bg-secondary py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
        <div class="reveal-up">
            <span class="section-label text-accent justify-center"><span class="w-5 h-px bg-accent"></span> Our Platform</span>
            <h1 class="font-heading font-black text-white text-5xl sm:text-6xl lg:text-7xl leading-tight mb-6">About <span class="text-gradient-gold italic">B2B Marketplace</span></h1>
            <p class="text-white/50 text-xl max-w-2xl mx-auto leading-relaxed">Empowering local manufacturers to reach the global market — one verified vendor at a time.</p>
        </div>
    </div>
</section>

{{-- Mission --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal-left">
                <span class="section-label"><span class="w-5 h-px bg-primary"></span> Our Mission</span>
                <h2 class="section-title text-4xl sm:text-5xl leading-tight mb-6">Bridging Local Talent with <span class="text-gradient italic">Global Opportunity</span></h2>
                <div class="section-divider"></div>
                <p class="text-secondary/60 text-lg leading-relaxed mb-6 mt-4">B2B Marketplace was built with a singular vision: to give local manufacturers a powerful stage to showcase authentic products to international buyers — removing barriers and connecting opportunity.</p>
                <p class="text-secondary/50 leading-relaxed">Our platform streamlines the entire procurement pipeline from discovery to quotation, making global sourcing as straightforward as a local purchase.</p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="{{ route('vendors.index') }}" class="btn-primary text-[11px]"><i class="fas fa-store"></i> Browse Vendors</a>
                    <a href="{{ route('rfq.create') }}" class="btn-secondary text-[11px]"><i class="fas fa-file-invoice"></i> Request Quote</a>
                </div>
            </div>
            <div class="reveal-right">
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['500+', 'Verified Vendors', 'bg-primary/8 text-primary'],
                        ['5,000+', 'Products Listed', 'bg-accent/10 text-accent-dark'],
                        ['50+', 'Countries Reached', 'bg-success/8 text-success'],
                        ['10K+', 'RFQs Processed', 'bg-primary/8 text-primary'],
                    ] as [$num, $label, $color])
                    <div class="card p-7 text-center hover:-translate-y-1 hover:shadow-premium transition-all duration-500">
                        <p class="font-heading font-black text-4xl {{ $color }} mb-2">{{ $num }}</p>
                        <p class="text-secondary/50 text-sm font-semibold">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="py-24 bg-secondary relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-14 reveal-up">
            <span class="section-label text-accent justify-center"><span class="w-5 h-px bg-accent"></span> What We Stand For</span>
            <h2 class="font-heading font-black text-white text-4xl sm:text-5xl leading-tight">Our Core <span class="text-gradient-gold italic">Values</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['fas fa-shield-check', 'Trust & Verification', 'All vendors go through rigorous verification. Buyers can source confidently knowing every listing is authentic.', 'bg-primary/20 text-primary'],
                ['fas fa-globe-americas', 'Global Reach', 'We equip local businesses with the tools and visibility to connect with buyers across 50+ countries.', 'bg-accent/20 text-accent'],
                ['fas fa-handshake', 'Partnership First', 'Long-term relationships between buyers and vendors are the foundation of our platform.', 'bg-success/20 text-success'],
            ] as [$icon, $title, $desc, $iconStyle])
            <div class="reveal-up glass-dark rounded-3xl p-8 border border-white/5 hover:border-primary/20 transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 {{ $iconStyle }} rounded-2xl flex items-center justify-center mb-6">
                    <i class="{{ $icon }} text-xl"></i>
                </div>
                <h3 class="font-heading font-black text-white text-xl mb-3">{{ $title }}</h3>
                <p class="text-white/40 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-dot-pattern">
    <div class="max-w-3xl mx-auto px-4 text-center reveal-up">
        <span class="section-label justify-center"><span class="w-5 h-px bg-primary"></span> Join Today</span>
        <h2 class="section-title text-4xl sm:text-5xl mb-6">Ready to Start <span class="text-gradient italic">Trading?</span></h2>
        <div class="section-divider mx-auto"></div>
        <p class="text-secondary/50 text-lg mt-5 mb-10">Join thousands of businesses already discovering quality products on our platform.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('vendors.index') }}" class="btn-primary text-[11px]"><i class="fas fa-store"></i> Browse Vendors</a>
            <a href="{{ route('contact') }}" class="btn-secondary text-[11px]"><i class="fas fa-headset"></i> Contact Us</a>
        </div>
    </div>
</section>

@endsection
