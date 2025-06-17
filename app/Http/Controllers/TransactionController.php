<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('transaksi.index', compact('transactions'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'color_type' => 'required',
            'cleaning_service' => 'nullable',
            'repaint_service' => 'nullable',
            'pickup_delivery' => 'nullable|boolean',
            'notes' => 'nullable'
        ]);

        // Calculate prices
        $cleaning_price = $this->getCleaningPrice($request->input('cleaning_service'));
        $repaint_price = $this->getRepaintPrice($request->input('repaint_service'));
        $pickup_delivery_price = $request->boolean('pickup_delivery') ? 15000 : 0;
        
        $total_amount = $cleaning_price + $repaint_price + $pickup_delivery_price;

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'color_type' => $validated['color_type'],
            'cleaning_service' => $validated['cleaning_service'] ?? null,
            'cleaning_price' => $cleaning_price,
            'repaint_service' => $validated['repaint_service'] ?? null,
            'repaint_price' => $repaint_price,
            'pickup_delivery' => $request->boolean('pickup_delivery'),
            'pickup_delivery_price' => $pickup_delivery_price,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);

        return redirect()->route('halamanuser.index')->with('success', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        return view('transaksi.show', compact('transaction'));
    }

    public function invoice(Transaction $transaction)
    {
        return view('transaksi.invoice', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->status === 'pending') {
            $transaction->delete();
            return redirect()->route('halamanuser.index')->with('success', 'Transaction deleted successfully!');
        }
        
        return redirect()->route('halamanuser.index')->with('error', 'Only pending transactions can be deleted!');
    }

    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Transaction approved successfully!');
    }

    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Transaction rejected successfully!');
    }

    private function getCleaningPrice($service)
    {
        if (!$service) return 0;

        $prices = [
            'fast_cleaning_reguler' => 30000,
            'fast_cleaning_outsole' => 50000,
            'deep_cleaning_mid' => 60000,
            'deep_cleaning_reguler' => 80000,
            'deep_cleaning_hard' => 160000,
        ];

        return $prices[$service] ?? 0;
    }

    private function getRepaintPrice($service)
    {
        if (!$service) return 0;

        $prices = [
            'repaint_soft' => 200000,
            'repaint_medium' => 250000,
            'repaint_hard' => 300000,
        ];

        return $prices[$service] ?? 0;
    }
}