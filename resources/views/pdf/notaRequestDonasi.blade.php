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

        <p><strong>LAPORAN REQUEST DONASI</strong><br>
            Tanggal cetak: {{ $tanggalCetak }}</p>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="table-header">
                <th scope="col">ID Organisasi</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Request</th>
            </tr>
        </thead>
        <tbody id="requestsTableBody">
            @forelse ($reqList as $req)
                <tr>
                    <td>{{ $req->ID_ORGANISASI }}</td>
                    <td>{{ $req->organisasi->NAMA_ORGANISASI }}</td>
                    <td>{{ $req->organisasi->ALAMAT_ORGANISASI }}</td>
                    <td>{{ $req->DESKRIPSI_REQUEST }}</td>
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