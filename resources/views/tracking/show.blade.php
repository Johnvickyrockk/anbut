@extends('halamanuser.index')

@section('content')
<div class="page-heading">
    <h3>Lacak Pesanan</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pesanan</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Nomor Pesanan:</h6>
                            <p>{{ $trackingOrder->order_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Status:</h6>
                            <p>
                                <span class="badge 
                                    @if($trackingOrder->status == 'processing') bg-warning
                                    @elseif($trackingOrder->status == 'shipped') bg-info
                                    @elseif($trackingOrder->status == 'delivered') bg-success
                                    @endif">
                                    {{ ucfirst($trackingOrder->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Nama Pelanggan:</h6>
                            <p>{{ $trackingOrder->customer_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Email:</h6>
                            <p>{{ $trackingOrder->customer_email }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6>Pesan:</h6>
                        <p>{{ $trackingOrder->message ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <h6>Update Terakhir:</h6>
                        <p>{{ $trackingOrder->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection