<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi Penitip</title>
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
    <div class="info">
        <p><strong>ReUse Mart</strong><br>
            Jl. Green Eco Park No. 456 Yogyakarta</p>

        <p><strong>Nota Transaksi Penitip</strong><br>
        <p><strong>ID Penitip:</strong> {{ $penitip->ID_PENITIP }}</p>
        <p><strong>Nama:</strong> {{ $penitip->NAMA_PENITIP }}</p>
        <p><strong>Bulan:</strong> {{ $bulan }}</p>
        <p><strong>Tahun:</strong> {{ $tahun }}</p>
        <p><strong>Tanggal cetak:</strong> {{ $tanggalCetak }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Penitipan</th>
                <th>Harga Jual Bersih (80%)</th>
                <th>Bonus Penitip</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangList as $barang)
                    <tr>
                        <td>{{ $barang->ID_BARANG }}</td>
                        <td>{{ $barang->NAMA_BARANG }}</td>
                        <td>{{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_PENITIPAN)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($barang->HARGA_BARANG * 0.8, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($barang->pembelian->first()->BONUS_PENITIP ?? 0, 0, ',', '.') }}</td>
                        <td>
                            Rp {{
                number_format(
                    ($barang->HARGA_BARANG * 0.8) + ($barang->pembelian->first()->BONUS_PENITIP ?? 0),
                    0,
                    ',',
                    '.'
                )
                    }}
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>