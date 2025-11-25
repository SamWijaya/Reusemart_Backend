<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Kelola Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (jika belum) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


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

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data organisasi...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Nama Organisasi</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alamat Organisasi</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($organisasiList as $org)
                                <tr>
                                    <td>{{ $org->NAMA_ORGANISASI }}</td>
                                    <td>{{ $org->EMAIL_ORGANISASI }}</td>
                                    <td>{{ $org->ALAMAT_ORGANISASI }}</td>
                                    <td>{{ $org->NOTELP_ORGANISASI }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editModal{{ $org->ID_ORGANISASI }}">Edit</button>

                                        <!-- Tombol Hapus (dalam form) -->
                                        <form action="{{ route('organisasi.destroy', $org->ID_ORGANISASI) }}" method="POST"
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
                                <div class="modal fade" id="editModal{{ $org->ID_ORGANISASI }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $org->ID_ORGANISASI }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('organisasi.update', $org->ID_ORGANISASI) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $org->ID_ORGANISASI }}">
                                                        Edit Organisasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Tutup">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Organisasi</label>
                                                        <input type="text" name="NAMA_ORGANISASI"
                                                            value="{{ $org->NAMA_ORGANISASI }}" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email Organisasi</label>
                                                        <input type="email" name="EMAIL_ORGANISASI"
                                                            value="{{ $org->EMAIL_ORGANISASI }}" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="text" name="NOTELP_ORGANISASI"
                                                            value="{{ $org->NOTELP_ORGANISASI }}" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat Organisasi</label>
                                                        <textarea name="ALAMAT_ORGANISASI" class="form-control"
                                                            required>{{ $org->ALAMAT_ORGANISASI }}</textarea>
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
                                    <td colspan="5" class="text-center">Belum ada data organisasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script dimulai setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Array untuk menyimpan data organisasi
            let organizations = [];

            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const organizationTableBody = document.getElementById('organizationTableBody');
            const editOrganizationForm = document.getElementById('editOrganizationForm');
            const updateOrganizationBtn = document.getElementById('updateOrganization');
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


            // Inisialisasi modal
            const editModal = new bootstrap.Modal(document.getElementById('editOrganizationModal'));

            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (organizations.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan tabel organisasi
            function renderOrganizationTable() {
                // Kosongkan tbody terlebih dahulu
                organizationTableBody.innerHTML = '';

                // Tampilkan data organisasi
                organizations.forEach(function (organization, index) {
                    // Buat elemen baris baru
                    const row = document.createElement('tr');

                    // Tambahkan sel untuk setiap data
                    row.innerHTML = `
                        <td>${organization.name}</td>
                        <td>${organization.phone}</td>
                        <td>${organization.email}</td>
                        <td>${organization.address}</td>
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
                        organizations.splice(index, 1);
                        renderOrganizationTable();
                        updateTableVisibility();
                    });

                    // Tambahkan baris ke dalam tabel
                    organizationTableBody.appendChild(row);
                });

                // Perbarui visibilitas tabel
                updateTableVisibility();
            }

            // Fungsi untuk membuka modal edit
            function openEditModal(index) {
                const organization = organizations[index];

                // Isi form dengan data organisasi yang dipilih
                document.getElementById('editOrganizationIndex').value = index;
                document.getElementById('editOrgName').value = organization.name;
                document.getElementById('editOrgPhone').value = organization.phone;
                document.getElementById('editOrgEmail').value = organization.email;
                document.getElementById('editOrgAddress').value = organization.address;

                // Tampilkan modal edit
                editModal.show();
            }

            // Inisialisasi visibilitas tabel
            updateTableVisibility();



            // Event listener untuk tombol update di modal edit
            updateOrganizationBtn.addEventListener('click', function () {
                // Validasi form
                if (!editOrganizationForm.checkValidity()) {
                    editOrganizationForm.reportValidity();
                    return;
                }

                // Ambil index organisasi yang sedang diedit
                const index = document.getElementById('editOrganizationIndex').value;

                // Update data organisasi
                organizations[index].name = document.getElementById('editOrgName').value;
                organizations[index].phone = document.getElementById('editOrgPhone').value;
                organizations[index].email = document.getElementById('editOrgEmail').value;
                organizations[index].address = document.getElementById('editOrgAddress').value;

                // Tutup modal
                editModal.hide();

                // Tampilkan data yang diperbarui di tabel
                renderOrganizationTable();
            });

            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                const rows = organizationTableBody.querySelectorAll('tr');

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