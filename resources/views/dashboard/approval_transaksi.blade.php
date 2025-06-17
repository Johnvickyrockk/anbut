@extends('dashboard.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Approval Transaksi</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="approvalTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Detail Layanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td>
                            @if($transaction->cleaning_service)
                                {{ str_replace('_', ' ', $transaction->cleaning_service) }}
                            @endif
                            @if($transaction->repaint_service)
                                + {{ str_replace('_', ' ', $transaction->repaint_service) }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('approval.transaksi.detail', $transaction->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <form action="{{ route('transaction.approve', $transaction->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <form action="{{ route('transaction.reject', $transaction->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </form>
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
    $('#approvalTable').DataTable();
});
</script>
@endsection