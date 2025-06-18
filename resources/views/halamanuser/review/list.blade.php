@extends('halamanuser.index')

@section('content')
<div class="container mt-4">
    <h3>Review Saya</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Transaksi ID:</strong> {{ $review->transaction_id }}</p>
                <p><strong>Rating:</strong> {{ $review->rating }}</p>
                <p><strong>Feedback:</strong> {{ $review->feedback }}</p>

                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p>Belum ada review yang Anda buat.</p>
    @endforelse
</div>
@endsection
