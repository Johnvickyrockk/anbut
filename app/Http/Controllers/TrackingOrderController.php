<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TrackingOrder;

class TrackingOrderController extends Controller
{
    public function index()
    {
        $trackingOrders = TrackingOrder::all();
        return view('tracking.index', compact('trackingOrders'));
    }

    public function create()
    {
        return view('tracking.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|unique:tracking_orders,order_number',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'status' => 'required|in:processing,shipped,delivered',
            'message' => 'nullable|string',
            'admin_notes' => 'nullable|string'
        ]);

        TrackingOrder::create($validated);

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking created successfully.');
    }

   public function show(TrackingOrder $tracking)
{
    // Pastikan tracking order ditemukan
    if (!$tracking) {
        abort(404, 'Tracking order not found');
    }
    
    // Tentukan view berdasarkan auth status
    $view = auth()->check() ? 'tracking.show' : 'tracking.public-show';
    
    return view($view, compact('tracking'));
}

    public function edit(TrackingOrder $tracking)
    {
        return view('tracking.edit', compact('tracking'));
    }

    public function update(Request $request, TrackingOrder $tracking)
    {
        $validated = $request->validate([
            'order_number' => 'required|unique:tracking_orders,order_number,'.$tracking->id,
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'status' => 'required|in:processing,shipped,delivered',
            'message' => 'nullable|string',
            'admin_notes' => 'nullable|string'
        ]);

        $tracking->update($validated);

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking updated successfully');
    }

    public function destroy(TrackingOrder $tracking)
    {
        $tracking->delete();

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking deleted successfully');
    }
 public function showUser()
{
    // Ambil semua tracking order yang terkait dengan user yang login
    $trackingOrders = TrackingOrder::where('customer_email', auth()->user()->email)
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('tracking.showuser', compact('trackingOrders'));
}


}