<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Komisi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .page-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        .company-address {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }
        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .report-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .report-info div {
            background-color: #f5f5f5;
            padding: 5px 10px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .total-row {
            font-weight: bold;
            background-color: #e8f5e9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
        .print-btn {
            margin-top: 20px;
            text-align: center;
        }
        button {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .filter-form {
            background-color: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .filter-form label {
            margin-right: 5px;
            font-weight: bold;
        }
        .filter-form select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
            margin-right: 15px;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #666;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-top: 20px;
        }
        .empty-state h3 {
            color: #4CAF50;
            margin-bottom: 10px;
        }

        @media print {
            .no-print, .filter-form {
                display: none !important;
            }
            body {
                padding: 0;
                font-size: 11px;
            }
            .page-container {
                box-shadow: none;
                padding: 10px;
            }
            th {
                background-color: #4CAF50 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="filter-form no-print">
            <form method="GET" action="/laporanKomisi">
                <label for="bulan">Bulan:</label>
                <select name="bulan" id="bulan">
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
                
                <label for="tahun">Tahun:</label>
                <select name="tahun" id="tahun">
                    @for($i=date('Y')-2; $i<=date('Y')+1; $i++)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                
                <button type="submit">Filter</button>
            </form>
        </div>

        @if(empty($barangList) || $barangList->isEmpty())
            <div class="empty-state">
                <h3>Tidak ada data komisi untuk periode ini</h3>
                <p>Silakan pilih bulan dan tahun lain</p>
            </div>
        @else
            <div class="header">
                <div class="company-name">ReUse Mart</div>
                <div class="company-address">Jl. Green Eco Park No. 456 Yogyakarta</div>
                <div class="report-title">LAPORAN KOMISI</div>
                <div class="report-info">
                    <div>Bulan: {{ \Carbon\Carbon::parse($barangList[0]->TANGGAL_PENITIPAN)->translatedFormat('F') }}</div>
                    <div>Tahun: {{ \Carbon\Carbon::parse($barangList[0]->TANGGAL_PENITIPAN)->format('Y') }}</div>
                    <div>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('j F Y') }}</div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Kode Produk</th>
                        <th class="text-left">Nama Produk</th>
                        <th width="12%">Harga Jual</th>
                        <th width="10%">Tgl Masuk</th>
                        <th width="10%">Tgl Lunas</th>
                        <th width="12%">Komisi Hunter</th>
                        <th width="12%">Komisi ReUse</th>
                        <th width="12%">Bonus Penitip</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalKomisiHunter = 0;
                        $totalKomisiReuse = 0;
                        $totalBonusPenitip = 0;
                    @endphp
                    
                    @foreach($barangList as $barang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $barang->NO_NOTA }}</td>
                        <td class="text-left">{{ $barang->NAMA_BARANG }}</td>
                        <td class="text-right">{{ number_format($barang->HARGA_BARANG, 0, ',', '.') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($barang->TANGGAL_PENITIPAN)->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $barang->TANGGAL_LUNAS ? \Carbon\Carbon::parse($barang->TANGGAL_LUNAS)->format('d/m/Y') : '-' }}</td>
                        <td class="text-right">{{ number_format($barang->KOMISI_HUNTER, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($barang->KOMISI_REUSE, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($barang->BONUS_PENITIP, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $totalKomisiHunter += $barang->KOMISI_HUNTER;
                        $totalKomisiReuse += $barang->KOMISI_REUSE;
                        $totalBonusPenitip += $barang->BONUS_PENITIP;
                    @endphp
                    @endforeach
                    
                    <tr class="total-row">
                        <td colspan="6" class="text-right"><strong>Total</strong></td>
                        <td class="text-right"><strong>{{ number_format($totalKomisiHunter, 0, ',', '.') }}</strong></td>
                        <td class="text-right"><strong>{{ number_format($totalKomisiReuse, 0, ',', '.') }}</strong></td>
                        <td class="text-right"><strong>{{ number_format($totalBonusPenitip, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="footer">
                <p>Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('l, j F Y H:i:s') }}</p>
            </div>

            <div class="print-btn no-print">
                <button onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
            </div>
        @endif
    </div>

    <script>
        // Auto print jika diinginkan (optional)
        window.onload = function() {
            // Uncomment baris berikut untuk auto print
            // setTimeout(function() { window.print(); }, 1000);
        };
    </script>
</body>
</html>