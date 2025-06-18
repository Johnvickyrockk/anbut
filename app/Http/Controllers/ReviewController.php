<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan transaksi yang sudah delivered dan belum direview.
     */
    public function index()
    {
        $user = auth()->user();

        $transactions = Transaction::where('user_id', $user->id)
            ->doesntHave('review')
            ->get();

        return view('halamanuser.review.index', compact('transactions'));
    }

    /**
     * Form untuk menulis review.
     */
    public function create(Transaction $transaction)
    {
        

        return view('halamanuser.review.create', compact('transaction'));
    }

    /**
     * Menyimpan review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        $transaction = Transaction::where('id', $request->transaction_id)
            ->where('user_id', auth()->id())
            ->where('status', 'delivered')
            ->doesntHave('review')
            ->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak valid untuk direview.');
        }

        Review::create([
            'transaction_id' => $transaction->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('reviews.list')->with('success', 'Review berhasil ditambahkan.');
    }

    /**
     * Form edit review.
     */
    public function edit(Review $review)
    {
        

        return view('halamanuser.review.edit', compact('review'));
    }

    /**
     * Update review.
     */
    public function update(Request $request, Review $review)
    {
        

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('reviews.list')->with('success', 'Review berhasil diperbarui.');
    }

    /**
     * Hapus review.
     */
    public function destroy(Review $review)
    {
       

        $review->delete();

        return redirect()->route('reviews.list')->with('success', 'Review berhasil dihapus.');
    }

    /**
     * Menampilkan daftar semua review milik user.
     */
    public function list()
    {
        $user = auth()->user();
        $reviews = Review::where('user_id', $user->id)->with('transaction')->get();
        return view('halamanuser.review.list', compact('reviews'));
    }
}
