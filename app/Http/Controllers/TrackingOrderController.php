<?php

namespace App\Http\Controllers;

use App\Models\TrackingOrder;
use Illuminate\Http\Request;

class TrackingOrderController extends Controller
{
    public function index()
    {
        $orders = TrackingOrder::latest()->get();
        return view('tracking.index', compact('orders'));
    }

    public function create()
    {
        return view('tracking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|unique:tracking_orders',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'status' => 'required',
            'message' => 'nullable',
            'admin_notes' => 'nullable'
        ]);

        TrackingOrder::create($request->all());

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking created successfully.');
    }

    public function show(TrackingOrder $trackingOrder)
    {
        return view('tracking.show', compact('trackingOrder'));
    }

    public function edit(TrackingOrder $trackingOrder)
    {
        return view('tracking.edit', compact('trackingOrder'));
    }

    public function update(Request $request, TrackingOrder $trackingOrder)
    {
        $request->validate([
            'order_number' => 'required|unique:tracking_orders,order_number,'.$trackingOrder->id,
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'status' => 'required',
            'message' => 'nullable',
            'admin_notes' => 'nullable'
        ]);

        $trackingOrder->update($request->all());

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking updated successfully');
    }

    public function destroy(TrackingOrder $trackingOrder)
    {
        $trackingOrder->delete();

        return redirect()->route('tracking.index')
            ->with('success', 'Order tracking deleted successfully');
    }
}