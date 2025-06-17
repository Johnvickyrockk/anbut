@extends('halamanuser.index')

@section('content')
<div class="page-heading">
    <h3>Daftar Pesanan Anda</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            @if($trackingOrders->isEmpty())
                <div class="alert alert-info">
                    Anda belum memiliki pesanan.
                </div>
            @else
                @foreach($trackingOrders as $tracking)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Pesanan #{{ $tracking->order_number }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Status:</h5>
                                <span class="badge {{ $tracking->statusBadge['class'] }}">
                                    {{ $tracking->statusBadge['text'] }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <h5>Tanggal Pesanan:</h5>
                                <p>{{ $tracking->created_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
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
                        <div class="mb-3">
                            <h5>Pesan untuk Pelanggan:</h5>
                            <div class="alert alert-info">
                                {{ $tracking->message }}
                            </div>
                        </div>
                        @endif

                        @if($tracking->admin_notes)
                        <div class="mb-3">
                            <h5>Catatan Admin:</h5>
                            <div class="alert alert-warning">
                                {{ $tracking->admin_notes }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>
</div>
@endsection