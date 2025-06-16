<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { text-align: center; margin-bottom: 30px; }
        .info { margin-bottom: 20px; }
        table { width: 100%; line-height: inherit; text-align: left; }
        table td { padding: 5px; vertical-align: top; }
        table tr td:nth-child(2) { text-align: right; }
        table tr.top table td { padding-bottom: 20px; }
        table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
        table tr.item td { border-bottom: 1px solid #eee; }
        table tr.total td { border-top: 2px solid #eee; font-weight: bold; }
        .status { text-align: center; margin-top: 30px; padding: 10px; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>INVOICE</h2>
            <p>#{{ $transaction->id }}</p>
            <p>Tanggal: {{ $transaction->created_at->format('d/m/Y') }}</p>
        </div>
        
        <div class="info">
            <table>
                <tr>
                    <td>
                        <strong>Kepada:</strong><br>
                        {{ auth()->user()->name }}<br>
                        {{ $transaction->email }}<br>
                        {{ $transaction->phone }}<br>
                        {{ $transaction->address }}
                    </td>
                </tr>
            </table>
        </div>
        
        <table>
            <tr class="heading">
                <td>Item</td>
                <td>Harga</td>
            </tr>
            
            <tr class="item">
                <td>{{ str_replace('_', ' ', $transaction->service_type) }} ({{ $transaction->color_type }})</td>
                <td>Rp {{ number_format($transaction->service_price, 0, ',', '.') }}</td>
            </tr>
            
            @if($transaction->pickup_delivery)
            <tr class="item">
                <td>Pickup & Delivery</td>
                <td>Rp {{ number_format($transaction->pickup_delivery_price, 0, ',', '.') }}</td>
            </tr>
            @endif
            
            <tr class="total">
                <td></td>
                <td>Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>
        
        <div class="status">
            <p>Status: <strong>{{ strtoupper($transaction->status) }}</strong></p>
            @if($transaction->notes)
            <p>Catatan: {{ $transaction->notes }}</p>
            @endif
        </div>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>