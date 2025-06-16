<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Debugging - cek apakah method ini terpanggil
        Log::info('TransactionController@index accessed by user: ' . auth()->user()->email);

        // Return view dengan data yang diperlukan
        return view('halamanuser.index', [
            'user' => auth()->user()
        ]);
    }

    public function create()
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Return the create transaction view
        return view('transaksi.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'color_type' => 'required|in:berwarna,putih',
        'cleaning_service' => 'nullable|string',
        'repaint_service' => 'nullable|string',
        'pickup_delivery' => 'boolean',
        'notes' => 'nullable'
    ]);

    // Define service prices
    $cleaningPrices = [
        'fast_cleaning_reguler' => 30000,
        'fast_cleaning_outsole' => 50000,
        'deep_cleaning_mid' => 60000,
        'deep_cleaning_reguler' => 80000,
        'deep_cleaning_hard' => 160000,
    ];

    $repaintPrices = [
        'repaint_soft' => 200000,
        'repaint_medium' => 250000,
        'repaint_hard' => 300000,
    ];

    // Initialize prices
    $cleaningPrice = 0;
    $repaintPrice = 0;

    // Calculate cleaning price if service is selected
    if (!empty($validated['cleaning_service'])) {
        $cleaningPrice = $cleaningPrices[$validated['cleaning_service']] ?? 0;
    }

    // Calculate repaint price if service is selected and shoe is colored
    if (!empty($validated['repaint_service'])) {
        $repaintPrice = $repaintPrices[$validated['repaint_service']] ?? 0;
    }

    $pickupDeliveryPrice = $validated['pickup_delivery'] ? 15000 : 0;
    $totalAmount = $cleaningPrice + $repaintPrice + $pickupDeliveryPrice;

    $transaction = new Transaction();
    $transaction->user_id = Auth::id();
    $transaction->email = $validated['email'];
    $transaction->phone = $validated['phone'];
    $transaction->address = $validated['address'];
    $transaction->color_type = $validated['color_type'];
    $transaction->cleaning_service = $validated['cleaning_service'] ?? null;
    $transaction->cleaning_price = $cleaningPrice;
    $transaction->repaint_service = $validated['repaint_service'] ?? null;
    $transaction->repaint_price = $repaintPrice;
    $transaction->pickup_delivery = $validated['pickup_delivery'] ?? false;
    $transaction->pickup_delivery_price = $pickupDeliveryPrice;
    $transaction->total_amount = $totalAmount;
    $transaction->notes = $validated['notes'] ?? null;
    $transaction->status = 'pending';

    $transaction->save();

    return redirect()->route('halamanuser.index');
}
}
