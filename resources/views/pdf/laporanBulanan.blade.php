<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Bulanan</title>
    <style>
        @page {
            size: A4;
            margin: 1.5cm;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .report-container {
            max-width: 210mm;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
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
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0 5px;
            color: #333;
            text-align: center;
        }

        .report-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .report-info div {
            background-color: #f5f5f5;
            padding: 5px 15px;
            border-radius: 20px;
        }

        .chart-container {
            width: 100%;
            height: 300px;
            margin: 25px 0;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 13px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f8e9;
        }

        .total-row {
            font-weight: bold;
            background-color: #e8f5e9;
            border-top: 2px solid #4CAF50;
            border-bottom: 2px solid #4CAF50;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-data {
            color: #999;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }

        .print-btn {
            margin-top: 25px;
            text-align: center;
        }

        button {
            padding: 10px 25px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
                font-size: 12px;
            }

            .report-container {
                box-shadow: none;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            th {
                background-color: #4CAF50 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="report-container">
        <div class="header">
            <div class="company-name">ReUse Mart</div>
            <div class="company-address">Jl. Green Eco Park No. 456 Yogyakarta</div>
        </div>

        <div class="report-title">LAPORAN PENJUALAN BULANAN</div>

        <div class="report-info">
            <div>Tahun: {{ $tahunDipilih }}</div>
            <div>Tanggal Cetak: {{ $tanggalCetak }}</div>
        </div>

        <table>
            <thead>
                <tr class="table-header">
                    <th scope="col">Bulan</th>
                    <th scope="col">Jumlah Barang Terjual</th>
                    <th scope="col">Jumlah Penjualan Kotor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $item)
                    <tr>
                        <td>{{ $item['bulan'] }}</td>
                        <td>{{ $item['jumlah_terjual'] }}</td>
                        <td>Rp {{ number_format($item['total_penjualan'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr style="font-weight: bold; background-color: #f0f0f0;">
                    <td>Total</td>
                    <td>{{ $total_terjual }}</td>
                    <td>Rp {{ number_format($total_penjualan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>

        <h4 style="text-align: center; margin-top: 30px;">Grafik Penjualan Bulanan</h4>
        <img src="{{ public_path('storage/' . $chartFilename) }}"
            style="display: block; margin: 20px auto; width: 90%; max-width: 700px;" alt="Grafik Penjualan">

    </div>
</body>

</html>