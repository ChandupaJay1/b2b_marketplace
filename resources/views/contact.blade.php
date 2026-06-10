@extends('layouts.app')
@section('title', 'Contact Us — B2B Marketplace')

@section('content')

{{-- Header --}}
<section class="relative bg-secondary py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-80 h-80 bg-primary rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 text-center relative reveal-up">
        <span class="section-label text-accent justify-center"><span class="w-5 h-px bg-accent"></span> Get In Touch</span>
        <h1 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-4">Contact <span class="text-gradient-gold italic">Us</span></h1>
        <p class="text-white/50 text-lg">We'd love to hear from you. Drop us a message!</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        {{-- Info --}}
        <div class="space-y-6 reveal-left">
            <div>
                <h2 class="font-heading font-black text-secondary text-2xl mb-3">Let's Talk</h2>
                <p class="text-secondary/50 leading-relaxed">Have questions about our platform? Our team is here to help you source globally.</p>
            </div>
            @foreach([
                ['fas fa-envelope', 'Email', 'info@b2bmarket.com', 'mailto:info@b2bmarket.com'],
                ['fas fa-phone', 'Phone', '+1 (555) 123-4567', 'tel:+15551234567'],
                ['fas fa-map-marker-alt', 'Address', '123 Trade Center, Business District, Colombo 01, Sri Lanka', null],
                ['fas fa-clock', 'Business Hours', 'Monday – Friday: 9:00 AM – 6:00 PM', null],
            ] as [$icon, $label, $value, $link])
            <div class="flex items-start gap-4">
                <div class="w-11 h-11 bg-primary/8 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="{{ $icon }} text-primary text-sm"></i>
                </div>
                <div>
                    <p class="font-black text-secondary text-xs uppercase tracking-widest mb-0.5">{{ $label }}</p>
                    @if($link)
                        <a href="{{ $link }}" class="text-secondary/60 text-sm hover:text-primary transition-colors font-medium">{{ $value }}</a>
                    @else
                        <p class="text-secondary/60 text-sm font-medium">{{ $value }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Form --}}
        <div class="lg:col-span-2 reveal-right">
            <div class="card p-8 sm:p-10">
                <h2 class="font-heading font-black text-secondary text-2xl mb-7">Send a Message</h2>
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="label">Your Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="input-field @error('name') border-danger @enderror" required placeholder="John Smith">
                            @error('name') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="input-field @error('email') border-danger @enderror" required placeholder="john@company.com">
                            @error('email') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="label">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="input-field" placeholder="+1 555 0000">
                        </div>
                        <div>
                            <label class="label">Subject *</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="input-field @error('subject') border-danger @enderror" required placeholder="How can we help?">
                            @error('subject') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="label">Message *</label>
                        <textarea name="message" rows="6" class="input-field resize-none @error('message') border-danger @enderror" required placeholder="Your message...">{{ old('message') }}</textarea>
                        @error('message') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="btn-primary w-full text-[11px]">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
