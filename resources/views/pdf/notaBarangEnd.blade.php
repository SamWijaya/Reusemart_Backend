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

    <div class="info">
        <p><strong>ReUse Mart</strong><br>
            Jl. Green Eco Park No. 456 Yogyakarta</p>

        <p><strong>LAPORAN Barang yang Masa Penitipannya Sudah Habis</strong><br>
            Tanggal cetak: {{ $tanggalCetak }}</p>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-header">
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Id Penitip</th>
                <th scope="col">Nama Penitip</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Tanggal Akhir</th>
                <th scope="col">Batas Ambil</th>
            </tr>
        </thead>
        <tbody id="requestsTableBody">
            @forelse ($barangList as $barang)
                <tr>
                    <td>{{ $barang->ID_BARANG }}</td>
                    <td>{{ $barang->NAMA_BARANG }}</td>
                    <td>{{ $barang->penitipan->ID_PENITIP }}</td>
                    <td>{{ $barang->penitipan->penitip->NAMA_PENITIP }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_PENITIPAN)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_BERAKHIR)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($barang->penitipan->BATAS_AMBIL)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>