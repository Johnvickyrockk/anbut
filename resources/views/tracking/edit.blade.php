@extends('dashboard.index')

@section('content')
<div class="page-heading">
    <h3>Edit Pesanan</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Pesanan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tracking.update', $trackingOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="order_number">Nomor Pesanan</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" value="{{ $trackingOrder->order_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_name">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $trackingOrder->customer_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Email Pelanggan</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ $trackingOrder->customer_email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="processing" {{ $trackingOrder->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $trackingOrder->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $trackingOrder->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan untuk Pelanggan</label>
                            <textarea class="form-control" id="message" name="message" rows="3">{{ $trackingOrder->message }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="admin_notes">Catatan Admin</label>
                            <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ $trackingOrder->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('tracking.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection