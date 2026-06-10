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
        $vendor  = $request->filled('vendor') ? Vendor::where('slug', $request->vendor)->first() : null;
        $product = $request->filled('product') ? Product::where('slug', $request->product)->first() : null;

        return view('rfq.create', compact('vendor', 'product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'email'               => ['required', 'email'],
            'phone'               => ['nullable', 'string', 'max:20'],
            'company'             => ['nullable', 'string', 'max:255'],
            'country'             => ['nullable', 'string', 'max:100'],
            'product_description' => ['required', 'string'],
            'quantity'            => ['nullable', 'numeric', 'min:1'],
            'unit'                => ['nullable', 'string', 'max:50'],
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::id();

        Rfq::create($data);

        return redirect()->back()->with('success', 'Your RFQ has been submitted successfully! We will get back to you soon.');
    }
}
