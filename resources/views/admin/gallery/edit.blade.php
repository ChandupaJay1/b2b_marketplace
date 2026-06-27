@extends('layouts.admin')
@section('title', 'Edit Gallery Image')

@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.gallery.index') }}" class="text-secondary/50 hover:text-secondary/60 transition-colors">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2 class="text-lg font-bold text-secondary">Edit Gallery Image</h2>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl border border-secondary/5 shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        {{-- Current Image + Replace --}}
        <div>
            <label class="label">Image</label>
            <div class="mb-3">
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                     class="h-40 rounded-xl object-cover shadow border border-secondary/5">
                <p class="text-xs text-secondary/50 mt-1.5">Current image — upload a new one to replace it</p>
            </div>
            {{-- Hidden input OUTSIDE the drop zone --}}
            <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
            <div id="drop-zone"
                 class="border-2 border-dashed border-secondary/10 rounded-xl p-6 text-center cursor-pointer hover:border-primary hover:bg-primary/10/30 transition-all">
                <div id="preview-container" class="hidden mb-3">
                    <img id="preview-img" src="" alt="" class="max-h-40 mx-auto rounded-xl object-cover shadow">
                </div>
                <div id="upload-placeholder">
                    <i class="fas fa-cloud-upload-alt text-secondary/50 text-xl mb-2"></i>
                    <p class="text-sm font-semibold text-secondary/60">Click to upload new image</p>
                    <p class="text-xs text-secondary/50 mt-0.5">PNG, JPG, WEBP — max 5MB</p>
                </div>
            </div>
            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Title --}}
        <div>
            <label class="label">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required
                   class="input-field @error('title') border-red-400 @enderror">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Caption --}}
        <div>
            <label class="label">Caption</label>
            <textarea name="caption" rows="2"
                      class="input-field @error('caption') border-red-400 @enderror">{{ old('caption', $gallery->caption) }}</textarea>
            @error('caption')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Category --}}
        <div>
            <label class="label">Category</label>
            <input type="text" name="category" value="{{ old('category', $gallery->category) }}"
                   class="input-field @error('category') border-red-400 @enderror"
                   placeholder="e.g. Events, Products, Office"
                   list="category-suggestions">
            <datalist id="category-suggestions">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">
                @endforeach
            </datalist>
            @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Sort Order & Status --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0"
                       class="input-field @error('sort_order') border-red-400 @enderror">
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                           class="rounded border-secondary/20 accent-primary">
                    <span class="text-sm font-medium text-secondary/70">Active (visible on site)</span>
                </label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-2 border-t border-secondary/5">
            <button type="submit" class="btn-primary py-2.5 px-6">
                <i class="fas fa-save mr-1.5"></i> Update Image
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="btn-secondary py-2.5 px-6">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const dropZone    = document.getElementById('drop-zone');
    const input       = document.getElementById('image-input');
    const preview     = document.getElementById('preview-container');
    const previewImg  = document.getElementById('preview-img');
    const placeholder = document.getElementById('upload-placeholder');

    dropZone.addEventListener('click', () => input.click());

    dropZone.addEventListener('dragover',  e => { e.preventDefault(); dropZone.classList.add('border-primary', 'bg-primary/10/30'); });
    dropZone.addEventListener('dragleave', ()  => dropZone.classList.remove('border-primary', 'bg-primary/10/30'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-primary', 'bg-primary/10/30');
        if (e.dataTransfer.files[0]) { input.files = e.dataTransfer.files; showPreview(e.dataTransfer.files[0]); }
    });

    input.addEventListener('change', () => { if (input.files[0]) showPreview(input.files[0]); });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
@endsection
