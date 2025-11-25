<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan Per Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .judul {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
        }

        .info {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="judul">Laporan penjualan per kategori barang (dalam 1 tahun)</div>

    <div class="info">
        <p><strong>ReUse Mart</strong><br>
            Jl. Green Eco Park No. 456 Yogyakarta</p>

        <p><strong>LAPORAN PENJUALAN PER KATEGORI BARANG</strong><br>
            Tahun : {{ $tahun }}<br>
            Tanggal cetak: {{ $tanggalCetak }}</p>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-header">
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah Item Terjual</th>
                <th scope="col">Jumlah Item Gagal Terjual</th>
            </tr>
        </thead>
        <tbody id="requestsTableBody">
            @php
                $totalTerjual = 0;
                $totalGagal = 0;
            @endphp
            @foreach($kategoriData as $kategori => $data)
                <tr>
                    <td>{{ $kategori }}</td>
                    <td>{{ $data['terjual'] }}</td>
                    <td>{{ $data['gagal'] }}</td>
                </tr>
                @php
                    $totalTerjual += $data['terjual'];
                    $totalGagal += $data['gagal'];
                @endphp
            @endforeach
            <tr class="fw-bold">
                <td>Total</td>
                <td>{{ $totalTerjual }}</td>
                <td>{{ $totalGagal }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>