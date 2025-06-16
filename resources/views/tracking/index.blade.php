@extends('dashboard.index')

@section('content')
<div class="page-heading">
    <h3>Tracking Pesanan</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pesanan</h4>
                    <a href="{{ route('tracking.create') }}" class="btn btn-primary">Tambah Pesanan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_email }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'processing') bg-warning
                                            @elseif($order->status == 'shipped') bg-info
                                            @elseif($order->status == 'delivered') bg-success
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('tracking.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('tracking.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection