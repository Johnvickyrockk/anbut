@extends('halamanuser.index')

@section('content')
<div class="page-heading">
    <h3>Detail Lacak Pesanan</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Pesanan</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nomor Pesanan:</h5>
                            <p class="fs-5">{{ $tracking->order_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Status:</h5>
                            <span class="badge 
                                @if($tracking->status == 'processing') bg-warning
                                @elseif($tracking->status == 'shipped') bg-info
                                @elseif($tracking->status == 'delivered') bg-success
                                @endif fs-6">
                                {{ ucfirst($tracking->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Nama Pelanggan:</h5>
                            <p>{{ $tracking->customer_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Email:</h5>
                            <p>{{ $tracking->customer_email }}</p>
                        </div>
                    </div>

                    @if($tracking->message)
                    <div class="mb-4">
                        <h5>Pesan untuk Pelanggan:</h5>
                        <div class="alert alert-info">
                            {{ $tracking->message }}
                        </div>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h5>Terakhir Diupdate:</h5>
                        <p>{{ $tracking->updated_at ? $tracking->updated_at->format('d F Y H:i') : '-' }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        @auth
                        <a href="{{ route('tracking.edit', $tracking) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Pesanan
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
