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

        <p><strong>LAPORAN Donasi Barang</strong><br>
            Tahun : {{ $tahun }}<br>
            Tanggal cetak: {{ $tanggalCetak }}</p>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-header">
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Id Penitip</th>
                <th scope="col">Nama Penitip</th>
                <th scope="col">Tanggal Donasi</th>
                <th scope="col">Organisasi</th>
                <th scope="col">Nama Penerima</th>
            </tr>
        </thead>
        <tbody id="requestsTableBody">
            @forelse ($donasiList as $donasi)
                <tr>
                    <td>{{ $donasi->barang->ID_BARANG ?? '-' }}</td>
                    <td>{{ $donasi->barang->NAMA_BARANG ?? '-' }}</td>
                    <td>{{ $donasi->barang->penitipan->ID_PENITIP ?? '-' }}</td>
                    <td>{{ $donasi->barang->penitipan->penitip->NAMA_PENITIP ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($donasi->TANGGAL_DONASI)->format('d-m-Y') }}</td>
                    <td>{{ $donasi->requestDonasi->organisasi->NAMA_ORGANISASI ?? '-' }}</td>
                    <td>{{ $donasi->NAMA_PENERIMA ?? '-' }}</td>
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