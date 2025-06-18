@extends('halamanuser.index')

@section('content')
<div class="container mt-4">
    <h3>Beri Review untuk Transaksi #{{ $transaction->id }}</h3>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

        <div class="mb-3">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label>Feedback</label>
            <textarea name="feedback" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-success" type="submit">Kirim</button>
    </form>
</div>
@endsection
