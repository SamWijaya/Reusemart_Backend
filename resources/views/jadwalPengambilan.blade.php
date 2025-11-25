<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Pegawai Gudang Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        /* Header styles */
        header {
            background-color: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo img {
            height: 40px;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 18px;
        }

        .sidebar {
            background-color: #18594a;
            color: white;
            min-height: calc(100vh - 56px);
            padding-top: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 15px 20px;
        }

        .sidebar-menu li:hover {
            background-color: #124035;
        }

        .sidebar-menu li.active {
            background-color: #124035;
        }

        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 20px;
        }

        .main-content {
            padding: 20px;
        }

        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: left;
        }

        .search-box {
            width: 400px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 8px 40px 8px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .data-table {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
        }

        .table-header {
            background-color: #18594a;
            color: white;
            font-weight: 500;
        }

        .btn-detail {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-detail:hover {
            background-color: #2980b9;
            color: white;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('halamanGudang') }}" class="kelola-penitipan">
                            <i class="fas fa-box"></i>
                            Kelola Penitipan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jadwal.kirim') }}" class="kelola-pengiriman">
                            <i class="fas fa-truck"></i>
                            Kelola Jadwal Pengiriman
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('jadwal.ambil') }}" class="kelola-ambil">
                            <i class="fas fa-hand-holding"></i>
                            Kelola Jadwal Pengambilan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h4 class="mb-3">Kelola Pengambilan</h4>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">ID Pembelian</th>
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Total Pembelian</th>
                                <th scope="col">Batas Pengambilan</th>
                                <th scope="col">Tanggal Diambil</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            @forelse ($pembelianList as $p)
                                <tr>
                                    <td>#PB000{{ $p->ID_PEMBELIAN }}</td>
                                    <td>{{ $p->pembeli->NAMA_PEMBELI }}</td>
                                    <td>{{ $p->TANGGAL_PEMBELIAN }}</td>
                                    <td>Rp{{ number_format($p->TOTAL_BAYAR, 0, ',', '.') }}</td>
                                    <td>{{ $p->BATAS_PENGAMBILAN ?? '-' }}</td>
                                    <td>{{ $p->TANGGAL_DITERIMA ?? '-' }}</td>
                                    <td>
                                        @if ($p->STATUS_PEMBAYARAN == 'hangus')
                                            <!-- Status Hangus -->
                                            <span class="badge bg-light text-danger border border-danger px-3 py-2"
                                                style="font-size: 0.9rem;">
                                                Hangus
                                            </span>

                                        @elseif (!$p->BATAS_PENGAMBILAN)
                                            <!-- Tombol Jadwalkan -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#jadwalModal" data-id="{{ $p->ID_PEMBELIAN }}"
                                                data-nama="{{ $p->pembeli->NAMA_PEMBELI }}">
                                                Jadwalkan Pengambilan
                                            </button>

                                        @elseif (!$p->TANGGAL_DITERIMA)
                                            <!-- Tombol Konfirmasi -->
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#konfirmasiModal" data-id="{{ $p->ID_PEMBELIAN }}"
                                                data-nama="{{ $p->pembeli->NAMA_PEMBELI }}">
                                                Konfirmasi Pengambilan
                                            </button>

                                        @else
                                            <!-- Sudah Diambil -->
                                            <span class="badge bg-light text-success border border-success px-3 py-2"
                                                style="font-size: 0.9rem;">
                                                Sudah Diambil
                                            </span>
                                        @endif

                                        @if ($p->TANGGAL_DITERIMA)
                                            <!-- Cetak Nota -->
                                            <a href="{{ route('pembelian.cetak', $p->ID_PEMBELIAN) }}"
                                                class="btn btn-sm btn-success" target="_blank">
                                                Cetak Nota
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data Pembelian</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="jadwalModal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('jadwal.pengambilan') }}">
                @csrf
                <input type="hidden" name="ID_PEMBELIAN" id="id_pembelian">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Jadwal Pengambilan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Jadwalkan pengambilan untuk <strong id="nama_pembeli"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ya, Jadwalkan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Pengambilan -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="formKonfirmasi" action="">
                @csrf
                <input type="hidden" name="ID_PEMBELIAN" id="confirmID">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Pengambilan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin pembeli <strong id="confirmNama"></strong> telah mengambil barangnya?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Ya, Konfirmasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const konfirmasiModal = document.getElementById('konfirmasiModal');
        konfirmasiModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            // Set isi teks di modal
            konfirmasiModal.querySelector('#confirmNama').textContent = nama;
            konfirmasiModal.querySelector('#confirmID').value = id;

            // Update form action
            const form = konfirmasiModal.querySelector('#formKonfirmasi');
            form.action = `/pembelian/konfirmasi/${id}`;
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('.search-input');
            const rows = document.querySelectorAll('#itemTableBody tr');

            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                rows.forEach(function (row) {
                    const ownerName = row.querySelector('td:first-child').textContent.toLowerCase();
                    row.style.display = ownerName.includes(searchText) ? '' : 'none';
                });
            });
        });

        const jadwalModal = document.getElementById('jadwalModal');
        jadwalModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            document.getElementById('id_pembelian').value = id;
            document.getElementById('nama_pembeli').innerText = nama;
        });
    </script>
</body>

</html>