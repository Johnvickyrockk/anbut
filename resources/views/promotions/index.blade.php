@extends('dashboard.index')

@section('breadcrumbs')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            Daftar Promosi
        </h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="/dashboard" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Promosi</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h2>Daftar Promosi</h2>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('promotions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Promosi
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="promotions-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Promosi</th>
                            <th>Kode</th>
                            <th>Diskon</th>
                            <th>Min. Pembayaran</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $key => $promotion)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $promotion->name }}</td>
                                <td>{{ $promotion->code }}</td>
                                <td>{{ $promotion->discount }}%</td>
                                <td>Rp {{ number_format($promotion->min_payment, 0, ',', '.') }}</td>
                                <td>{{ $promotion->start_date->format('d M Y') }}</td>
                                <td>{{ $promotion->end_date->format('d M Y') }}</td>
                                <td>
                                    @if($promotion->is_active && $promotion->end_date >= now())
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus promosi ini?')">
                                            <i class="fas fa-trash"></i>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#promotions-table').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                }
            });
        });
    </script>
@endpush