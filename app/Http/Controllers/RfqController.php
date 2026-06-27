<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rfq;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RfqController extends Controller
{
    public function create(Request $request)
    {
        $vendor = $request->filled('vendor') ? Vendor::where('slug', $request->vendor)->first() : null;
        $product = $request->filled('product') ? Product::where('slug', $request->product)->with('vendors')->first() : null;

        return view('rfq.create', compact('vendor', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'company' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'product_category_id' => ['nullable', 'exists:product_categories,id'],
            'target_price' => ['nullable', 'numeric', 'min:0'],
            'delivery_location' => ['nullable', 'string', 'max:255'],
            'additional_requirements' => ['nullable', 'string'],
            'vendor_id' => ['nullable', 'exists:vendors,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_name' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['nullable', 'numeric', 'min:1'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
        ]);

        $data = $request->except('_token', 'items');
        $data['user_id'] = Auth::id();
        $data['status'] = 'new';

        $rfq = Rfq::create($data);

        foreach ($request->items as $item) {
            $rfq->products()->create([
                'product_id' => $item['product_id'] ?? null,
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'] ?? null,
                'unit' => $item['unit'] ?? 'pieces',
            ]);
        }

        return redirect()->back()->with('success', 'Your RFQ has been submitted successfully! We will get back to you soon.');
    }

    public function vendorProducts($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        $products = $vendor->products()->where('is_active', true)->get(['id', 'name', 'sku']);

        return response()->json(['products' => $products]);
    }
}
