@extends('dashboard.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Laporan Pendapatan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="incomeTable">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                        <td>{{ $transaction->user->name }}</td>
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
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Pendapatan</th>
                        <th colspan="2">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#incomeTable').DataTable();
});
</script>
@endsection