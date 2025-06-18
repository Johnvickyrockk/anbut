@extends('halamanuser.index')

@section('content')
<div class="container mt-4">
    <h3>Transaksi yang Bisa Direview</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($transactions->isEmpty())
        <p>Tidak ada transaksi yang bisa direview saat ini.</p>
    @else
        @foreach($transactions as $transaction)
            <div class="card mb-3">
                <div class="card-body">
                    <p>ID: {{ $transaction->id }}</p>
                    <p>Total: Rp{{ number_format($transaction->total_amount) }}</p>
                    <p>Status: {{ $transaction->status }}</p>
                    <a href="{{ route('reviews.create', $transaction->id) }}" class="btn btn-primary btn-sm">Beri Review</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
