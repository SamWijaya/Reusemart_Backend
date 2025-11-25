<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Tambah Barang</title>
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

        .back-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #5a6268;
            color: white;
        }

        .page-title {
            color: #18594a;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .btn-add:hover {
            background-color: #218838;
            color: white;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            max-width: 400px;
        }

        .data-table {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #18594a;
            color: white;
            font-weight: 500;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #212529;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-tersedia {
            background-color: #d4edda;
            color: #155724;
        }

        .status-terjual {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-rusak {
            background-color: #fff3cd;
            color: #856404;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .modal-body .form-group {
            margin-bottom: 15px;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            border-radius: 4px;
            display: none;
        }

        .no-data-message {
            text-align: center;
            padding: 40px;
            font-style: italic;
            color: #777;
        }

        .image-preview-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .preview-wrapper {
            position: relative;
        }

        .remove-image {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }

        .price-display {
            font-weight: bold;
            color: #28a745;
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
                    <li>
                        <a href="{{ route('jadwal.ambil') }}" class="kelola-ambil">
                            <i class="fas fa-hand-holding"></i>
                            Kelola Jadwal Pengambilan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <a href="{{ route('penitip.detail', $penitipan->penitip->ID_PENITIP) }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>


                <h4 class="page-title" id="pageTitle">Tambah Barang Penitipan Milik
                    {{ $penitipan->penitip->NAMA_PENITIP }}
                </h4>

                <!-- Add Barang Button -->
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addBarangModal">
                    <i class="fas fa-plus me-2"></i>Tambah Barang
                </button>

                <!-- Search Container -->
                <div class="search-container">
                    <div class="input-group search-input">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchBarang"
                            placeholder="Cari barang berdasarkan nama, kategori, atau deskripsi...">
                    </div>
                </div>

                <!-- Tabel Barang -->
                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Berat</th>
                                <th>Garansi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barangTableBody">
                            @forelse ($barangList as $p)
                                <tr>
                                    <td>{{ $p->NAMA_BARANG }}</td>
                                    <td>{{ $p->KATEGORI_BARANG }}</td>
                                    <td>{{ $p->HARGA_BARANG }}</td>
                                    <td>{{ $p->BERAT }}</td>
                                    <td>{{ $p->GARANSI ? \Carbon\Carbon::parse($p->GARANSI)->format('Y-m-d') : '-' }}</td>
                                    <td>{{ $p->STATUS_BARANG }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning btn-edit" data-id="{{ $p->ID_BARANG }}"
                                            data-nama="{{ $p->NAMA_BARANG }}" data-kategori="{{ $p->KATEGORI_BARANG }}"
                                            data-harga="{{ $p->HARGA_BARANG }}" data-berat="{{ $p->BERAT }}"
                                            data-garansi="{{ $p->GARANSI ? \Carbon\Carbon::parse($p->GARANSI)->format('Y-m-d') : '' }}"
                                            data-deskripsi="{{ $p->DESKRIPSI_BARANG ?? '' }}"
                                            data-status="{{ $p->STATUS_BARANG ?? '' }}"
                                            data-gambar1="{{ asset('storage/' . $p->GAMBAR_1) }}"
                                            data-gambar2="{{ asset('storage/' . $p->GAMBAR_2) }}"
                                            data-gambar3="{{ asset('storage/' . $p->GAMBAR_3) }}" data-bs-toggle="modal"
                                            data-bs-target="#editBarangModal">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data penitipan barang</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Barang Modal -->
    <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="barangAddForm" action="{{ route('barang.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="ID_PENITIPAN" value="{{ $penitipan->ID_PENITIPAN }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaBarang" class="form-label">Nama Barang *</label>
                                    <input type="text" class="form-control" id="namaBarang" name="NAMA_BARANG" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hargaBarang" class="form-label">Harga Barang (Rp) *</label>
                                    <input type="number" class="form-control" id="hargaBarang" min="0"
                                        name="HARGA_BARANG" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategoriBarang" class="form-label">Kategori Barang *</label>
                                    <select class="form-control" id="kategoriBarang" name="KATEGORI_BARANG" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Elektronik & Gadget">Elektronik & Gadget</option>
                                        <option value="Pakaian & Aksesori">Pakaian & Aksesori</option>
                                        <option value="Perabotan Rumah Tangga">Perabotan Rumah Tangga</option>
                                        <option value="Buku, Alat Tulis, & Peralatan Sekolah">Buku, Alat Tulis, &
                                            Peralatan Sekolah</option>
                                        <option value="Hobi, Mainan, & Koleksi">Hobi, Mainan, & Koleksi</option>
                                        <option value="Perlengkapan Bayi & Anak">Perlengkapan Bayi & Anak</option>
                                        <option value="Otomotif & Aksesori">Otomotif & Aksesori</option>
                                        <option value="Perlengkapan Taman & Outdoor">Perlengkapan Taman & Outdoor
                                        </option>
                                        <option value="Peralatan Kantor & Industri">Peralatan Kantor & Industri</option>
                                        <option value="Kosmetik & Perawatan Diri">Kosmetik & Perawatan Diri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="beratBarang" class="form-label">Berat Barang (kg) *</label>
                                    <input type="number" class="form-control" id="beratBarang" min="0" step="0.1"
                                        name="BERAT" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsiBarang" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control" id="deskripsiBarang" rows="3"
                                placeholder="Masukkan deskripsi barang..." name="DESKRIPSI_BARANG"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="garansiBarang" class="form-label">Masa Berlaku Garansi</label>
                            <input type="date" class="form-control" id="garansiBarang" name="GARANSI">
                            <small class="form-text text-muted">Kosongkan jika barang tidak memiliki garansi</small>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thumbnailBarang" class="form-label">Gambar Thumbnail *</label>
                                    <input type="file" class="form-control" id="thumbnailBarang" accept="image/*"
                                        name="GAMBAR_1" required>
                                    <img id="thumbnailPreview" class="image-preview">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gambar1Barang" class="form-label">Gambar 1</label>
                                    <input type="file" class="form-control" id="gambar1Barang" accept="image/*"
                                        name="GAMBAR_2" required>
                                    <img id="gambar1Preview" class="image-preview">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gambar2Barang" class="form-label">Gambar 2</label>
                                    <input type="file" class="form-control" id="gambar2Barang" accept="image/*"
                                        name="GAMBAR_3" required>
                                    <img id="gambar2Preview" class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Barang Modal -->
    <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="barangEditForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label for="namaBarang" class="form-label">Nama Barang *</label>
                                <input type="text" class="form-control" id="namaBarang" name="NAMA_BARANG" required>
                            </div>
                            <div class="col-md-6">
                                <label for="hargaBarang" class="form-label">Harga Barang (Rp) *</label>
                                <input type="number" class="form-control" id="hargaBarang" min="0" name="HARGA_BARANG"
                                    required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="kategoriBarang" class="form-label">Kategori Barang *</label>
                                <select class="form-control" id="kategoriBarang" name="KATEGORI_BARANG" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Elektronik & Gadget">Elektronik & Gadget</option>
                                    <option value="Pakaian & Aksesori">Pakaian & Aksesori</option>
                                    <option value="Perabotan Rumah Tangga">Perabotan Rumah Tangga</option>
                                    <option value="Buku, Alat Tulis, & Peralatan Sekolah">Buku, Alat Tulis, & Peralatan
                                        Sekolah</option>
                                    <option value="Hobi, Mainan, & Koleksi">Hobi, Mainan, & Koleksi</option>
                                    <option value="Perlengkapan Bayi & Anak">Perlengkapan Bayi & Anak</option>
                                    <option value="Otomotif & Aksesori">Otomotif & Aksesori</option>
                                    <option value="Perlengkapan Taman & Outdoor">Perlengkapan Taman & Outdoor</option>
                                    <option value="Peralatan Kantor & Industri">Peralatan Kantor & Industri</option>
                                    <option value="Kosmetik & Perawatan Diri">Kosmetik & Perawatan Diri</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="beratBarang" class="form-label">Berat Barang (kg) *</label>
                                <input type="number" class="form-control" id="beratBarang" min="0" step="0.1"
                                    name="BERAT" required>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="deskripsiBarang" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control" id="deskripsiBarang" rows="3" name="DESKRIPSI_BARANG"
                                placeholder="Masukkan deskripsi barang..."></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="garansiBarang" class="form-label">Masa Berlaku Garansi</label>
                            <input type="date" class="form-control" id="garansiBarang" name="GARANSI">
                            <small class="form-text text-muted">Kosongkan jika barang tidak memiliki garansi</small>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="thumbnailBarang" class="form-label">Gambar Thumbnail *</label>
                                <input type="file" class="form-control" id="thumbnailBarang" accept="image/*"
                                    name="GAMBAR_1">
                                <img id="thumbnailPreview" class="image-preview mt-2"
                                    style="max-width: 100%; height: auto;">
                            </div>
                            <div class="col-md-4">
                                <label for="gambar1Barang" class="form-label">Gambar 1</label>
                                <input type="file" class="form-control" id="gambar1Barang" accept="image/*"
                                    name="GAMBAR_2">
                                <img id="gambar1Preview" class="image-preview mt-2"
                                    style="max-width: 100%; height: auto;">
                            </div>
                            <div class="col-md-4">
                                <label for="gambar2Barang" class="form-label">Gambar 2</label>
                                <input type="file" class="form-control" id="gambar2Barang" accept="image/*"
                                    name="GAMBAR_3">
                                <img id="gambar2Preview" class="image-preview mt-2"
                                    style="max-width: 100%; height: auto;">
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.btn-edit');
            const form = document.getElementById('barangEditForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const nama = this.dataset.nama;
                    const kategori = this.dataset.kategori;
                    const harga = this.dataset.harga;
                    const berat = this.dataset.berat;
                    const garansi = this.dataset.garansi;
                    const deskripsi = this.dataset.deskripsi;

                    const gambar1 = this.dataset.gambar1;
                    const gambar2 = this.dataset.gambar2;
                    const gambar3 = this.dataset.gambar3;

                    form.action = `/barang/update/${id}`;
                    form.querySelector('#namaBarang').value = nama;
                    form.querySelector('#kategoriBarang').value = kategori;
                    form.querySelector('#hargaBarang').value = harga;
                    form.querySelector('#beratBarang').value = berat;
                    form.querySelector('#garansiBarang').value = garansi;
                    form.querySelector('#deskripsiBarang').value = deskripsi;

                    // Set preview gambar jika ada
                    document.getElementById('thumbnailPreview').src = gambar1 || '';
                    document.getElementById('gambar1Preview').src = gambar2 || '';
                    document.getElementById('gambar2Preview').src = gambar3 || '';
                });
            });

            // Reset form edit saat modal ditutup
            document.getElementById('editBarangModal').addEventListener('hidden.bs.modal', function () {
                document.getElementById('barangEditForm').reset();
            });

            // Reset form tambah saat modal dibuka
            document.getElementById('tambahBarangModal').addEventListener('shown.bs.modal', function () {
                document.getElementById('barangAddForm').reset();
            });
        });
    </script>

</body>

</html>