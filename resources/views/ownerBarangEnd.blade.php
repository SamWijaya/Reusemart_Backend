<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - ReuseMart</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        /* Header styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #18594a;
        }

        /* Sidebar styles */
        .sidebar {
            background-color: #18594a;
            color: white;
            min-height: calc(100vh - 76px);
            padding-top: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .sidebar-menu li:hover,
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

        /* Main content styles */
        .main-content {
            padding: 20px;
        }

        .content-section {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #18594a;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 24px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 12px;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 12px;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 8px 40px 8px 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .table-header {
            background-color: #18594a;
            color: white;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge-approved {
            background-color: #28a745;
        }

        .badge-rejected {
            background-color: #dc3545;
        }

        .badge-completed {
            background-color: #6c757d;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        .filter-select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <div class="nav-links">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <ul class="sidebar-menu">
                    <li data-section="requests">
                        <a href="{{ route('halamanOwner') }}">
                            <i class="fas fa-list"></i>
                            Request Donasi
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="{{ route('historyDonasi') }}">
                            <i class="fas fa-history"></i>
                            Laporan Donasi Barang
                        </a>
                    </li>
                    <li  data-section="history">
                        <a href="{{ route('penjualan.kategori') }}">
                            <i class="fas fa-history"></i>
                            Laporan Penjualan Per Kategori Barang
                        </a>
                    </li>
                    <li  class="active"data-section="history">
                        <a href="{{ route('penitipan.habis') }}">
                            <i class="fas fa-history"></i>
                            Laporan Barang Yang Masa Penitipannya Habis
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="{{ route('transaksi.penitip') }}">
                            <i class="fas fa-history"></i>
                            Laporan Transaksi Penitip
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="{{ route('laporan.perbulan') }}">
                            <i class="fas fa-history"></i>
                            Laporan Penjualan Bulanan
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="{{ route('komisi.perbulan') }}">
                            <i class="fas fa-history"></i>
                            Laporan Komisi Bulanan
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="{{ route('laporan.gudang') }}">
                            <i class="fas fa-history"></i>
                            Laporan Stok Gudang
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <!-- Request Donasi Section -->
                <div id="requestsSection" class="content-section">
                    <h2 class="section-title">Daftar Barang Yang Masa Penitipannya Habis</h2>

                    <!-- Tombol cetak -->
                    <div class="mb-3">
                        <a href="{{ route('barangEnd.cetak') }}" class="btn btn-primary" target="_blank">
                            Cetak Nota
                        </a>
                    </div>

                    <div class="table-responsive">
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
                                @foreach ($barangList as $barang)
                                    <tr>
                                        <td>{{ $barang->ID_BARANG }}</td>
                                        <td>{{ $barang->NAMA_BARANG }}</td>
                                        <td>{{ $barang->penitipan->ID_PENITIP }}</td>
                                        <td>{{ $barang->penitipan->penitip->NAMA_PENITIP }}</td>
                                        <td>{{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_PENITIPAN)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_BERAKHIR)->format('d-m-Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($barang->penitipan->BATAS_AMBIL)->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>