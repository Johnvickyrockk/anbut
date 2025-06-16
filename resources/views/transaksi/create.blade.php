@extends('halamanuser.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Buat Transaksi Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('halamanuser.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pilih Warna</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="color_type" id="berwarna" value="berwarna" checked>
                    <label class="form-check-label" for="berwarna">Berwarna</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="color_type" id="putih" value="putih">
                    <label class="form-check-label" for="putih">Putih</label>
                </div>
            </div>
           // resources/views/transaksi/create.blade.php
<div class="mb-3" id="serviceOptions">
    <label class="form-label">Pilih Layanan</label>
    <div class="card p-3">
        <h6>Fast Cleaning</h6>
        <div class="form-check">
            <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="fast_cleaning_reguler" value="fast_cleaning_reguler">
            <label class="form-check-label" for="fast_cleaning_reguler">Reguler - Rp 30.000</label>
        </div>
        <div class="form-check">
            <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="fast_cleaning_outsole" value="fast_cleaning_outsole">
            <label class="form-check-label" for="fast_cleaning_outsole">Outsole - Rp 50.000</label>
        </div>
        
        <h6 class="mt-3">Deep Cleaning</h6>
        <div class="form-check">
            <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_mid" value="deep_cleaning_mid">
            <label class="form-check-label" for="deep_cleaning_mid">Mid - Rp 60.000</label>
        </div>
        <div class="form-check">
            <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_reguler" value="deep_cleaning_reguler">
            <label class="form-check-label" for="deep_cleaning_reguler">Reguler - Rp 80.000</label>
        </div>
        <div class="form-check">
            <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_hard" value="deep_cleaning_hard">
            <label class="form-check-label" for="deep_cleaning_hard">Hard - Rp 160.000</label>
        </div>
        
        <h6 class="mt-3">Repaint (Hanya untuk sepatu berwarna)</h6>
        <div class="form-check">
            <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_soft" value="repaint_soft" disabled>
            <label class="form-check-label" for="repaint_soft">Soft - Rp 200.000</label>
        </div>
        <div class="form-check">
            <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_medium" value="repaint_medium" disabled>
            <label class="form-check-label" for="repaint_medium">Medium - Rp 250.000</label>
        </div>
        <div class="form-check">
            <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_hard" value="repaint_hard" disabled>
            <label class="form-check-label" for="repaint_hard">Hard - Rp 300.000</label>
        </div>
    </div>
</div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="pickup_delivery" name="pickup_delivery" value="1">
                <label class="form-check-label" for="pickup_delivery">Pickup & Delivery (+Rp 15.000)</label>
            </div>
            
            <div class="mb-3">
                <label for="notes" class="form-label">Catatan Tambahan</label>
                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('input[name="color_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const repaintOptions = document.querySelectorAll('.repaint-option');
        
        if (this.value === 'berwarna') {
            repaintOptions.forEach(option => {
                option.disabled = false;
            });
        } else {
            repaintOptions.forEach(option => {
                option.disabled = true;
                option.checked = false;
            });
        }
    });
});

// Make sure only one cleaning option can be selected
document.querySelectorAll('.cleaning-option').forEach(option => {
    option.addEventListener('change', function() {
        if (this.checked) {
            document.querySelectorAll('.cleaning-option').forEach(other => {
                if (other !== this) other.checked = false;
            });
        }
    });
});
</script>
@endsection