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
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addPositionModal">
                    <i class="fas fa-plus"></i> Tambah Jabatan
                </button>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data jabatan...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Nama Jabatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jabatanList as $org)
                                <tr>
                                    <td>{{ $org->NAMA_JABATAN }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $org->ID_JABATAN }}">Edit</button>

                                        <!-- Tombol Hapus (dalam form) -->
                                        <form action="{{ route('jabatan.destroy', $org->ID_JABATAN) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $org->ID_JABATAN }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $org->ID_JABATAN }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('jabatan.update', $org->ID_JABATAN) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $org->ID_JABATAN }}">
                                                        Edit Jabatan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Tutup">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Jabatan</label>
                                                        <input type="text" name="NAMA_JABATAN"
                                                            value="{{ $org->NAMA_JABATAN }}" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data jabatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Position Modal -->
    <div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addPositionForm" action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPositionModalLabel">Tambah Data Jabatan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="positionName" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="positionName" name="NAMA_JABATAN" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script dimulai setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Array untuk menyimpan data jabatan
            let positions = [];

            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const positionTableBody = document.getElementById('positionTableBody');
            const addPositionForm = document.getElementById('addPositionForm');
            const editPositionForm = document.getElementById('editPositionForm');
            const savePositionBtn = document.getElementById('savePosition');
            const updatePositionBtn = document.getElementById('updatePosition');
            const searchInput = document.querySelector('.search-input');

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();

                // Ambil semua baris pada tbody
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    // Tampilkan baris jika mengandung kata kunci, sembunyikan jika tidak
                    if (rowText.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Inisialisasi modals
            const addModal = new bootstrap.Modal(document.getElementById('addPositionModal'));
            const editModal = new bootstrap.Modal(document.getElementById('editPositionModal'));

            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (positions.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan tabel jabatan
            function renderPositionTable() {
                // Kosongkan tbody terlebih dahulu
                positionTableBody.innerHTML = '';

                // Tampilkan data jabatan
                positions.forEach(function (position, index) {
                    // Buat elemen baris baru
                    const row = document.createElement('tr');

                    // Tambahkan sel untuk setiap data
                    row.innerHTML = `
                        <td>${position.name}</td>
                        <td>
                            <button class="btn btn-edit me-2"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-delete"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    `;

                    // Tambahkan event listener untuk tombol edit
                    const editButton = row.querySelector('.btn-edit');
                    editButton.addEventListener('click', function () {
                        openEditModal(index);
                    });

                    // Tambahkan event listener untuk tombol delete
                    const deleteButton = row.querySelector('.btn-delete');
                    deleteButton.addEventListener('click', function () {
                        positions.splice(index, 1);
                        renderPositionTable();
                        updateTableVisibility();
                    });

                    // Tambahkan baris ke dalam tabel
                    positionTableBody.appendChild(row);
                });

                // Perbarui visibilitas tabel
                updateTableVisibility();
            }

            // Fungsi untuk membuka modal edit
            function openEditModal(index) {
                const position = positions[index];

                // Isi form dengan data jabatan yang dipilih
                document.getElementById('editPositionIndex').value = index;
                document.getElementById('editPositionName').value = position.name;

                // Tampilkan modal edit
                editModal.show();
            }

            // Inisialisasi visibilitas tabel
            updateTableVisibility();

            // Event listener untuk tombol simpan di modal tambah
            savePositionBtn.addEventListener('click', function () {
                // Validasi form
                if (!addPositionForm.checkValidity()) {
                    addPositionForm.reportValidity();
                    return;
                }

                // Ambil data dari form
                const formData = {
                    name: document.getElementById('positionName').value
                };

                // Tambahkan data ke array jabatan
                positions.push(formData);

                // Reset form dan tutup modal
                addPositionForm.reset();
                addModal.hide();

                // Tampilkan data di tabel
                renderPositionTable();
            });

            // Event listener untuk tombol update di modal edit
            updatePositionBtn.addEventListener('click', function () {
                // Validasi form
                if (!editPositionForm.checkValidity()) {
                    editPositionForm.reportValidity();
                    return;
                }

                // Ambil index jabatan yang sedang diedit
                const index = document.getElementById('editPositionIndex').value;

                // Update data jabatan
                positions[index].name = document.getElementById('editPositionName').value;

                // Tutup modal
                editModal.hide();

                // Tampilkan data yang diperbarui di tabel
                renderPositionTable();
            });

            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                const rows = positionTableBody.querySelectorAll('tr');

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    if (text.indexOf(searchText) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>