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
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    <i class="fas fa-plus"></i> Tambah Pegawai
                </button>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data pegawai...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!isset($pegawaiList))
                                <div style="color: red;">Variabel pegawaiList tidak tersedia</div>
                            @endif

                            @forelse ($pegawaiList as $org)
                                        <tr>
                                            <td>{{ $org->NAMA_PEGAWAI }}</td>
                                            <td>{{ $org->EMAIL_PEGAWAI }}</td>
                                            <td>{{ $org->NOTELP_PEGAWAI }}</td>
                                            <td>{{ $org->jabatan->NAMA_JABATAN }}</td>
                                            <td>{{ $org->TGL_LAHIR }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $org->ID_PEGAWAI }}">Edit</button>

                                                <!-- Tombol Hapus (dalam form) -->
                                                <form action="{{ route('pegawai.destroy', $org->ID_PEGAWAI) }}" method="POST"
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
                                        <div class="modal fade" id="editModal{{ $org->ID_PEGAWAI }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editModalLabel{{ $org->ID_PEGAWAI }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form method="POST" action="{{ route('pegawai.update', $org->ID_PEGAWAI) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $org->ID_PEGAWAI }}">Edit
                                                                Pegawai</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Tutup">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Nama Pegawai</label>
                                                                <input type="text" name="NAMA_PEGAWAI"
                                                                    value="{{ $org->NAMA_PEGAWAI }}" class="form-control" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Email Pegawai</label>
                                                                <input type="email" name="EMAIL_PEGAWAI"
                                                                    value="{{ $org->EMAIL_PEGAWAI }}" class="form-control" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Nomor Telepon</label>
                                                                <input type="text" name="NOTELP_PEGAWAI"
                                                                    value="{{ $org->NOTELP_PEGAWAI }}" class="form-control"
                                                                    required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
                                                                <input type="date" name="TGL_LAHIR" value="{{ $org->TGL_LAHIR }}"
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Jabatan</label>
                                                                <select name="ID_JABATAN" class="form-control" required>
                                                                    @foreach ($jabatanList as $jabatan)
                                                                        <option value="{{ $jabatan->ID_JABATAN }}"
                                                                            {{ $jabatan->ID_JABATAN == $org->ID_JABATAN ? 'selected' : '' }}>
                                                                            {{ $jabatan->NAMA_JABATAN }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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
                                    <td colspan="5" class="text-center">Belum ada data pegawai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addEmployeeForm" action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Tambah Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="NAMA_PEGAWAI" class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" name="NAMA_PEGAWAI" id="NAMA_PEGAWAI" required>
                        </div>
                        <div class="mb-3">
                            <label for="EMAIL_PEGAWAI" class="form-label">Email</label>
                            <input type="email" class="form-control" name="EMAIL_PEGAWAI" id="EMAIL_PEGAWAI" required>
                        </div>
                        <div class="mb-3">
                            <label for="NOTELP_PEGAWAI" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" name="NOTELP_PEGAWAI" id="NOTELP_PEGAWAI" required>
                        </div>
                        <div class="mb-3">
                            <label for="ID_JABATAN" class="form-label">Jabatan</label>
                            <select name="ID_JABATAN">
                                <option disabled selected>Pilih Jabatan</option>
                                @foreach ($jabatanList as $jabatan)
                                    <option value="{{ $jabatan->ID_JABATAN }}">{{ $jabatan->NAMA_JABATAN }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="TGL_LAHIR" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="TGL_LAHIR" id="TGL_LAHIR" required>
                        </div>
                        <div class="mb-3">
                            <label for="PASSWORD_PEGAWAI" class="form-label">Password</label>
                            <input type="password" class="form-control" name="PASSWORD_PEGAWAI" id="PASSWORD_PEGAWAI"
                                required>
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
            // Array untuk menyimpan data pegawai
            let employees = [];

            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const employeeTableBody = document.getElementById('employeeTableBody');
            const addEmployeeForm = document.getElementById('addEmployeeForm');
            const editEmployeeForm = document.getElementById('editEmployeeForm');
            const saveEmployeeBtn = document.getElementById('saveEmployee');
            const updateEmployeeBtn = document.getElementById('updateEmployee');
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
            const addModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'));
            const editModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));

            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (employees.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan tabel pegawai


            // Fungsi untuk membuka modal edit
            function openEditModal(index) {
                const employee = employees[index];

                // Isi form dengan data pegawai yang dipilih
                document.getElementById('editEmployeeIndex').value = index;
                document.getElementById('editName').value = employee.name;
                document.getElementById('editEmail').value = employee.email;
                document.getElementById('editPhone').value = employee.phone;
                document.getElementById('editPosition').value = employee.position;
                document.getElementById('editBirthdate').value = employee.birthdate;

                // Tampilkan modal edit
                editModal.show();
            }

            // Inisialisasi visibilitas tabel
            updateTableVisibility();

            // Event listener untuk tombol simpan di modal tambah
            saveEmployeeBtn.addEventListener('click', function () {
                // Validasi form
                if (!addEmployeeForm.checkValidity()) {
                    addEmployeeForm.reportValidity();
                    return;
                }

                // Ambil data dari form
                const formData = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    position: document.getElementById('position').value,
                    birthdate: document.getElementById('birthdate').value,
                    password: document.getElementById('password').value
                };

                // Tambahkan data ke array pegawai
                employees.push(formData);

                // Reset form dan tutup modal
                addEmployeeForm.reset();
                addModal.hide();

                // Tampilkan data di tabel
                renderEmployeeTable();
            });

            // Event listener untuk tombol update di modal edit
            updateEmployeeBtn.addEventListener('click', function () {
                // Validasi form
                if (!editEmployeeForm.checkValidity()) {
                    editEmployeeForm.reportValidity();
                    return;
                }

                // Ambil index pegawai yang sedang diedit
                const index = document.getElementById('editEmployeeIndex').value;

                // Update data pegawai
                employees[index].name = document.getElementById('editName').value;
                employees[index].email = document.getElementById('editEmail').value;
                employees[index].phone = document.getElementById('editPhone').value;
                employees[index].position = document.getElementById('editPosition').value;
                employees[index].birthdate = document.getElementById('editBirthdate').value;

                // Tutup modal
                editModal.hide();

                // Tampilkan data yang diperbarui di tabel
                renderEmployeeTable();
            });

            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                const rows = employeeTableBody.querySelectorAll('tr');

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