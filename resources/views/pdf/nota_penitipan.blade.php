<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Penitipan</title>
    <style>
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
            color: #000;
            max-width: 400px;
            margin: auto;
        }

        .header {
            text-align: center;
        }

        .header h2,
        .header p {
            margin: 0;
            padding: 2px 0;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .section {
            margin-bottom: 10px;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            padding: 4px 2px;
            border-bottom: 1px dashed #ccc;
            text-align: left;
        }

        th {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .total {
            font-weight: bold;
            padding-top: 5px;
            border-top: 1px dashed black;
        }

        small {
            display: block;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>ReUseMart</h2>
        <p>Jl. Green Eco Park No. 456</p>
        <p>Yogyakarta</p>
    </div>

    <div class="line"></div>

    <div class="section">
        <p><span class="bold">No Nota:</span> {{ $penitipan->ID_PENITIPAN }}</p>
        <p><span class="bold">Tanggal Penitipan:</span> {{ \Carbon\Carbon::parse($penitipan->TANGGAL_PENITIPAN)->format('d/m/Y H:i') }}</p>
        <p><span class="bold">Masa penitipan sampai:</span> {{ \Carbon\Carbon::parse($penitipan->TANGGAL_BERAKHIR)->format('d/m/Y') }}</p>
        <p><span class="bold">Penitip:</span> {{ $penitipan->penitip->ID_PENITIP }} / {{ $penitipan->penitip->NAMA_PENITIP }}</p>
    </div>

    <div class="line"></div>

    <div class="section">
        <p class="bold">Barang Dititipkan:</p>
        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Berat</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $totalHarga = 0; @endphp
                @foreach ($barangList as $barang)
                    <tr>
                        <td>
                            {{ $barang->NAMA_BARANG }}
                            @if (!empty($barang->KETERANGAN))
                                <small>{{ $barang->KETERANGAN }}</small>
                            @endif
                        </td>
                        <td>{{ $barang->BERAT }}kg</td>
                        <td>Rp{{ number_format($barang->HARGA_BARANG, 0, ',', '.') }}</td>
                    </tr>
                    @php $totalHarga += $barang->HARGA_BARANG; @endphp
                @endforeach
            </tbody>
        </table>
        <p class="total right">Total: Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
    </div>

    <div class="line"></div>

    <div class="section">
        <p><span class="bold">Diterima oleh:</span></p>
        <p>{{ $penitipan->pegawai->ID_PEGAWAI }} - {{ $penitipan->pegawai->NAMA_PEGAWAI }}</p>
    </div>

    <div class="line"></div>

</body>

</html>
