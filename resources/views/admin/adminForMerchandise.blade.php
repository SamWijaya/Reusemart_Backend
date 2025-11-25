<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Admin Dashboard</title>
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

        .btn-add {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
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

        .table td {
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .modal-header {
            background-color: #18594a;
            color: white;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .merchandise-img-wrapper {
            width: 80px;
            height: 80px;
            overflow: hidden;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .merchandise-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .img-preview {
            width: 100%;
            height: 150px;
            border: 1px dashed #ccc;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .img-preview img {
            max-width: 100%;
            max-height: 100%;
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
                        <a href="/admin/adminForJabatan" class="admin-jabatan">
                            <i class="fas fa-users"></i>
                            Data Jabatan
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForPegawai" class="admin-pegawai">
                            <i class="fas fa-user"></i>
                            Data Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForOrganisasi" class="admin-organisasi">
                            <i class="fas fa-building"></i>
                            Data Organisasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('merch.index') }}" class="admin-merchandise">
                            <i class="fas fa-gift"></i>
                            Data Merchandise
                        </a>
                    </li>

                    <li>
                        <a href="/admin/adminForReset" class="admin-reset">
                            <i class="fas fa-key"></i>
                            Reset Password
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addMerchandiseModal">
                    <i class="fas fa-plus"></i> Tambah Merchandise
                </button>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data merchandise...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Merchandise</th>
                                <th scope="col">Stok Merchandise</th>
                                <th scope="col">Poin Diperlukan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="merchandiseTableBody">
                            @foreach ($merchList as $m)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $m->GAMBAR_MERCHANDISE) }}" alt="gambar" width="60"></td>
                                    <td>{{ $m->NAMA_MERCHANDISE }}</td>
                                    <td>{{ $m->STOK_MERCHANDISE }}</td>
                                    <td>{{ $m->POIN_DIPERLUKAN }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
<!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm editBtn" data-id="{{ $m->ID_MERCHANDISE }}"
                                            data-nama="{{ $m->NAMA_MERCHANDISE }}" data-stok="{{ $m->STOK_MERCHANDISE }}"
                                            data-poin="{{ $m->POIN_DIPERLUKAN }}" data-bs-toggle="modal"
                                            data-bs-target="#editMerchandiseModal">
                                            Edit
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('merchandise.destroy', $m->ID_MERCHANDISE) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus merchandise ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addMerchandiseModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('merchandise.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Merchandise</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="NAMA_MERCHANDISE" class="form-control mb-2"
                            placeholder="Nama Merchandise" required>
                        <input type="number" name="STOK_MERCHANDISE" class="form-control mb-2" placeholder="Stok" required>
                        <input type="number" name="POIN_DIPERLUKAN" class="form-control mb-2" placeholder="Poin" required>
                        <input type="file" name="GAMBAR_MERCHANDISE" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editMerchandiseModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Merchandise</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="NAMA_MERCHANDISE" id="editNama" class="form-control mb-2" required>
                        <input type="number" name="STOK_MERCHANDISE" id="editStok" class="form-control mb-2" required>
                        <input type="number" name="POIN_DIPERLUKAN" id="editPoin" class="form-control mb-2" required>
                        <input type="file" name="GAMBAR_MERCHANDISE" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const stok = this.dataset.stok;
                const poin = this.dataset.poin;

                document.getElementById('editNama').value = nama;
                document.getElementById('editStok').value = stok;
                document.getElementById('editPoin').value = poin;
                document.getElementById('editForm').action = '/merchandise-edit/' + id;
            });
        });
    </script>

    <script>
        // Script dimulai setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('.search-input');
    const tableBody = document.getElementById('merchandiseTableBody');

    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].textContent.toLowerCase();
            if (rowText.indexOf(filter) > -1) {
                rows[i].style.display = ''; // tampilkan baris
            } else {
                rows[i].style.display = 'none'; // sembunyikan baris
            }
        }
    });
        });
    </script>
</body>

</html>