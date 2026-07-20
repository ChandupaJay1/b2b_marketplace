@extends('layouts.app')
@section('title', 'Gallery — B2B Marketplace')
@section('meta_description', 'Explore our gallery of products, vendors, events, and trade activities.')

@section('content')

{{-- ── Hero ──────────────────────────────────────────────────────── --}}
<section class="relative overflow-hidden bg-gradient-to-br from-secondary via-primary-dark to-secondary pt-28 pb-20">

    {{-- Animated background blobs --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-20 -left-20 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-20 -right-20 w-[400px] h-[400px] bg-primary/20 rounded-full blur-[100px] animate-pulse" style="animation-delay:1s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-primary/10 rounded-full blur-[80px]"></div>
    </div>

    {{-- Grid pattern overlay --}}
    <div class="absolute inset-0 opacity-[0.04]"
         style="background-image:linear-gradient(rgba(255,255,255,.3) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.3) 1px,transparent 1px);background-size:40px 40px"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-6">
            <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
            <span class="text-primary/60 text-[10px] font-bold uppercase tracking-[0.3em]">Visual Showcase</span>
        </div>

        <h1 class="font-heading font-black text-white text-5xl sm:text-6xl lg:text-7xl leading-none mb-6 tracking-tight">
            Our <span class="relative inline-block">
                <span class="bg-gradient-to-r from-primary via-accent to-primary-dark bg-clip-text text-transparent italic">Gallery</span>
                <span class="absolute -bottom-2 left-0 right-0 h-0.5 bg-gradient-to-r from-primary via-accent to-primary-dark rounded-full opacity-60"></span>
            </span>
        </h1>

        <p class="text-white/60/80 text-base font-medium max-w-lg mx-auto leading-relaxed mb-10">
            A curated look at our products, vendors, trade events, and global partnerships.
        </p>

        {{-- Stats strip --}}
        <div class="inline-flex items-center gap-6 sm:gap-10 bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl px-8 py-4">
            <div class="text-center">
                <p class="text-2xl font-black text-white font-heading">{{ $items->count() }}</p>
                <p class="text-[10px] text-white/50 font-bold uppercase tracking-wider mt-0.5">Photos</p>
            </div>
            <div class="w-px h-8 bg-white/10"></div>
            <div class="text-center">
                <p class="text-2xl font-black text-white font-heading">{{ $categories->count() }}</p>
                <p class="text-[10px] text-white/50 font-bold uppercase tracking-wider mt-0.5">Categories</p>
            </div>
            <div class="w-px h-8 bg-white/10"></div>
            <div class="text-center">
                <p class="text-2xl font-black text-white font-heading">HD</p>
                <p class="text-[10px] text-white/50 font-bold uppercase tracking-wider mt-0.5">Quality</p>
            </div>
        </div>
    </div>
</section>

{{-- ── Toolbar (Filter + View Toggle) ──────────────────────────────── --}}
<div class="sticky top-16 z-30 bg-white/95 backdrop-blur-md border-b border-secondary/20 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 py-3">

            {{-- Category filter pills --}}
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide flex-1 min-w-0">
                <a href="{{ route('gallery') }}"
                   class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200
                          {{ !request('category') ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'bg-surface text-secondary/60 hover:bg-secondary/20 hover:text-secondary/80' }}">
                    All <span class="ml-1 opacity-60">({{ $items->count() }})</span>
                </a>
                @foreach($categories as $cat)
                @php $catCount = $items->where('category', $cat)->count(); @endphp
                <a href="{{ route('gallery', ['category' => $cat]) }}"
                   class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-200
                          {{ request('category') === $cat ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'bg-surface text-secondary/60 hover:bg-secondary/20 hover:text-secondary/80' }}">
                    {{ $cat }} <span class="ml-1 opacity-60">({{ $catCount }})</span>
                </a>
                @endforeach
            </div>

            {{-- View toggle --}}
            <div class="flex items-center gap-1 bg-surface rounded-xl p-1 flex-shrink-0">
                <button id="btn-masonry" onclick="setView('masonry')"
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all bg-white shadow-sm text-primary"
                        title="Masonry view">
                    <i class="fas fa-th-large text-xs"></i>
                </button>
                <button id="btn-grid" onclick="setView('grid')"
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all text-white/50 hover:text-secondary/70"
                        title="Grid view">
                    <i class="fas fa-th text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── Gallery ───────────────────────────────────────────────────── --}}
<section class="py-12 lg:py-20 bg-surface min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Always build the JS data array (empty if no items) --}}
        @php
            $galleryData = $items->map(fn($item) => [
                'src'     => asset('storage/' . $item->image),
                'title'   => $item->title,
                'caption' => $item->caption ?? '',
                'cat'     => $item->category ?? '',
            ])->values()->toArray();
        @endphp

        @if($items->count())

        {{-- MASONRY view (default) --}}
        <div id="view-masonry" class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-4">
            @foreach($items as $i => $item)
            <div class="break-inside-avoid mb-4 gallery-item opacity-0 translate-y-4 transition-all duration-500"
                 style="transition-delay: {{ ($i % 12) * 60 }}ms"
                 onclick="openLightbox({{ $i }})">
                <div class="group relative overflow-hidden rounded-2xl cursor-pointer bg-secondary/20 shadow hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $item->image) }}"
                         alt="{{ $item->title }}"
                         loading="lazy"
                         class="w-full object-cover transition-transform duration-700 group-hover:scale-110">

                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent
                                translate-y-full group-hover:translate-y-0 transition-transform duration-400 ease-out"></div>

                    {{-- Content --}}
                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0
                                transition-transform duration-400 ease-out delay-75">
                        <p class="text-white font-bold text-sm leading-tight line-clamp-1">{{ $item->title }}</p>
                        @if($item->caption)
                        <p class="text-white/65 text-xs mt-0.5 line-clamp-2 leading-snug">{{ $item->caption }}</p>
                        @endif
                        @if($item->category)
                        <span class="inline-flex items-center gap-1 mt-2 px-2.5 py-0.5 bg-primary/50/90 backdrop-blur-sm text-white text-[10px] font-bold rounded-full">
                            <i class="fas fa-tag text-[8px]"></i> {{ $item->category }}
                        </span>
                        @endif
                    </div>

                    {{-- Expand icon --}}
                    <div class="absolute top-3 right-3 w-8 h-8 bg-black/40 backdrop-blur-sm rounded-xl
                                flex items-center justify-center text-white
                                scale-0 group-hover:scale-100 transition-transform duration-300 delay-100">
                        <i class="fas fa-expand-alt text-xs"></i>
                    </div>

                    {{-- Index badge --}}
                    <div class="absolute top-3 left-3 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-lg
                                flex items-center justify-center text-white/70 text-[10px] font-bold
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{ $i + 1 }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- GRID view (hidden by default) --}}
        <div id="view-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($items as $i => $item)
            <div class="gallery-item opacity-0 translate-y-4 transition-all duration-500"
                 style="transition-delay: {{ ($i % 12) * 50 }}ms"
                 onclick="openLightbox({{ $i }})">
                <div class="group relative aspect-square overflow-hidden rounded-2xl cursor-pointer bg-secondary/20 shadow hover:shadow-xl transition-shadow duration-300">
                    <img src="{{ asset('storage/' . $item->image) }}"
                         alt="{{ $item->title }}"
                         loading="lazy"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent
                                opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                        <p class="text-white font-bold text-xs line-clamp-1">{{ $item->title }}</p>
                        @if($item->category)
                        <span class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 bg-primary/50/90 text-white text-[9px] font-bold rounded-full w-fit">
                            {{ $item->category }}
                        </span>
                        @endif
                    </div>
                    <div class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-lg
                                flex items-center justify-center text-white
                                scale-0 group-hover:scale-100 transition-transform duration-300">
                        <i class="fas fa-expand-alt text-[10px]"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else

        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="relative mb-6">
                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center shadow-md">
                    <i class="fas fa-images text-secondary/20 text-4xl"></i>
                </div>
                <div class="absolute -top-1 -right-1 w-7 h-7 bg-primary/50 rounded-full flex items-center justify-center">
                    <i class="fas fa-plus text-white text-xs"></i>
                </div>
            </div>
            <h3 class="text-secondary/80 font-black text-xl mb-2 font-heading">No images yet</h3>
            <p class="text-white/50 text-sm max-w-xs">Gallery images will appear here once they are uploaded by our team.</p>
        </div>

        @endif
    </div>
</section>

{{-- ── Lightbox ──────────────────────────────────────────────────── --}}
<div id="lightbox"
     class="fixed inset-0 z-[9999] hidden"
     aria-modal="true" role="dialog">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/95 backdrop-blur-md" onclick="closeLightbox()"></div>

    {{-- Close --}}
    <button onclick="closeLightbox()"
            class="absolute top-4 right-4 z-10 w-11 h-11 bg-white/10 hover:bg-white/20 border border-white/10
                   rounded-2xl flex items-center justify-center text-white transition-all hover:scale-110">
        <i class="fas fa-times text-base"></i>
    </button>

    {{-- Counter --}}
    <div class="absolute top-4 left-1/2 -translate-x-1/2 z-10 px-4 py-1.5 bg-white/10 border border-white/10
                backdrop-blur-md rounded-full text-white text-xs font-bold">
        <span id="lb-counter">1 / 1</span>
    </div>

    {{-- Prev --}}
    <button onclick="lbPrev()"
            class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-10
                   w-11 h-11 bg-white/10 hover:bg-white/20 border border-white/10
                   rounded-2xl flex items-center justify-center text-white transition-all hover:scale-110">
        <i class="fas fa-chevron-left text-sm"></i>
    </button>

    {{-- Next --}}
    <button onclick="lbNext()"
            class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-10
                   w-11 h-11 bg-white/10 hover:bg-white/20 border border-white/10
                   rounded-2xl flex items-center justify-center text-white transition-all hover:scale-110">
        <i class="fas fa-chevron-right text-sm"></i>
    </button>

    {{-- Image + info --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center px-16 sm:px-24 py-16 pointer-events-none">
        <div class="w-full max-w-4xl pointer-events-auto">
            <div class="relative">
                <img id="lb-img" src="" alt=""
                     class="w-full max-h-[70vh] object-contain rounded-2xl shadow-2xl transition-opacity duration-300">
                {{-- Loading spinner overlay --}}
                <div id="lb-loader" class="absolute inset-0 flex items-center justify-center hidden">
                    <div class="w-8 h-8 border-2 border-white/20 border-t-white rounded-full animate-spin"></div>
                </div>
            </div>

            {{-- Caption bar --}}
            <div class="mt-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 
                        bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl px-5 py-4">
                <div class="min-w-0">
                    <p id="lb-title" class="text-white font-bold text-sm leading-tight"></p>
                    <p id="lb-desc" class="text-white/50 text-xs mt-0.5 line-clamp-2"></p>
                </div>
                <span id="lb-cat"
                      class="flex-shrink-0 px-3 py-1 bg-primary/20 border border-primary/50/30 text-primary/60
                             text-[10px] font-bold rounded-full hidden"></span>
            </div>

            {{-- Thumbnail strip --}}
            <div id="lb-thumbs"
                 class="flex gap-2 mt-3 overflow-x-auto scrollbar-hide justify-center">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ── Gallery data ───────────────────────────────────────────────
    const gallery = @json($galleryData);
    let currentIndex = 0;

    // ── View toggle ────────────────────────────────────────────────
    function setView(v) {
        const masonry = document.getElementById('view-masonry');
        const grid    = document.getElementById('view-grid');
        const btnM    = document.getElementById('btn-masonry');
        const btnG    = document.getElementById('btn-grid');
        if (v === 'masonry') {
            masonry.classList.remove('hidden');
            grid.classList.add('hidden');
            btnM.classList.add('bg-white', 'shadow-sm', 'text-primary');
            btnM.classList.remove('text-white/50');
            btnG.classList.remove('bg-white', 'shadow-sm', 'text-primary');
            btnG.classList.add('text-white/50');
        } else {
            grid.classList.remove('hidden');
            masonry.classList.add('hidden');
            btnG.classList.add('bg-white', 'shadow-sm', 'text-primary');
            btnG.classList.remove('text-white/50');
            btnM.classList.remove('bg-white', 'shadow-sm', 'text-primary');
            btnM.classList.add('text-white/50');
        }
        triggerReveal();
    }

    // ── Staggered reveal on load ───────────────────────────────────
    function triggerReveal() {
        document.querySelectorAll('.gallery-item').forEach((el, i) => {
            setTimeout(() => {
                el.classList.remove('opacity-0', 'translate-y-4');
                el.classList.add('opacity-100', 'translate-y-0');
            }, i * 60);
        });
    }
    document.addEventListener('DOMContentLoaded', () => setTimeout(triggerReveal, 100));

    // ── Lightbox ───────────────────────────────────────────────────
    const lb       = document.getElementById('lightbox');
    const lbImg    = document.getElementById('lb-img');
    const lbTitle  = document.getElementById('lb-title');
    const lbDesc   = document.getElementById('lb-desc');
    const lbCat    = document.getElementById('lb-cat');
    const lbCounter= document.getElementById('lb-counter');
    const lbLoader = document.getElementById('lb-loader');
    const lbThumbs = document.getElementById('lb-thumbs');

    function openLightbox(index) {
        currentIndex = index;
        lb.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        renderLightbox();
        buildThumbs();
    }

    function closeLightbox() {
        lb.classList.add('hidden');
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    function renderLightbox() {
        const item = gallery[currentIndex];
        lbLoader.classList.remove('hidden');
        lbImg.style.opacity = '0';

        const tmpImg = new Image();
        tmpImg.onload = () => {
            lbImg.src = item.src;
            lbImg.style.opacity = '1';
            lbLoader.classList.add('hidden');
        };
        tmpImg.src = item.src;

        lbTitle.textContent  = item.title;
        lbDesc.textContent   = item.caption;
        lbCounter.textContent = `${currentIndex + 1} / ${gallery.length}`;

        if (item.cat) {
            lbCat.textContent = item.cat;
            lbCat.classList.remove('hidden');
        } else {
            lbCat.classList.add('hidden');
        }

        // Update active thumb
        document.querySelectorAll('.lb-thumb').forEach((t, i) => {
            t.classList.toggle('ring-2', i === currentIndex);
            t.classList.toggle('ring-primary', i === currentIndex);
            t.classList.toggle('opacity-100', i === currentIndex);
            t.classList.toggle('opacity-40', i !== currentIndex);
        });
    }

    function buildThumbs() {
        lbThumbs.innerHTML = gallery.map((item, i) => `
            <button class="lb-thumb flex-shrink-0 w-12 h-12 rounded-xl overflow-hidden transition-all
                           ${i === currentIndex ? 'ring-2 ring-primary opacity-100' : 'opacity-40 hover:opacity-70'}"
                    onclick="jumpTo(${i})">
                <img src="${item.src}" alt="" class="w-full h-full object-cover">
            </button>
        `).join('');
    }

    function jumpTo(index) {
        currentIndex = index;
        renderLightbox();
    }

    function lbNext() {
        currentIndex = (currentIndex + 1) % gallery.length;
        renderLightbox();
    }
    function lbPrev() {
        currentIndex = (currentIndex - 1 + gallery.length) % gallery.length;
        renderLightbox();
    }

    // Keyboard navigation
    document.addEventListener('keydown', e => {
        if (lb.classList.contains('hidden')) return;
        if (e.key === 'Escape')      closeLightbox();
        if (e.key === 'ArrowRight')  lbNext();
        if (e.key === 'ArrowLeft')   lbPrev();
    });

    // Touch swipe support
    let touchStartX = 0;
    lb.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend',   e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) diff > 0 ? lbNext() : lbPrev();
    });
</script>
@endpush

@endsection
