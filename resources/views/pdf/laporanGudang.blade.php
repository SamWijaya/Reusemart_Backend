adm
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Gudang</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f9f9f9;
        }

        .page-container {
            max-width: 100%;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
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
            font-size: 14px;
            color: #666;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0 5px;
            color: #333;
        }

        .report-date {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 10px 8px;
            border: 1px solid #e0e0e0;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f8e9;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            color: #777;
            text-align: right;
            padding-top: 10px;
            border-top: 1px solid #eee;
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

        .status-yes {
            color: #388E3C;
            font-weight: bold;
        }

        .status-no {
            color: #D32F2F;
            font-weight: bold;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
                font-size: 12px;
            }

            .page-container {
                box-shadow: none;
                padding: 10px;
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
</head>

<body>
    <div class="page-container">
        <div class="header">
            <div class="company-name">ReUse Mart</div>
            <div class="company-address">JL Green Eco Park No. 456 Yogyakarta</div>
        </div>

        <div class="report-title">LAPORAN STOK GUDANG</div>
        <div class="report-date">Tanggal cetak: {{ \Carbon\Carbon::now()->translatedFormat('l, j F Y H:i') }}</div>

        <table>
            <thead>
                <tr>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Id Penitip</th>
                    <th scope="col">Nama Penitip</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Perpanjangan</th>
                    <th scope="col">ID Hunter</th>
                    <th scope="col">Nama Hunter</th>
                    <th scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->kode_produk }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->ID_PENITIP }}</td>
                        <td>{{ $item->NAMA_PENITIP }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td>{{ $item->perpanjangan == 0 ? 'Tidak' : 'Ya' }}</td>
                        <td>{{ $item->ID_HUNTER ?? '-' }}</td>
                        <td>{{ $item->NAMA_HUNTER ?? '-' }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>