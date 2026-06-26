<a href="{{ route('products.show', $product->slug) }}" class="reveal-up group card-hover">
    <div class="relative h-48 bg-surface-dark overflow-hidden">
        @if($product->main_image)
            <img src="{{ asset('storage/' . $product->main_image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-box text-3xl text-secondary/15"></i>
            </div>
        @endif
        @if($product->is_featured)
            <span class="absolute top-3 left-3 px-2.5 py-1 bg-accent text-secondary text-[9px] font-black uppercase tracking-widest rounded-full shadow-gold">
                ★ Featured
            </span>
        @endif
    </div>
    <div class="p-4">
        <p class="text-primary text-[10px] font-black uppercase tracking-widest mb-1">
            {{ $product->category->name ?? '' }}
        </p>
        <h3 class="font-heading font-black text-secondary text-sm mb-2 group-hover:text-primary transition-colors line-clamp-1">
            {{ $product->name }}
        </h3>
        @if($product->short_description)
            <p class="text-secondary/40 text-xs mb-3 line-clamp-2 leading-relaxed">
                {{ $product->short_description }}
            </p>
        @endif
        <div class="flex items-center justify-between border-t border-secondary/6 pt-3">
            @if($product->price)
                <span class="font-heading font-black text-primary">${{ number_format($product->price, 2) }}</span>
            @else
                <span class="text-secondary/30 text-xs font-semibold">On request</span>
            @endif
            <span class="text-secondary/30 text-[10px] font-bold">
                MOQ: {{ $product->min_order_quantity }} {{ $product->unit }}
            </span>
        </div>
        <p class="text-secondary/30 text-[10px] mt-1.5">by {{ $product->vendor->company_name ?? '' }}</p>
    </div>
</a>
