<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryItem::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items      = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        $categories = GalleryItem::select('category')->whereNotNull('category')->distinct()->pluck('category');

        return view('admin.gallery.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = GalleryItem::select('category')->whereNotNull('category')->distinct()->pluck('category');
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'caption'    => ['nullable', 'string', 'max:1000'],
            'image'      => ['required', 'image', 'max:5120'],
            'category'   => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = $request->except(['_token', 'image']);
        $data['is_active']   = $request->boolean('is_active', true);
        $data['sort_order']  = $request->input('sort_order', 0);
        $data['image']       = $request->file('image')->store('gallery', 'public');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully!');
    }

    public function edit(GalleryItem $gallery)
    {
        $categories = GalleryItem::select('category')->whereNotNull('category')->distinct()->pluck('category');
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'caption'    => ['nullable', 'string', 'max:1000'],
            'image'      => ['nullable', 'image', 'max:5120'],
            'category'   => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully!');
    }

    public function destroy(GalleryItem $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted!');
    }
}
