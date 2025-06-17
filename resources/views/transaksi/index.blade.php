@extends('halamanuser.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Transaksi</h4>
        <a href="{{ route('halamanuser.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="transactionsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        @if(auth()->user()->can('superadmin'))
                        <th>Pelanggan</th>
                        @endif
                        <th>Layanan</th>
                        <th>Total Tagihan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                        @if(auth()->user()->can('superadmin'))
                        <td>{{ $transaction->user->name }}</td>
                        @endif
                        <td>
                            @if($transaction->cleaning_service)
                                {{ str_replace('_', ' ', $transaction->cleaning_service) }}
                            @endif
                            @if($transaction->repaint_service)
                                + {{ str_replace('_', ' ', $transaction->repaint_service) }}
                            @endif
                        </td>
                        <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('halamanuser.show', $transaction->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            <a href="{{ route('halamanuser.invoice', $transaction->id) }}" class="btn btn-sm btn-success">Invoice</a>
                            
                            @if(auth()->user()->can('superadmin'))
                                @if($transaction->status == 'pending')
                                <form action="{{ route('transaction.approve', $transaction->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('transaction.reject', $transaction->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                                @endif
                            @endif
                            
                            @if($transaction->status == 'pending' && !auth()->user()->can('superadmin'))
                            <form action="{{ route('halamanuser.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#transactionsTable').DataTable();
});
</script>
@endsection