@extends('layouts.app')
@section('title', 'Request for Quotation | B2B Marketplace')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO HEADER
═══════════════════════════════════════════════ --}}
<section class="relative py-28 lg:py-40 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 overflow-hidden">
    {{-- Gradient lines --}}
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-blue-400/60 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-400/40 to-transparent"></div>

    {{-- Glow orbs --}}
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 py-2 px-5 bg-white/5 border border-white/10 backdrop-blur-md text-blue-300 text-[10px] font-bold uppercase tracking-[0.25em] rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-ping"></span>
                Get Competitive Quotes
            </span>
            <h1 class="text-5xl sm:text-6xl lg:text-8xl font-heading font-black text-white leading-[0.9] mb-6 tracking-tight">
                Request for <br><span class="bg-gradient-to-r from-amber-300 to-orange-300 bg-clip-text text-transparent italic">Quotation</span>
            </h1>
            <p class="text-slate-300 text-sm sm:text-base font-medium max-w-xl mx-auto leading-relaxed mb-10">
                Connect with verified vendors and receive competitive quotes within 48 hours. Fast, secure, and completely free.
            </p>
            <nav class="flex justify-center items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Home</a>
                <span class="w-1 h-1 bg-slate-600 rounded-full"></span>
                <span class="text-slate-300">Request Quote</span>
            </nav>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     INTRO STATS STRIP
═══════════════════════════════════════════════ --}}
<div class="bg-blue-600 relative overflow-hidden">
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
<section class="py-20 lg:py-32 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
    <div class="absolute -top-40 right-0 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 left-0 w-96 h-96 bg-indigo-200/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">

            {{-- Left: copy --}}
            <div class="lg:w-2/5 lg:sticky lg:top-32">
                <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-[10px] mb-4 block">Fast Track</span>
                <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none mb-6">
                    Submit Your <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Requirements</span>
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed font-medium mb-10">
                    Fill in your requirements and our verified vendors will respond with detailed quotations within 48 hours.
                </p>

                <div class="space-y-5">
                    @foreach([
                        ['fa-bolt', 'Fast Response', '48-hour quote turnaround guaranteed'],
                        ['fa-lock', 'Confidential', 'Your business data is fully protected'],
                        ['fa-headset', 'Dedicated Support', 'Customer support team ready to assist'],
                        ['fa-badge-check', 'Verified Vendors', 'Connect only with verified suppliers'],
                    ] as [$icon, $title, $desc])
                    <div class="flex items-start gap-4 group">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all">
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
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your name">
                                    @error('name')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Company Name</label>
                                    <input type="text" name="company" value="{{ old('company') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
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
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="you@company.com">
                                    @error('email')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Phone Number</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
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
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="Your country">
                                    @error('country')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">City</label>
                                    <input type="text" name="city" value="{{ old('city') }}"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
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
                            
                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Preferred Vendor (Optional)</label>
                                <select name="vendor_id"
                                        class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
                                    <option value="">Any Vendor (Send to all)</option>
                                    @foreach(\App\Models\Vendor::where('status', 'approved')->orderBy('company_name')->get() as $vendor)
                                        <option value="{{ $vendor->id }}" @selected(old('vendor_id') == $vendor->id)>
                                            {{ $vendor->company_name }} @if($vendor->country)- {{ $vendor->country }}@endif
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-slate-500 mt-1 ml-1">Leave empty to receive quotes from all matching vendors</p>
                                @error('vendor_id')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Product Category</label>
                                <select name="product_category_id"
                                        class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
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

                            <div class="space-y-2 mb-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Product Name *</label>
                                <input type="text" name="product_name" value="{{ old('product_name') }}" required
                                       class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="e.g. Industrial Grade Steel Pipes, Cotton T-Shirts...">
                                @error('product_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Quantity Required *</label>
                                    <input type="number" name="quantity" value="{{ old('quantity') }}" required min="1"
                                           class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                           placeholder="1000">
                                    @error('quantity')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Unit *</label>
                                    <select name="unit"
                                            class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm cursor-pointer">
                                        <option value="pieces" @selected(old('unit') == 'pieces')>Pieces</option>
                                        <option value="kg" @selected(old('unit') == 'kg')>Kilograms (kg)</option>
                                        <option value="tons" @selected(old('unit') == 'tons')>Tons</option>
                                        <option value="liters" @selected(old('unit') == 'liters')>Liters</option>
                                        <option value="meters" @selected(old('unit') == 'meters')>Meters</option>
                                        <option value="sets" @selected(old('unit') == 'sets')>Sets</option>
                                        <option value="containers" @selected(old('unit') == 'containers')>Containers</option>
                                    </select>
                                    @error('unit')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Target Price (Optional)</label>
                                <input type="number" name="target_price" value="{{ old('target_price') }}" step="0.01" min="0"
                                       class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="Your target price per unit">
                                @error('target_price')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Delivery Location</label>
                                <input type="text" name="delivery_location" value="{{ old('delivery_location') }}"
                                       class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm"
                                       placeholder="Port/City for delivery">
                                @error('delivery_location')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2 mt-5">
                                <label class="text-[10px] font-bold text-slate-600 ml-1 uppercase tracking-widest">Additional Requirements</label>
                                <textarea name="requirements" rows="4"
                                          class="w-full bg-slate-100 border-2 border-slate-200 rounded-xl py-4 px-6 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-slate-900 font-medium text-sm resize-none"
                                          placeholder="Specifications, certifications needed, packaging requirements, delivery timeline...">{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Terms Agreement --}}
                        <div class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl border border-blue-200">
                            <input type="checkbox" name="agree_terms" id="agree_terms" required class="mt-1 rounded text-blue-600">
                            <label for="agree_terms" class="text-xs text-slate-700 font-medium">
                                I agree to share my information with verified vendors and accept the <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a>
                            </label>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="group w-full py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold text-sm uppercase tracking-wide hover:from-blue-700 hover:to-indigo-700 transition-all shadow-xl shadow-blue-600/30 flex items-center justify-center gap-3 relative overflow-hidden">
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
            <span class="text-blue-600 font-bold uppercase tracking-[0.2em] text-[10px] mb-3 block">Simple Process</span>
            <h2 class="text-4xl sm:text-5xl font-heading font-black text-slate-900 leading-none">
                How It <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic">Works</span>
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
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl group-hover:scale-110 transition-transform duration-300 shadow-lg">
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        background-color: #f1f5f9;
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        height: 52px;
        padding: 10px 20px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #0f172a;
        font-weight: 500;
        font-size: 0.875rem;
        line-height: 32px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px;
        right: 10px;
    }
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .select2-dropdown {
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6;
    }
    
    /* Notification animation */
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .animate-slide-in {
        animation: slideInRight 0.3s ease-out;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for vendor selection
        $('select[name="vendor_id"]').select2({
            placeholder: 'Search and select a vendor...',
            allowClear: true,
            width: '100%',
            templateResult: formatVendor,
            templateSelection: formatVendorSelection
        });

        // Load vendor's product categories via AJAX when vendor is selected
        $('select[name="vendor_id"]').on('change', function() {
            var vendorId = $(this).val();
            
            if (vendorId) {
                console.log('Fetching categories for vendor ID:', vendorId);
                
                // Fetch vendor's product categories
                $.ajax({
                    url: '/api/vendor/' + vendorId + '/categories',
                    method: 'GET',
                    beforeSend: function() {
                        // Optional: Show loading state
                        $('select[name="product_category_id"]').prop('disabled', true);
                    },
                    success: function(response) {
                        console.log('Response received:', response);
                        
                        if (response.categories && response.categories.length > 0) {
                            // Auto-select the first product category
                            var firstCategoryId = response.categories[0].id;
                            $('select[name="product_category_id"]').val(firstCategoryId).prop('disabled', false);
                            
                            // Show notification with category info
                            var categoryName = response.categories[0].name;
                            showNotification('Auto-selected: ' + categoryName + ' (' + response.total_products + ' products)');
                            
                            console.log('Category auto-selected:', categoryName);
                        } else {
                            $('select[name="product_category_id"]').val('').prop('disabled', false);
                            showNotification('No product categories found for this vendor', 'warning');
                            console.log('No categories found for vendor');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response:', xhr.responseText);
                        $('select[name="product_category_id"]').prop('disabled', false);
                        showNotification('Could not load vendor categories', 'error');
                    }
                });
            } else {
                // Vendor deselected - clear category
                $('select[name="product_category_id"]').val('');
            }
        });

        function formatVendor(vendor) {
            if (!vendor.id) {
                return vendor.text;
            }
            var $vendor = $(
                '<div class="flex items-center gap-2">' +
                    '<i class="fas fa-store text-blue-600"></i>' +
                    '<span>' + vendor.text + '</span>' +
                '</div>'
            );
            return $vendor;
        }

        function formatVendorSelection(vendor) {
            return vendor.text;
        }

        // Show notification helper
        function showNotification(message, type = 'success') {
            var bgColor = 'bg-blue-600';
            var icon = 'fa-info-circle';
            
            if (type === 'warning') {
                bgColor = 'bg-amber-600';
                icon = 'fa-exclamation-triangle';
            } else if (type === 'error') {
                bgColor = 'bg-red-600';
                icon = 'fa-times-circle';
            } else if (type === 'success') {
                bgColor = 'bg-green-600';
                icon = 'fa-check-circle';
            }
            
            // Create notification element
            const notification = $('<div class="fixed top-24 right-4 z-50 ' + bgColor + ' text-white px-5 py-3 rounded-xl shadow-2xl text-sm font-medium animate-slide-in flex items-center gap-2">' +
                '<i class="fas ' + icon + '"></i>' +
                '<span>' + message + '</span>' +
                '</div>');
            
            $('body').append(notification);
            
            // Auto remove after 4 seconds
            setTimeout(function() {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 4000);
        }

        // Optional: Filter products by category
        $('select[name="product_category_id"]').on('change', function() {
            var categoryId = $(this).val();
            console.log('Category selected:', categoryId);
        });
    });
</script>
@endpush
