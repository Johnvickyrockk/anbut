<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('dashboard.order_confirmation_index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('dashboard.order_confirmation_show', compact('transaction'));
    }

    public function approve(Transaction $transaction)
    {
        $transaction->update(['status' => 'approved']);
        return redirect()->route('order.confirmation.index')->with('success', 'Pesanan berhasil disetujui!');
    }

    public function reject(Transaction $transaction)
    {
        $transaction->update(['status' => 'rejected']);
        return redirect()->route('order.confirmation.index')->with('success', 'Pesanan berhasil ditolak!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('order.confirmation.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}