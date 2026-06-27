@extends('layouts.app')
@section('title', 'Request for Quotation | B2B Marketplace')

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
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-ping"></span>
                Get Competitive Quotes
            </span>
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-heading font-black text-white leading-[0.9] mb-6 tracking-tight">
                Request for <br><span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Quotation</span>
            </h1>
            <p class="text-white/60 text-sm sm:text-base font-medium max-w-xl mx-auto leading-relaxed mb-10">
                Connect with verified vendors and receive competitive quotes within 48 hours. Fast, secure, and completely free.
            </p>
            <nav class="flex justify-center items-center gap-2 text-white/50 text-[10px] font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
                <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                <span class="text-white/60">Request Quote</span>
            </nav>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     INTRO STATS STRIP
═══════════════════════════════════════════════ --}}
<div class="bg-primary relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/asfalt-dark.png')] opacity-[0.08]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-white/10">
            @foreach([
                ['fa-users', '1000+', 'Verified Vendors'],
                ['fa-globe', '50+', 'Countries Served'],
                ['fa-certificate', '100%', 'Verified Products'],
                ['fa-clock', '48 hrs', 'Quote Response Time'],
            ] as [$icon, $val, $label])
            <div class="py-8 px-6 lg:px-10 text-center group">
                <i class="fas {{ $icon }} text-white/30 text-lg mb-3 block group-hover:text-amber-300 transition-colors"></i>
                <div class="text-2xl font-heading font-black text-white mb-1">{{ $val }}</div>
                <div class="text-white/50 text-[9px] font-bold uppercase tracking-widest">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     QUOTE REQUEST FORM
═══════════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-gradient-to-b from-surface to-white relative overflow-hidden">
    <div class="absolute -top-40 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

            {{-- Left: copy --}}
            <div class="lg:w-2/5 lg:sticky lg:top-32">
                <span class="text-primary font-bold uppercase tracking-[0.2em] text-[10px] mb-4 block">Fast Track</span>
                <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none mb-6">
                    Submit Your <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Requirements</span>
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed font-medium mb-10">
                    Fill in your requirements and our verified vendors will respond with detailed quotations within 48 hours.
                </p>

                <div class="space-y-5">
                    @foreach([
                        ['fa-bolt', 'Fast Response', '48-hour quote turnaround guaranteed'],
                        ['fa-lock', 'Confidential', 'Your business data is fully protected'],
                        ['fa-headset', 'Dedicated Support', 'Customer support team ready to assist'],
                        ['fa-shield-halved', 'Verified Vendors', 'Connect only with verified suppliers'],
                    ] as [$icon, $title, $desc])
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all">
                            <i class="fas {{ $icon }} text-sm"></i>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">{{ $title }}</div>
                            <div class="text-slate-600 text-xs font-medium mt-0.5">{{ $desc }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: form --}}
            <div class="lg:w-3/5">
                <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-200">
                    <form method="POST" action="{{ route('rfq.store') }}" class="space-y-6">
                        @csrf
                        
                        {{-- Personal Information --}}
                        <div>
                            <h3 class="text-lg font-heading font-black text-slate-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Full Name *</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your name">
                                    @error('name')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Company Name</label>
                                    <input type="text" name="company" value="{{ old('company') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your company">
                                    @error('company')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Business Email *</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="you@company.com">
                                    @error('email')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Phone Number</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="+1 234 567 8900">
                                    @error('phone')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Country *</label>
                                    <input type="text" name="country" value="{{ old('country') }}" required
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your country">
                                    @error('country')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">City</label>
                                    <input type="text" name="city" value="{{ old('city') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your city">
                                    @error('city')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Product Requirements --}}
                        <div class="border-t-2 border-slate-200 pt-6">
                            <h3 class="text-lg font-heading font-black text-slate-900 mb-4">Product Requirements</h3>

                            {{-- Vendor select --}}
                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Preferred Vendor (Optional)</label>
                                <select id="vendor-select" name="vendor_id"
                                        class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
                                    <option value="">Any Vendor (Send to all)</option>
                                    @foreach(\App\Models\Vendor::where('status', 'approved')->orderBy('company_name')->get() as $v)
                                        <option value="{{ $v->id }}"
                                                data-slug="{{ $v->slug }}"
                                                @selected(
                                                    old('vendor_id', isset($vendor) ? $vendor->id : '') == $v->id
                                                )>
                                            {{ $v->company_name }}{{ $v->country ? ' — ' . $v->country : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-slate-500 ml-1">Leave empty to receive quotes from all matching vendors</p>
                                @error('vendor_id')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            {{-- Vendor's products suggestion chips --}}
                            <div id="vendor-products-wrap" class="mb-5 hidden">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">
                                        Products by this Vendor
                                        <span class="text-primary ml-1 normal-case font-medium">(click to add)</span>
                                    </label>
                                    <span id="vendor-products-count" class="text-[10px] text-white/50 font-semibold"></span>
                                </div>
                                <div id="vendor-products-loading" class="hidden py-4 text-center">
                                    <div class="inline-flex items-center gap-2 text-xs text-white/50">
                                        <svg class="w-4 h-4 animate-spin text-primary" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                        </svg>
                                        Loading products…
                                    </div>
                                </div>
                                <div id="vendor-products-chips"
                                     class="flex flex-wrap gap-2 max-h-36 overflow-y-auto p-3 bg-slate-50 border-2 border-slate-200 rounded-xl">
                                </div>
                                <p class="text-[10px] text-white/50 mt-1.5 ml-1">
                                    <i class="fas fa-info-circle"></i> Click a product to add it to your selection
                                </p>
                            </div>

                            {{-- Add custom product --}}
                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Add Product Manually</label>
                                <div class="flex gap-2">
                                    <input type="text" id="custom-product-input"
                                           class="flex-1 bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Type a product name and press Add">
                                    <button type="button" id="add-custom-product-btn"
                                            class="btn-primary px-6 text-xs whitespace-nowrap">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>

                            {{-- Product Category --}}
                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Product Category</label>
                                <select name="product_category_id"
                                        class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
                                    <option value="">Select a category</option>
                                    @foreach(\App\Models\ProductCategory::where('is_active', true)->get() as $category)
                                        <option value="{{ $category->id }}" @selected(old('product_category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_category_id')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Selected Products Table --}}
                            <div id="selected-products-wrap" class="mb-5 {{ old('items') ? '' : 'hidden' }}">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">
                                        Selected Products <span class="text-red-500">*</span>
                                        <span id="selected-count" class="text-primary ml-1 normal-case font-medium">(0 items)</span>
                                    </label>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="border-b-2 border-slate-200 text-left">
                                                <th class="pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider w-1/2">Product</th>
                                                <th class="pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider w-1/5">Quantity</th>
                                                <th class="pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider w-1/5">Unit</th>
                                                <th class="pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider w-1/12"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="selected-products-tbody">
                                        </tbody>
                                    </table>
                                </div>
                                <p id="no-items-msg" class="text-xs text-white/50 italic py-4 text-center">
                                    No products selected yet. Click vendor products above or add manually.
                                </p>
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Target Price (Optional)</label>
                                <input type="number" name="target_price" value="{{ old('target_price') }}" step="0.01" min="0"
                                       class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="Your target price per unit">
                                @error('target_price')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Delivery Location</label>
                                <input type="text" name="delivery_location" value="{{ old('delivery_location') }}"
                                       class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="Port/City for delivery">
                                @error('delivery_location')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Additional Requirements</label>
                                <textarea name="additional_requirements" rows="4"
                                          class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/50 focus:border-transparent transition-all text-slate-900 font-medium text-sm resize-none"
                                          placeholder="Specifications, certifications needed, packaging requirements, delivery timeline...">{{ old('additional_requirements') }}</textarea>
                                @error('additional_requirements')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Terms Agreement --}}
                        <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-xl border border-primary/20">
                            <input type="checkbox" name="agree_terms" id="agree_terms" required class="mt-1 rounded text-primary">
                            <label for="agree_terms" class="text-xs text-slate-700 font-medium">
                                I agree to share my information with verified vendors and accept the <a href="#" class="text-primary hover:underline">Terms & Conditions</a>
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="group w-full py-5 bg-gradient-to-r from-primary to-primary-dark text-white rounded-xl font-bold text-sm uppercase tracking-wide hover:from-primary-dark hover:to-primary-dark transition-all shadow-xl shadow-primary/30 flex items-center justify-center gap-3 relative overflow-hidden">
                            <span class="relative z-10">Submit RFQ Request</span>
                            <i class="fas fa-arrow-right relative z-10 text-sm group-hover:translate-x-2 transition-transform"></i>
                        </button>

                        <p class="text-center text-xs text-slate-500 font-medium">
                            By submitting, you'll receive quotes from multiple verified vendors within 48 hours.
                        </p>
                    </form>
                </div>
            </div>

        </div>{{-- /flex container --}}
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     HOW IT WORKS
═══════════════════════════════════════════════ --}}
<section class="py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-primary font-bold uppercase tracking-[0.2em] text-[10px] mb-3 block">Simple Process</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                How It <span class="bg-gradient-to-r from-primary to-primary-dark bg-clip-text text-transparent italic">Works</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach([
                ['1', 'fa-edit', 'Submit RFQ', 'Fill out the form with your product requirements'],
                ['2', 'fa-search', 'Vendor Match', 'System matches with verified vendors automatically'],
                ['3', 'fa-file-invoice-dollar', 'Receive Quotes', 'Get competitive quotes within 48 hours'],
                ['4', 'fa-handshake', 'Choose & Order', 'Compare quotes and place your order'],
            ] as [$num, $icon, $title, $desc])
            <div class="text-center group">
                <div class="relative inline-block mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center text-sm font-black">
                        {{ $num }}
                    </div>
                </div>
                <h3 class="font-heading font-black text-slate-900 text-lg mb-2">{{ $title }}</h3>
                <p class="text-slate-600 text-sm font-medium">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Chip highlight flash */
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0);    opacity: 1; }
    }
    .animate-slide-in { animation: slideInRight 0.3s ease-out; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const vendorSelect      = document.getElementById('vendor-select');
    const productsWrap      = document.getElementById('vendor-products-wrap');
    const chipsContainer    = document.getElementById('vendor-products-chips');
    const loadingSpinner    = document.getElementById('vendor-products-loading');
    const countLabel        = document.getElementById('vendor-products-count');
    const selectedWrap      = document.getElementById('selected-products-wrap');
    const selectedTbody     = document.getElementById('selected-products-tbody');
    const selectedCount     = document.getElementById('selected-count');
    const noItemsMsg        = document.getElementById('no-items-msg');
    const customInput       = document.getElementById('custom-product-input');
    const addCustomBtn      = document.getElementById('add-custom-product-btn');

    let items = [];
    let itemIdCounter = 0;

    const UNITS = ['pieces', 'kg', 'tons', 'liters', 'meters', 'sets', 'containers'];

    @if(isset($vendor))
    const preSelectedVendorId = '{{ $vendor->id }}';
    @else
    const preSelectedVendorId = null;
    @endif

    @if(isset($product))
    const preSelectedProduct = { id: '{{ $product->id }}', name: @json($product->name) };
    @else
    const preSelectedProduct = null;
    @endif

    function renderTable() {
        selectedTbody.innerHTML = '';
        items.forEach((item, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'border-b border-slate-100 animate-slide-in';
            tr.dataset.index = idx;

            tr.innerHTML = `
                <td class="py-3 pr-2">
                    <input type="hidden" name="items[${idx}][product_id]" value="${item.productId || ''}">
                    <input type="hidden" name="items[${idx}][product_name]" value="${item.name}">
                    <span class="font-medium text-slate-900 text-sm">${item.name}</span>
                </td>
                <td class="py-3 px-1">
                    <input type="number" name="items[${idx}][quantity]" value="${item.quantity}"
                           min="1" step="any"
                           class="item-qty w-full bg-slate-100 border-2 border-slate-200 rounded-lg py-2 px-3 text-sm font-medium text-slate-900 focus:ring-2 focus:ring-primary/50 focus:border-transparent"
                           placeholder="Qty">
                </td>
                <td class="py-3 px-1">
                    <select name="items[${idx}][unit]"
                            class="item-unit w-full bg-slate-100 border-2 border-slate-200 rounded-lg py-2 px-3 text-sm font-medium text-slate-900 focus:ring-2 focus:ring-primary/50 focus:border-transparent cursor-pointer">
                        ${UNITS.map(u => `<option value="${u}" ${u === item.unit ? 'selected' : ''}>${u.charAt(0).toUpperCase() + u.slice(1)}${u === 'kg' ? ' (kg)' : u === 'tons' ? '' : u === 'liters' ? '' : ''}</option>`).join('')}
                    </select>
                </td>
                <td class="py-3 pl-2 text-right">
                    <button type="button" class="remove-item w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" data-id="${item.uid}">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </td>
            `;

            selectedTbody.appendChild(tr);

            // Attach events
            tr.querySelector('.item-qty').addEventListener('input', function () {
                items[idx].quantity = this.value;
            });
            tr.querySelector('.item-unit').addEventListener('change', function () {
                items[idx].unit = this.value;
            });
            tr.querySelector('.remove-item').addEventListener('click', function () {
                removeItem(this.dataset.id);
            });
        });

        selectedCount.textContent = `(${items.length} item${items.length !== 1 ? 's' : ''})`;

        if (items.length === 0) {
            selectedWrap.classList.add('hidden');
            noItemsMsg.classList.remove('hidden');
        } else {
            selectedWrap.classList.remove('hidden');
            noItemsMsg.classList.add('hidden');
        }

        // Update submit form validation
        updateSubmitValidation();
    }

    function addItem(name, productId, quantity, unit) {
        const uid = ++itemIdCounter;
        items.push({
            uid: uid,
            name: name,
            productId: productId || '',
            quantity: quantity || '',
            unit: unit || 'pieces',
        });
        renderTable();
    }

    function removeItem(uid) {
        items = items.filter(i => i.uid != uid);
        renderTable();
    }

    function updateSubmitValidation() {
        const submitBtn = document.querySelector('button[type="submit"]');
        if (items.length === 0) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            submitBtn.title = 'Please add at least one product';
        } else {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitBtn.title = '';
        }
    }

    // Load vendor products
    function loadVendorProducts(vendorId) {
        if (!vendorId) {
            productsWrap.classList.add('hidden');
            chipsContainer.innerHTML = '';
            return;
        }

        productsWrap.classList.remove('hidden');
        chipsContainer.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');
        countLabel.textContent = '';

        fetch(`/api/vendor/${vendorId}/products`)
            .then(r => r.json())
            .then(data => {
                loadingSpinner.classList.add('hidden');
                chipsContainer.classList.remove('hidden');
                chipsContainer.innerHTML = '';

                const products = data.products || [];
                countLabel.textContent = products.length + ' product' + (products.length !== 1 ? 's' : '');

                if (products.length === 0) {
                    chipsContainer.innerHTML = '<p class="text-xs text-white/50 italic py-2">No products found for this vendor.</p>';
                    return;
                }

                products.forEach(p => {
                    const chip = document.createElement('button');
                    chip.type = 'button';
                    chip.className = 'px-3 py-1.5 rounded-full text-xs font-bold border-2 border-slate-200 text-slate-600 hover:border-primary/50 hover:text-primary hover:bg-primary/5 transition-all duration-150 flex items-center gap-1.5';
                    chip.innerHTML = `<i class="fas fa-plus text-[9px] text-primary"></i>${p.name}${p.sku ? '<span class="opacity-40 font-normal ml-1 text-[9px]">#' + p.sku + '</span>' : ''}`;

                    chip.addEventListener('click', () => {
                        addItem(p.name, p.id, '', 'pieces');
                        chip.classList.add('opacity-40', 'pointer-events-none');
                        chip.innerHTML = `<i class="fas fa-check text-[9px] text-primary"></i>${p.name}${p.sku ? '<span class="opacity-40 font-normal ml-1 text-[9px]">#' + p.sku + '</span>' : ''}`;
                        setTimeout(() => {
                            chip.classList.remove('opacity-40', 'pointer-events-none');
                            chip.innerHTML = `<i class="fas fa-plus text-[9px] text-primary"></i>${p.name}${p.sku ? '<span class="opacity-40 font-normal ml-1 text-[9px]">#' + p.sku + '</span>' : ''}`;
                        }, 600);
                    });

                    chipsContainer.appendChild(chip);
                });

                // If pre-selected product from product page, add it automatically
                if (preSelectedProduct) {
                    const match = products.find(p => p.id == preSelectedProduct.id || p.name === preSelectedProduct.name);
                    if (match) {
                        addItem(match.name, match.id, '', 'pieces');
                    } else {
                        addItem(preSelectedProduct.name, preSelectedProduct.id, '', 'pieces');
                    }
                }
            })
            .catch(() => {
                loadingSpinner.classList.add('hidden');
                chipsContainer.classList.remove('hidden');
                chipsContainer.innerHTML = '<p class="text-xs text-red-400 italic py-2">Could not load products. Please try again.</p>';
            });
    }

    // Add custom product
    addCustomBtn.addEventListener('click', function () {
        const name = customInput.value.trim();
        if (!name) {
            customInput.classList.add('border-red-400');
            setTimeout(() => customInput.classList.remove('border-red-400'), 1200);
            return;
        }
        addItem(name, '', '', 'pieces');
        customInput.value = '';
    });

    customInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addCustomBtn.click();
        }
    });

    // Vendor change
    vendorSelect.addEventListener('change', function () {
        loadVendorProducts(this.value);
    });

    // On page load
    if (preSelectedVendorId) {
        vendorSelect.value = preSelectedVendorId;
        loadVendorProducts(preSelectedVendorId);
    }

    // Init validation state
    updateSubmitValidation();
})();
</script>
@endpush
