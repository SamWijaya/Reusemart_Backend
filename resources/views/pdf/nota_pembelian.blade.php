<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan - ReUse Mart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background-color: #f5f5f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Ubah dari center ke flex-start */
            min-height: 100vh;
        }

        .receipt {
            background-color: white;
            width: 100%;
            max-width: 300px;
            /* Tetap batasi lebar maksimal */
            min-width: 280px;
            /* Tambahkan lebar minimal */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            /* Hapus height tetap, biarkan menyesuaikan konten */
        }

        .header {
            text-align: left;
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 11px;
            margin-bottom: 10px;
        }

        .divider {
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        .receipt-info {
            font-size: 10px;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        .receipt-info div {
            margin-bottom: 3px;
        }

        .customer-info {
            font-size: 10px;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        .customer-info div {
            margin-bottom: 3px;
        }

        .items-table {
            margin-bottom: 15px;
        }

        .table-header {
            font-size: 10px;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            display: flex;
        }

        .col-no {
            width: 15%;
        }

        .col-item {
            width: 55%;
        }

        .col-price {
            width: 30%;
            text-align: right;
        }

        .table-row {
            font-size: 10px;
            padding: 3px 0;
            display: flex;
            align-items: flex-start;
        }

        .totals {
            font-size: 10px;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        .totals div {
            margin-bottom: 3px;
            display: flex;
        }

        .totals .label {
            width: 40%;
        }

        .totals .value {
            width: 60%;
        }

        .footer {
            font-size: 10px;
            line-height: 1.4;
        }

        .footer div {
            margin-bottom: 3px;
        }

        .signature-section {
            margin-top: 30px;
            font-size: 10px;
        }

        .signature-line {
            margin-top: 40px;
            margin-bottom: 10px;
        }

        .signature-space {
            height: 60px;
            margin-bottom: 5px;
        }

        /* Media query untuk layar kecil */
        @media (max-width: 360px) {
            body {
                padding: 10px;
            }

            .receipt {
                min-width: 260px;
                padding: 15px;
            }
        }

        /* Media query untuk layar besar */
        @media (min-width: 768px) {
            body {
                align-items: center;
                /* Kembali ke center untuk layar besar */
            }
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
                align-items: flex-start;
                min-height: auto;
                /* Hapus min-height saat print */
            }

            .receipt {
                box-shadow: none;
                border: none;
                max-width: none;
                /* Hapus batasan lebar saat print */
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="company-name">ReUse Mart</div>
            <div class="company-address">Jl. Green Eco Park No. 456 Yogyakarta</div>
        </div>

        <div class="divider"></div>

        <!-- Receipt Info -->
        <div class="receipt-info">
            @php
                $tanggalPembelian = \Carbon\Carbon::parse($pembelian->TANGGAL_PEMBELIAN);
                $nomorNota = $tanggalPembelian->format('y.m') . '.' . $pembelian->ID_PEMBELIAN;
            @endphp

            <div>No Nota : {{ $nomorNota }}</div>
            <div>Tanggal pesan : {{ $pembelian->TANGGAL_PEMBELIAN }}</div>
            <div>Lunas pada : {{ $pembelian->TANGGAL_LUNAS }}</div>
            @if ($pembelian->METODE_PENGIRIMAN)
                <div>Tanggal kirim : {{ $pembelian->TANGGAL_PENGIRIMAN ?? '-' }}</div>
            @else
                <div>Tanggal ambil : {{ $pembelian->TANGGAL_DITERIMA ?? '-' }}</div>
            @endif
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <div>Pembeli : {{ $pembelian->pembeli->EMAIL_PEMBELI }} / {{ $pembelian->pembeli->NAMA_PEMBELI }}</div>
            <div>Delivery : - (diambil sendiri)</div>
            @if ($pembelian->METODE_PENGIRIMAN)
                <div class="customer-info">
                    <div>{{ $pembelian->alamat->NAMA_JALAN }}</div>
                    <div>{{ $pembelian->alamat->KELURAHAN }},{{ $pembelian->alamat->KECAMATAN }}</div>
                    <div>Delivery : Kurir ReUseMart ({{ $pembelian->pegawai->NAMA_PEGAWAI ?? '-' }})</div>
                </div>
            @endif
        </div>

        <!-- Items Table -->
        <table class="items-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #000; padding: 5px;">No.</th>
                    <th style="border-bottom: 1px solid #000; padding: 5px;">Nama Barang</th>
                    <th style="border-bottom: 1px solid #000; padding: 5px;">Harga Barang</th>
                </tr>
            </thead>
            @php
                // Ambil hanya barang unik berdasarkan ID_BARANG
                $uniqueBarangList = collect($barangList)->unique(function ($item) {
                    return $item->barang->ID_BARANG ?? null;
                })->values();
            @endphp

            <tbody>
                @foreach ($uniqueBarangList as $i => $detail)
                    <tr>
                        <td style="padding: 5px; text-align: center;">{{ $i + 1 }}</td>
                        <td style="padding: 5px;">{{ $detail->barang->NAMA_BARANG ?? '-' }}</td>
                        <td style="padding: 5px; text-align: right;">
                            Rp{{ number_format($detail->barang->HARGA_BARANG, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>


        <!-- Totals -->
        <div class="totals">
            @php
                $subtotal = $pembelian->SUBTOTAL;
                $ongkir = 0;

                if ($pembelian->METODE_PENGIRIMAN && $subtotal < 1500000) {
                    $ongkir = 100000;
                }

                $totalBayar = $subtotal + $ongkir;
            @endphp

            <div>
                <span class="label">Total</span>
                <span class="value">: Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="label">Ongkos Kirim</span>
                <span class="value">: Rp{{ number_format($ongkir, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="label">Total</span>
                <span class="value">: Rp{{ number_format($totalBayar, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="label">Potongan</span>
                <span class="value">: {{ $pembelian->POIN_DIGUNAKAN }} Poin</span>
            </div>
            <div>
                <span class="label">Total</span>
                <span class="value">: Rp{{ number_format($pembelian->TOTAL_BAYAR, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="label">Poin dari pesanan ini</span>
                <span class="value">: {{ $pembelian->POIN_DIDAPAT }}</span>
            </div>
            <div>
                <span class="label">Total poin customer</span>
                <span class="value">: {{ $pembelian->Pembeli->POIN_PEMBELI }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            @php
                $pegawaiPenitipanUnik = collect($pembelian->detailPembelian)
                    ->map(function ($detail) {
                        return $detail->barang->penitipan->pegawai;
                    })
                    ->filter() // hilangkan yang null
                    ->unique('ID_PEGAWAI'); // supaya tidak dobel
            @endphp

            @foreach ($pegawaiPenitipanUnik as $pegawai)
                <p>QC Oleh: {{ $pegawai->NAMA_PEGAWAI }}, </p>
            @endforeach
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div>Diterima oleh:</div>
            <div class="signature-space"></div>
            <div class="signature-line">(.........................................)</div>
            <div>Tanggal: .............................</div>
        </div>
    </div>
</body>

</html>