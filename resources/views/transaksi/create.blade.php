@extends('halamanuser.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Chekout</h4>
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

            <div class="mb-3" id="serviceOptions">
                <label class="form-label">Pilih Layanan</label>
                <div class="card p-3">
                    <h6>Fast Cleaning</h6>
                    <div class="form-check">
                        <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="fast_cleaning_reguler" value="fast_cleaning_reguler" data-price="30000">
                        <label class="form-check-label" for="fast_cleaning_reguler">Reguler - Rp 30.000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="fast_cleaning_outsole" value="fast_cleaning_outsole" data-price="50000">
                        <label class="form-check-label" for="fast_cleaning_outsole">Outsole - Rp 50.000</label>
                    </div>
                    
                    <h6 class="mt-3">Deep Cleaning</h6>
                    <div class="form-check">
                        <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_mid" value="deep_cleaning_mid" data-price="60000">
                        <label class="form-check-label" for="deep_cleaning_mid">Mid - Rp 60.000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_reguler" value="deep_cleaning_reguler" data-price="80000">
                        <label class="form-check-label" for="deep_cleaning_reguler">Reguler - Rp 80.000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cleaning-option" type="radio" name="cleaning_service" id="deep_cleaning_hard" value="deep_cleaning_hard" data-price="160000">
                        <label class="form-check-label" for="deep_cleaning_hard">Hard - Rp 160.000</label>
                    </div>
                    
                    <h6 class="mt-3">Repaint (Hanya untuk sepatu berwarna)</h6>
                    <div class="form-check">
                        <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_soft" value="repaint_soft" data-price="200000" disabled>
                        <label class="form-check-label" for="repaint_soft">Soft - Rp 200.000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_medium" value="repaint_medium" data-price="250000" disabled>
                        <label class="form-check-label" for="repaint_medium">Medium - Rp 250.000</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input repaint-option" type="radio" name="repaint_service" id="repaint_hard" value="repaint_hard" data-price="300000" disabled>
                        <label class="form-check-label" for="repaint_hard">Hard - Rp 300.000</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="pickup_delivery" name="pickup_delivery" value="1" data-price="15000">
                <label class="form-check-label" for="pickup_delivery">Pickup & Delivery (+Rp 15.000)</label>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan (Opsional)</label>
                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5>Total Pembayaran</h5>
                </div>
                <div class="card-body">
                    <h4 id="totalAmount">Rp 0</h4>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
let lastCheckedRadio = null;

// Logika: radio bisa dibatalkan saat diklik dua kali
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('click', function () {
        if (lastCheckedRadio === this) {
            this.checked = false;
            lastCheckedRadio = null;
            calculateTotal();
        } else {
            lastCheckedRadio = this;
            calculateTotal();
        }
    });
});

// Logika: atur repaint berdasarkan warna
document.querySelectorAll('input[name="color_type"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const repaintSoft = document.getElementById('repaint_soft');
        const repaintMedium = document.getElementById('repaint_medium');
        const repaintHard = document.getElementById('repaint_hard');

        if (this.value === 'berwarna') {
            repaintSoft.disabled = false;
            repaintMedium.disabled = false;
            repaintHard.disabled = false;
        } else if (this.value === 'putih') {
            repaintSoft.disabled = false;
            repaintMedium.disabled = true;
            repaintMedium.checked = false;
            repaintHard.disabled = true;
            repaintHard.checked = false;
        }
        calculateTotal();
    });

    // Trigger change saat halaman dimuat (agar kondisi repaint sesuai pilihan awal)
    if (radio.checked) {
        radio.dispatchEvent(new Event('change'));
    }
});

// Hitung total
document.getElementById('pickup_delivery').addEventListener('change', calculateTotal);

function calculateTotal() {
    let total = 0;
    
    // Cleaning service
    const cleaningSelected = document.querySelector('input[name="cleaning_service"]:checked');
    if (cleaningSelected) {
        total += parseInt(cleaningSelected.dataset.price);
    }
    
    // Repaint service
    const repaintSelected = document.querySelector('input[name="repaint_service"]:checked');
    if (repaintSelected) {
        total += parseInt(repaintSelected.dataset.price);
    }
    
    // Pickup delivery
    if (document.getElementById('pickup_delivery').checked) {
        total += parseInt(document.getElementById('pickup_delivery').dataset.price);
    }
    
    document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
}
</script>
@endsection