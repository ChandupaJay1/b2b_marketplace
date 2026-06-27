@extends('layouts.app')
@section('title', 'Contact Us | B2B Marketplace')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO HEADER
═══════════════════════════════════════════════ --}}
<section class="relative py-28 lg:py-40 bg-gradient-to-br from-secondary via-primary-dark to-secondary overflow-hidden">
    {{-- Gradient lines --}}
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-primary/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-400/40 to-transparent"></div>

    {{-- Glow orbs --}}
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 py-2 px-5 bg-white/5 border border-white/10 backdrop-blur-md text-primary/60 text-[10px] font-bold uppercase tracking-[0.25em] rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                Get In Touch
            </span>
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-heading font-black text-white leading-[0.9] mb-6 tracking-tight">
                Contact <br><span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Us</span>
            </h1>
            <p class="text-white/60 text-sm sm:text-base font-medium max-w-xl mx-auto leading-relaxed mb-10">
                Have questions? Need assistance? Our team is here to help you connect with the right vendors.
            </p>
            <nav class="flex justify-center items-center gap-2 text-white/50 text-[10px] font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                <span class="text-white/60">Contact</span>
            </nav>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     CONTACT SECTION
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-gradient-to-b from-surface to-white relative overflow-hidden">
    <div class="absolute -top-40 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            {{-- Contact Info Cards --}}
            <div class="lg:w-1/3 flex flex-col gap-6">
                {{-- Email Card --}}
                <div class="bg-white p-10 rounded-[40px] shadow-xl border border-slate-200 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <h4 class="text-xl font-black mb-2 text-slate-900">Email Us</h4>
                    <a href="mailto:info@b2bmarketplace.com" class="text-primary font-bold text-lg mb-1 block hover:underline">info@b2bmarketplace.com</a>
                    <p class="text-slate-600 text-xs font-medium">Available Mon – Fri, 9am to 6pm</p>
                </div>

                {{-- Phone Card --}}
                <div class="bg-white p-10 rounded-[40px] shadow-xl border border-slate-200 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                        <i class="fas fa-phone text-xl"></i>
                    </div>
                    <h4 class="text-xl font-black mb-2 text-slate-900">Call Us</h4>
                    <a href="tel:+11234567890" class="text-primary font-bold text-lg mb-1 block hover:underline">+1 (123) 456-7890</a>
                    <p class="text-slate-600 text-xs font-medium">Mon – Fri, 9am to 6pm (EST)</p>
                </div>

                {{-- Social Media Card --}}
                <div class="bg-white p-10 rounded-[40px] shadow-xl border border-slate-200 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                        <i class="fas fa-share-alt text-xl"></i>
                    </div>
                    <h4 class="text-xl font-black mb-2 text-slate-900">Follow Us</h4>
                    <div class="flex items-center gap-3 mt-4">
                        <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-primary hover:border-primary hover:text-white transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" aria-label="Twitter" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-primary hover:border-primary hover:text-white transition-all duration-300">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-primary hover:border-primary hover:text-white transition-all duration-300">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                        <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-primary hover:border-primary hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    </div>
                    <p class="text-slate-600 text-xs font-medium mt-3">We respond within 24 hours</p>
                </div>

                {{-- Location Card --}}
                <div class="bg-white p-10 rounded-[40px] shadow-xl border border-slate-200 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                        <i class="fas fa-map-marker-alt text-xl"></i>
                    </div>
                    <h4 class="text-xl font-black mb-2 text-slate-900">Visit Us</h4>
                    <p class="text-primary font-bold text-base mb-1 leading-snug">123 Business Plaza,<br>Trade Center, Suite 456</p>
                    <p class="text-slate-600 text-xs font-medium">View on Google Maps</p>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:w-2/3">
                <div class="bg-white p-10 lg:p-16 rounded-[50px] shadow-xl border border-slate-200">
                    <div class="mb-10">
                        <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-3 block">Send us a message</span>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-black text-slate-900 leading-tight">
                            Let's Start a <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Conversation</span>
                        </h2>
                    </div>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-primary/10 border border-primary/20 text-green-800 rounded-2xl text-sm">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-800 rounded-2xl text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600 ml-4 uppercase tracking-wider">Your Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-3xl py-5 px-8 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="Full name">
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1 ml-4">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600 ml-4 uppercase tracking-wider">Business Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-3xl py-5 px-8 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="you@company.com">
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1 ml-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600 ml-4 uppercase tracking-wider">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-3xl py-5 px-8 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="+1 234 567 8900">
                                @error('phone')
                                    <p class="text-red-600 text-xs mt-1 ml-4">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600 ml-4 uppercase tracking-wider">Subject *</label>
                                <select name="subject" required
                                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-3xl py-5 px-8 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
                                    <option value="">Select a subject</option>
                                    <option value="general" @selected(old('subject') == 'general')>General Inquiry</option>
                                    <option value="vendor" @selected(old('subject') == 'vendor')>Vendor Registration</option>
                                    <option value="buyer" @selected(old('subject') == 'buyer')>Buyer Support</option>
                                    <option value="partnership" @selected(old('subject') == 'partnership')>Partnership Opportunity</option>
                                    <option value="technical" @selected(old('subject') == 'technical')>Technical Support</option>
                                    <option value="other" @selected(old('subject') == 'other')>Other</option>
                                </select>
                                @error('subject')
                                    <p class="text-red-600 text-xs mt-1 ml-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-600 ml-4 uppercase tracking-wider">Your Message *</label>
                            <textarea name="message" rows="6" required
                                      class="w-full bg-slate-50 border-2 border-slate-200 rounded-3xl py-5 px-8 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm resize-none"
                                      placeholder="Tell us how we can help you...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-xs mt-1 ml-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                    class="group relative px-12 py-5 bg-gradient-to-r from-primary to-primary-dark text-white rounded-full font-black text-sm uppercase tracking-widest hover:from-primary-dark hover:to-primary-dark transition-all shadow-xl shadow-primary/30 flex items-center gap-3 overflow-hidden">
                                <span class="relative z-10">Send Message</span>
                                <i class="fas fa-paper-plane relative z-10 text-xs group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     MAP SECTION
═══════════════════════════════════════════════ --}}
<div class="h-[450px] w-full bg-slate-200 relative overflow-hidden">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596073366!2d-74.25986548248684!3d40.69714941680757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s"
            class="w-full h-full border-none grayscale hover:grayscale-0 transition-all duration-700"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

{{-- ═══════════════════════════════════════════════
     QUICK STATS
═══════════════════════════════════════════════ --}}
<section class="py-16 bg-gradient-to-br from-secondary via-primary-dark to-secondary text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.08]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach([
                ['fa-clock', '24h', 'Response Time'],
                ['fa-users', '1000+', 'Active Vendors'],
                ['fa-globe', '50+', 'Countries'],
                ['fa-certificate', '100%', 'Verified']
            ] as [$icon, $val, $label])
            <div class="group">
                <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-amber-300 mx-auto mb-4 group-hover:bg-primary group-hover:border-primary transition-all">
                    <i class="fas {{ $icon }} text-sm"></i>
                </div>
                <div class="text-3xl font-heading font-black text-white mb-1">{{ $val }}</div>
                <div class="text-white/50 text-[10px] font-bold uppercase tracking-widest">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     FAQ SECTION
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Common Questions</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                Frequently Asked <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Questions</span>
            </h2>
        </div>

        <div class="space-y-4">
            @foreach([
                ['How do I register as a vendor?', 'You can register as a vendor by clicking the "Sign Up" button and selecting "Vendor" during registration. After completing your profile, our team will review and verify your account within 48 hours.'],
                ['Is there a fee to use the platform?', 'Creating an account and browsing vendors is completely free. We charge a small commission only on completed transactions to maintain and improve our platform.'],
                ['How long does vendor verification take?', 'Vendor verification typically takes 24-48 hours. We carefully review each application to ensure all vendors meet our quality and reliability standards.'],
                ['Can I request quotes from multiple vendors?', 'Yes! Our RFQ (Request for Quotation) system allows you to submit one request and receive competitive quotes from multiple verified vendors.'],
                ['What payment methods do you support?', 'We support various payment methods including bank transfers, credit cards, and secure escrow services for larger transactions. Payment terms are agreed directly between buyers and vendors.']
            ] as [$question, $answer])
            <details class="group bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden hover:border-primary/20 transition-colors">
                <summary class="flex items-center justify-between cursor-pointer p-6 font-bold text-slate-900 text-sm">
                    <span>{{ $question }}</span>
                    <i class="fas fa-chevron-down text-primary text-xs group-open:rotate-180 transition-transform"></i>
                </summary>
                <div class="px-6 pb-6 text-slate-600 text-sm leading-relaxed">
                    {{ $answer }}
                </div>
            </details>
            @endforeach
        </div>

        <div class="mt-12 text-center p-8 bg-primary/5 rounded-3xl border border-primary/10">
            <p class="text-slate-700 font-medium mb-4">Still have questions?</p>
            <p class="text-slate-600 text-sm mb-6">Can't find the answer you're looking for? Our support team is here to help.</p>
            <a href="mailto:info@b2bmarketplace.com" class="inline-flex items-center gap-2 px-8 py-3 bg-primary text-white font-bold text-sm rounded-full hover:bg-primary-dark transition-all">
                <i class="fas fa-envelope text-xs"></i>
                Email Support
            </a>
        </div>
    </div>
</section>

@endsection
