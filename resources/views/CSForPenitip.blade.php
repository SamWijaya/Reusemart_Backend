<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - CS (Kelola Penitip)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        /* Header styles (same as previous file) */
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
            position: absolute;
            top: 80px;
            right: 30px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-add:hover {
            background-color: black;
            color: white;
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

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .ktp-thumbnail {
            max-width: 100px;
            max-height: 100px;
            cursor: pointer;
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
                        <a href="/csForPenitip" class="cs-penitip">
                            <i class="fas fa-users"></i>
                            Data Penitip
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cs.verif') }}" class="cs-pembayaran">
                            <i class="fas fa-money-check"></i>
                            Verifikasi Pembayaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penukaran.list') }}" class="cs-merchandise">
                            <i class="fas fa-gift"></i>
                            List Penukaran Merchandise
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cs.diskusi.index') }}" >
                            <i class="fas fa-comments"></i> Diskusi Produk
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <!-- Tombol Tambah -->
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addPenitipModal">
                    <i class="fas fa-plus"></i> Tambah Penitip
                </button>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data penitip...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Penitip</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>NIK</th>
                                <th>Scan KTP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penitips as $penitip)
                                <tr>
                                    <td>{{ $penitip->NAMA_PENITIP }}</td>
                                    <td>{{ $penitip->EMAIL_PENITIP }}</td>
                                    <td>{{ $penitip->ALAMAT_PENITIP }}</td>
                                    <td>{{ $penitip->NOTELP_PENITIP }}</td>
                                    <td>{{ $penitip->NIK }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $penitip->SCAN_KTP) }}" target="_blank">Lihat</a>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $penitip->ID_PENITIP }}">Edit</button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('penitip.destroy', $penitip->ID_PENITIP) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editModal{{ $penitip->ID_PENITIP }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('penitip.update', $penitip->ID_PENITIP) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Penitip</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Nama Penitip</label>
                                                        <input type="text" class="form-control" name="NAMA_PENITIP"
                                                            value="{{ $penitip->NAMA_PENITIP }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="EMAIL_PENITIP"
                                                            value="{{ $penitip->EMAIL_PENITIP }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" name="ALAMAT_PENITIP"
                                                            value="{{ $penitip->ALAMAT_PENITIP }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nomor Telepon</label>
                                                        <input type="text" class="form-control" name="NOTELP_PENITIP"
                                                            value="{{ $penitip->NOTELP_PENITIP }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>NIK</label>
                                                        <input type="text" class="form-control" name="NIK"
                                                            value="{{ $penitip->NIK }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data penitip.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Penitip Modal -->
    <div class="modal fade" id="addPenitipModal" tabindex="-1" aria-labelledby="addPenitipModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addPenitipForm" action="{{ route('penitip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPenitipModalLabel">Tambah Data Penitip</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaPenitip" class="form-label">Nama Penitip</label>
                            <input type="text" class="form-control" id="namaPenitip" name="NAMA_PENITIP" required>
                        </div>
                        <div class="mb-3">
                            <label for="emailPenitip" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailPenitip" name="EMAIL_PENITIP" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamatPenitip" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamatPenitip" name="ALAMAT_PENITIP" required>
                        </div>
                        <div class="mb-3">
                            <label for="notelpPenitip" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="notelpPenitip" name="NOTELP_PENITIP" required>
                        </div>
                        <div class="mb-3">
                            <label for="nikPenitip" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nikPenitip" name="NIK" required>
                        </div>
                        <div class="mb-3">
                            <label for="scanKTP" class="form-label">Scan KTP</label>
                            <input type="file" class="form-control" id="scanKTP" name="SCAN_KTP" accept="image/*"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="passwordPenitip" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordPenitip" name="PASSWORD_PENITIP"
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
            // Array untuk menyimpan data penitip
            let penitips = [];

            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const penitipTableBody = document.getElementById('penitipTableBody');
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

            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (penitips.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan tabel penitip
            function renderPenitipTable() {
                // Kosongkan tbody terlebih dahulu
                penitipTableBody.innerHTML = '';

                // Tampilkan data penitip
                penitips.forEach(function (penitip) {
                    // Buat elemen baris baru
                    const row = document.createElement('tr');

                    // Tambahkan sel untuk setiap data
                    row.innerHTML = `
                        <td>${penitip.nama}</td>
                        <td>${penitip.email}</td>
                        <td>${penitip.alamat}</td>
                        <td>${penitip.nik}</td>
                        <td>
                            <img src="${penitip.scanKTP}" alt="KTP" class="ktp-thumbnail" 
                                onclick="window.open('${penitip.scanKTP}', '_blank')">
                        </td>
                        <td>${penitip.statusTopSeller ? 'Ya' : 'Tidak'}</td>
                        <td>Rp ${penitip.saldoPenitip.toLocaleString()}</td>
                    `;

                    // Tambahkan baris ke dalam tabel
                    penitipTableBody.appendChild(row);
                });

                // Perbarui visibilitas tabel
                updateTableVisibility();
            }

            // Inisialisasi visibilitas tabel
            updateTableVisibility();

            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                const rows = penitipTableBody.querySelectorAll('tr');

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    if (text.indexOf(searchText) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Handle the submit of the form to add penitip
            document.getElementById('addPenitipForm').addEventListener('submit', function (event) {
                event.preventDefault();

                // Collect form data
                const nama = document.getElementById('namaPenitip').value;
                const email = document.getElementById('emailPenitip').value;
                const alamat = document.getElementById('alamatPenitip').value;
                const nik = document.getElementById('nikPenitip').value;
                const scanKTP = URL.createObjectURL(document.getElementById('scanKTP').files[0]);
                const password = document.getElementById('passwordPenitip').value;

                // Create new penitip object and add it to the array
                const newPenitip = {
                    nama,
                    email,
                    alamat,
                    nik,
                    scanKTP,
                    statusTopSeller: false,
                    saldoPenitip: 0
                };
                penitips.push(newPenitip);

                // Clear the form
                this.reset();

                // Hide the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addPenitipModal'));
                modal.hide();

                // Re-render the table
                renderPenitipTable();
            });
            renderPenitipTable();
        });
    </script>
</body>

</html>