<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Rfq;
use App\Models\User;
use App\Models\Vendor;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'       => User::count(),
            'total_vendors'     => Vendor::count(),
            'approved_vendors'  => Vendor::where('status', 'approved')->count(),
            'pending_vendors'   => Vendor::where('status', 'pending')->count(),
            'total_products'    => Product::count(),
            'active_products'   => Product::where('is_active', true)->count(),
            'total_rfqs'        => Rfq::count(),
            'new_rfqs'          => Rfq::where('status', 'new')->count(),
            'total_contacts'    => Contact::count(),
            'unread_contacts'   => Contact::where('is_read', false)->count(),
        ];

        $recentVendors  = Vendor::with('user', 'category')->latest()->take(5)->get();
        $recentRfqs     = Rfq::with('vendor', 'product')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentVendors', 'recentRfqs'));
    }
}
