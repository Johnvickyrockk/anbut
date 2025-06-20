@extends('halamanuser.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Detail Transaksi #{{ $transaction->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Informasi Pelanggan</h5>
                <p><strong>Nama:</strong> {{ $transaction->user->name }}</p>
                <p><strong>Email:</strong> {{ $transaction->email }}</p>
                <p><strong>No Telepon:</strong> {{ $transaction->phone }}</p>
                <p><strong>Alamat:</strong> {{ $transaction->address }}</p>
            </div>
            <div class="col-md-6">
                <h5>Detail Layanan</h5>
                <p><strong>Jenis Sepatu:</strong> {{ ucfirst($transaction->color_type) }}</p>
                
                @if($transaction->cleaning_service)
                <p><strong>Layanan Cleaning:</strong> {{ str_replace('_', ' ', $transaction->cleaning_service) }}</p>
                <p><strong>Harga Cleaning:</strong> Rp {{ number_format($transaction->cleaning_price, 0, ',', '.') }}</p>
                @endif
                
                @if($transaction->repaint_service)
                <p><strong>Layanan Repaint:</strong> {{ str_replace('_', ' ', $transaction->repaint_service) }}</p>
                <p><strong>Harga Repaint:</strong> Rp {{ number_format($transaction->repaint_price, 0, ',', '.') }}</p>
                @endif
                
                <p><strong>Pickup & Delivery:</strong> {{ $transaction->pickup_delivery ? 'Ya (+Rp 15.000)' : 'Tidak' }}</p>
                <p><strong>Total Tagihan:</strong> Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </p>
            </div>
        </div>
        
        @if($transaction->notes)
        <div class="mt-4">
            <h5>Catatan Tambahan</h5>
            <p>{{ $transaction->notes }}</p>
        </div>
        @endif
        
        <div class="mt-4">
            <a href="{{ route('halamanuser.index') }}" class="btn btn-secondary">Kembali</a>
            
            @if(auth()->user()->can('superadmin'))
                @if($transaction->status == 'pending')
                <form action="{{ route('transaction.approve', $transaction->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('transaction.reject', $transaction->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection