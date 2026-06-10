<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rfq;
use Illuminate\Http\Request;

class RfqController extends Controller
{
    public function index(Request $request)
    {
        $query = Rfq::with(['vendor', 'product', 'user']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $rfqs = $query->latest()->paginate(15);

        return view('admin.rfqs.index', compact('rfqs'));
    }

    public function show(Rfq $rfq)
    {
        $rfq->load(['vendor', 'product', 'user']);
        return view('admin.rfqs.show', compact('rfq'));
    }

    public function updateStatus(Request $request, Rfq $rfq)
    {
        $request->validate(['status' => ['required', 'in:new,reviewed,responded,closed']]);
        $rfq->update(['status' => $request->status]);

        return back()->with('success', 'RFQ status updated.');
    }

    public function destroy(Rfq $rfq)
    {
        $rfq->delete();
        return redirect()->route('admin.rfqs.index')->with('success', 'RFQ deleted.');
    }
}
