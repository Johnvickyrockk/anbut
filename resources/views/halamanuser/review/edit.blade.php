@extends('halamanuser.index')

@section('content')
<div class="container mt-4">
    <h3>Edit Review untuk Transaksi #{{ $review->transaction_id }}</h3>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Rating</label>
            <input type="number" name="rating" class="form-control" value="{{ $review->rating }}" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label>Feedback</label>
            <textarea name="feedback" class="form-control" rows="4" required>{{ $review->feedback }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
