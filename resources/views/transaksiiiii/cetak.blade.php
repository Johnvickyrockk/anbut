<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 5px 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .details,
        .category,
        .services {
            margin-bottom: 10px;
        }

        .details table,
        .category table,
        .services table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            font-size: 10px;
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Nota Transaksi</h1>
            <p>Transaksi #TRX-2023-001</p>
            <p>15-06-2023</p>
        </div>

        <div class="details">
            <h3>Informasi Customer</h3>
            <table>
                <tr>
                    <th>Nama Customer</th>
                    <td>John Doe</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>john@example.com</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>08123456789</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>Jl. Contoh No. 123, Jakarta</td>
                </tr>
            </table>
        </div>

        <!-- Informasi Promosi -->
        <div class="details">
            <h3>Informasi Promosi</h3>
            <table>
                <tr>
                    <th>Kode Promosi</th>
                    <td>DISKON20</td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td>20%</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>Diskon khusus akhir tahun</td>
                </tr>
            </table>
        </div>

        <div class="category">
            <h3 style="text-align: center; font-family: Arial, sans-serif;">Kategori Harga yang Dipilih</h3>
            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                <thead>
                    <tr>
                        <th style="padding: 10px; background-color: #4CAF50; color: white; text-align: left;">Nama
                            Kategori</th>
                        <th style="padding: 10px; background-color: #4CAF50; color: white; text-align: center;">Jumlah
                        </th>
                        <th style="padding: 10px; background-color: #4CAF50; color: white; text-align: right;">Harga
                        </th>
                        <th style="padding: 10px; background-color: #4CAF50; color: white; text-align: right;">Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Kategori Induk -->
                    <tr>
                        <td colspan="4" style="padding: 10px; background-color: #f0f0f0; font-weight: bold; text-align: center; vertical-align: middle;">
                            Cuci Sepatu
                        </td>
                    </tr>

                    <!-- Sub Kategori -->
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">Cuci Biasa</td>
                        <td style="padding: 10px; text-align: center;">2</td>
                        <td style="padding: 10px; text-align: right;">
                            Rp50.000
                        </td>
                        <td style="padding: 10px; text-align: right;">
                            Rp100.000
                        </td>
                    </tr>

                    <!-- Total Kategori Harga -->
                    <tr style="background-color: #ffeb3b; font-weight: bold;">
                        <td colspan="3" style="padding: 10px;">Total Kategori Harga</td>
                        <td style="padding: 10px; text-align: right;">
                            Rp100.000
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="services">
            <h3>Layanan Tambahan</h3>
            <table>
                <thead>
                    <tr>
                        <th style="background-color: #4CAF50; color: white">Layanan</th>
                        <th style="background-color: #4CAF50; color: white">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Protection Spray</td>
                        <td>Rp25.000</td>
                    </tr>
                    <tr>
                        <th colspan="1">Total Layanan Tambahan</th>
                        <td>Rp25.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Keseluruhan -->
        <div class="total">
            <h3>Total Keseluruhan</h3>
            <table>
                <tr>
                    <th>Total Kategori Harga</th>
                    <td>Rp100.000</td>
                </tr>
                <tr>
                    <th>Total Layanan Tambahan</th>
                    <td>Rp25.000</td>
                </tr>
                <tr>
                    <th>Sub Total</th>
                    <td>Rp125.000</td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td>-Rp25.000</td>
                </tr>
                <tr>
                    <th>Total Setelah Diskon</th>
                    <td>Rp100.000</td>
                </tr>
                <tr>
                    <th>Downpayment</th>
                    <td>Rp50.000</td>
                </tr>
                <tr>
                    <th>Sisa Pembayaran</th>
                    <td>Rp50.000</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas transaksi Anda!</p>
            <p>Silakan hubungi kami jika Anda membutuhkan bantuan lebih lanjut.</p>
        </div>
    </div>
</body>
</html>