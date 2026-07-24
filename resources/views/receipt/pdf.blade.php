<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #374151;
            padding: 30px;
            background: #ffffff;
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }
        .header {
            background-color: #6d28d9;
            color: white;
            text-align: center;
            padding: 28px 20px;
        }
        .header .brand {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ede9fe;
            margin-bottom: 6px;
        }
        .header h2 {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .header p {
            font-size: 11px;
            color: #ddd6fe;
            margin-top: 6px;
        }
        .status-badge {
            display: inline-block;
            margin-top: 10px;
            background-color: #7c3aed;
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.5px;
            color: #ffffff;
        }
        .box {
            padding: 24px 28px;
        }
        .section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9ca3af;
            font-weight: bold;
            margin-bottom: 10px;
        }
        table { width: 100%; border-collapse: collapse; }
        .info-table td {
            padding: 5px 0;
            font-size: 12.5px;
        }
        .info-table .label { color: #6b7280; }
        .info-table .value {
            text-align: right;
            font-weight: bold;
            color: #1f2937;
        }
        .divider {
            border-top: 1px dashed #e5e7eb;
            margin: 18px 0;
            font-size: 1px;
            line-height: 1px;
        }
        .price-table td { padding: 5px 0; font-size: 12.5px; }
        .price-table .label { color: #6b7280; }
        .price-table .value { text-align: right; color: #1f2937; font-weight: bold; }
        .total-box {
            background-color: #f5f3ff;
            border: 1px solid #ddd6fe;
            border-radius: 10px;
            padding: 16px 20px;
            margin-top: 16px;
        }
        .total-box table td {
            font-size: 15px;
            font-weight: bold;
        }
        .total-box .label { color: #6d28d9; }
        .total-box .value { text-align: right; color: #6d28d9; font-size: 20px; }
        .footer {
            text-align: center;
            padding: 18px 20px;
            background-color: #fafafa;
            border-top: 1px solid #f0f0f0;
            color: #9ca3af;
            font-size: 10.5px;
        }
        .footer .thanks { color: #4b5563; font-size: 12px; font-weight: bold; margin-bottom: 4px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <div class="brand">TWOGETHER MUSIC SPACE</div>
            <h2>STRUK PEMBAYARAN</h2>
            <p>Booking #{{ $booking->id }}</p>
            <div class="status-badge">{{ strtoupper($booking->status) }}</div>
        </div>

        <div class="box">
            <div class="section-title">Detail Reservasi</div>
            <table class="info-table">
                <tr>
                    <td class="label">Nama Pemesan</td>
                    <td class="value">{{ $booking->user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Studio</td>
                    <td class="value">{{ $booking->studio->nama_studio }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal</td>
                    <td class="value">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>
                </tr>
                @if($booking->studio->jenis === 'Recording')
                    <tr>
                        <td class="label">Jam</td>
                        <td class="value">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="label">Durasi Sewa</td>
                        <td class="value">{{ $booking->durasi_bulan }} Bulan</td>
                    </tr>
                    <tr>
                        <td class="label">Berlaku Sampai</td>
                        <td class="value">{{ \Carbon\Carbon::parse($booking->tanggal_selesai)->translatedFormat('d F Y') }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Metode Pembayaran</td>
                    <td class="value">{{ $booking->metode_pembayaran ?? '-' }}</td>
                </tr>
            </table>

            <div class="divider">&nbsp;</div>

            <div class="section-title">Rincian Biaya</div>
            <table class="price-table">
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="value">Rp{{ number_format($booking->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Pajak (11%)</td>
                    <td class="value">Rp{{ number_format($booking->tax_amount, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="total-box">
                <table>
                    <tr>
                        <td class="label">Total Bayar</td>
                        <td class="value">Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="footer">
            <div class="thanks">Terima kasih telah menggunakan layanan kami</div>
            <div>Twogether Music Space - Struk ini sah tanpa tanda tangan</div>
        </div>
    </div>

</body>
</html>