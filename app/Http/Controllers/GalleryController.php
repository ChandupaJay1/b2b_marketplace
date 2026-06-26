<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryItem::where('is_active', true);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items      = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $categories = GalleryItem::where('is_active', true)
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('gallery', compact('items', 'categories'));
    }
}
