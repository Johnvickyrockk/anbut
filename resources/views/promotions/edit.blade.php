@extends('dashboard.index')

@section('breadcrumbs')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            Edit Promosi
        </h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="/dashboard" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('promotions.index') }}" class="text-muted text-hover-primary">Promosi</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Edit</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Promosi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Promosi</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $promotion->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="code" class="form-label">Kode Promosi</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $promotion->code }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="discount" class="form-label">Diskon (%)</label>
                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ $promotion->discount }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="min_payment" class="form-label">Minimal Pembayaran</label>
                        <input type="number" class="form-control" id="min_payment" name="min_payment" value="{{ $promotion->min_payment }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $promotion->start_date->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $promotion->end_date->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection