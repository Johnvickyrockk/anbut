<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->where('status', 'pending')->get();
        return view('dashboard.order_confirmation', compact('transactions'));
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'approved';
        $transaction->save();
        
        return redirect()->back()->with('success', 'Pesanan telah disetujui!');
    }

    public function reject($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'rejected';
        $transaction->save();
        
        return redirect()->back()->with('success', 'Pesanan telah ditolak!');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        
        return redirect()->back()->with('success', 'Pesanan telah dihapus!');
    }
    public function show($id)
{
    $transaction = Transaction::with('user')->findOrFail($id);
    return view('dashboard.order_confirmation_show', compact('transaction'));
}
}