@extends('layouts.app')
@section('title', 'Request for Quotation — B2B Marketplace')

@section('content')

{{-- Header --}}
<section class="relative bg-secondary py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-80 h-80 bg-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 text-center relative reveal-up">
        <span class="section-label text-accent justify-center"><span class="w-5 h-px bg-accent"></span> Procurement</span>
        <h1 class="font-heading font-black text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-4">Request for <span class="text-gradient-gold italic">Quotation</span></h1>
        <p class="text-white/50 text-lg">Tell us what you need and we'll connect you with the right vendors</p>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    @if($vendor || $product)
    <div class="flex items-center gap-4 bg-primary/8 border border-primary/15 rounded-2xl p-5 mb-8">
        <div class="w-10 h-10 bg-primary/15 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-info-circle text-primary"></i>
        </div>
        <p class="text-secondary text-sm font-semibold">
            @if($product)
                Requesting quote for: <strong class="text-primary">{{ $product->name }}</strong>
                @if($product->vendor) from <strong class="text-primary">{{ $product->vendor->company_name }}</strong>@endif
            @elseif($vendor)
                Requesting quote from: <strong class="text-primary">{{ $vendor->company_name }}</strong>
            @endif
        </p>
    </div>
    @endif

    <div class="card p-8 sm:p-10">
        <form action="{{ route('rfq.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($vendor) <input type="hidden" name="vendor_id" value="{{ $vendor->id }}"> @endif
            @if($product) <input type="hidden" name="product_id" value="{{ $product->id }}"> @endif

            <div>
                <h2 class="font-heading font-black text-secondary text-xl pb-4 border-b border-secondary/8 mb-5">Your Contact Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="label">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()?->name) }}" class="input-field @error('name') border-danger @enderror" required placeholder="John Smith">
                        @error('name') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="label">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()?->email) }}" class="input-field @error('email') border-danger @enderror" required placeholder="john@company.com">
                        @error('email') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="label">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="input-field" placeholder="+1 555 0000">
                    </div>
                    <div>
                        <label class="label">Company Name</label>
                        <input type="text" name="company" value="{{ old('company') }}" class="input-field" placeholder="Your company">
                    </div>
                    <div>
                        <label class="label">Country</label>
                        <input type="text" name="country" value="{{ old('country') }}" class="input-field" placeholder="United States">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="font-heading font-black text-secondary text-xl pb-4 border-b border-secondary/8 mb-5">Product Requirements</h2>
                <div class="space-y-5">
                    <div>
                        <label class="label">Product / Service Description *</label>
                        <textarea name="product_description" rows="4" class="input-field resize-none @error('product_description') border-danger @enderror" required
                            placeholder="Describe the product, specifications, certifications required...">{{ old('product_description', $product?->name) }}</textarea>
                        @error('product_description') <p class="text-danger text-xs mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="label">Quantity Required</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" class="input-field" min="1" placeholder="e.g. 500">
                        </div>
                        <div>
                            <label class="label">Unit (kg, pieces, liters…)</label>
                            <input type="text" name="unit" value="{{ old('unit', $product?->unit) }}" class="input-field" placeholder="kg">
                        </div>
                    </div>
                    <div>
                        <label class="label">Additional Requirements</label>
                        <textarea name="additional_requirements" rows="3" class="input-field resize-none"
                            placeholder="Packaging, delivery terms, certifications, etc.">{{ old('additional_requirements') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-start gap-3 bg-accent/8 border border-accent/15 rounded-2xl p-4">
                <i class="fas fa-lightbulb text-accent-dark mt-0.5"></i>
                <p class="text-secondary/60 text-sm leading-relaxed"><strong class="text-secondary">Pro tip:</strong> The more detail you include, the faster and more accurate the quotes you receive will be.</p>
            </div>

            <button type="submit" class="btn-primary w-full text-[11px] py-4">
                <i class="fas fa-paper-plane"></i> Submit Request for Quotation
            </button>
        </form>
    </div>
</div>
@endsection
