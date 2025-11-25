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
                    <li class="active">
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
                    <li >
                        <a href="{{ route('jadwal.ambil') }}" class="kelola-ambil">
                            <i class="fas fa-hand-holding"></i>
                            Kelola Jadwal Pengambilan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h4 class="mb-3">Kelola Penitipan Barang</h4>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari nama penitip...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Nama Penitip</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            @forelse ($penitip as $p)
                                <tr>
                                    <td>{{ $p->NAMA_PENITIP }}</td>
                                    <td>{{ $p->NOTELP_PENITIP }}</td>
                                    <td>{{ $p->EMAIL_PENITIP }}</td>
                                    <td>
                                        <a href="{{ route('penitip.detail', $p->ID_PENITIP) }}" class="btn btn-detail">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail Penitipan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data penitipan barang</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="noDataMessage" class="no-data-message d-none">Belum ada data penitipan barang</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>

</html>