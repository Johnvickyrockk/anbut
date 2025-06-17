<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('dashboard.pendapatan', compact('transactions'));
    }
}