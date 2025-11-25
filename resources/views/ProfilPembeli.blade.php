<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembeli - ReuseMart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: #334155;
        }

        /* Header styles */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: #0f172a;
        }

        .logo img {
            height: 45px;
            border-radius: 8px;
        }

        nav {
            display: flex;
            gap: 32px;
        }

        nav a {
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        nav a:hover {
            color: #0f172a;
            background: rgba(15, 23, 42, 0.05);
            transform: translateY(-1px);
        }

        nav a.active {
            color: #0D5C4F;
            background: rgba(13, 92, 79, 0.1);
        }

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 18px;
        }

        /* Grid Layout */
        .profile-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }

        .card-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        /* Profile Form */
        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            color: #374151;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #0f766e;
            background: white;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .form-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
            margin-top: 12px;
        }

        /* Reward Card */
        .reward-card {
            text-align: center;
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .reward-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(180deg);
            }
        }

        .reward-content {
            position: relative;
            z-index: 2;
        }

        .reward-points {
            font-size: 70px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .reward-label {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 24px;
        }

        .reward-btn {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(243, 156, 18, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .reward-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .reward-description {
            font-size: 16px;
            color: rgb(255, 255, 255);
            margin-top: 30px;
            line-height: 1.6;
        }

        /* Address Section - FIXED: Proper container structure */
        .address-section {
            margin-top: 32px;
        }

        .address-card {
            /* Remove grid-column: 1 / -1; since it's now outside the grid */
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .search-container {
            position: relative;
            margin-bottom: 24px;
        }

        .search-input {
            width: 100%;
            padding: 16px 20px 16px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #0f766e;
            background: white;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .add-address-btn {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(15, 118, 110, 0.3);
        }

        .add-address-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(15, 118, 110, 0.4);
        }

        /* Address List */
        .address-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            max-height: 400px;
            overflow-y: auto;
        }

        .address-item {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .address-item:hover {
            border-color: #0f766e;
            background: white;
        }

        .address-text {
            flex: 1;
            background: transparent;
            border: none;
            font-size: 14px;
            color: #64748b;
            padding: 0;
            margin: 0;
            outline: none;
            resize: none;
            line-height: 1.5;
        }

        .address-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .address-set-primary {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-set-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
        }

        .btn-edit,
        .btn-delete {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #374151;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 32px;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f1f5f9;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }

        .close-modal {
            width: 40px;
            height: 40px;
            border: none;
            background: #f1f5f9;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: #e2e8f0;
            color: #374151;
        }

        .modal-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        /* Input khusus untuk modal tanpa padding kiri berlebih */
        .modal-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            color: #374151;
            background: #f9fafb;
            transition: all 0.3s ease;
        }

        .modal-input:focus {
            outline: none;
            border-color: #0f766e;
            background: white;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid #f1f5f9;
        }

        .modal-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-btn {
            background: #f1f5f9;
            color: #64748b;
        }

        .cancel-btn:hover {
            background: #e2e8f0;
        }

        .save-btn {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(15, 118, 110, 0.3);
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(15, 118, 110, 0.4);
        }

        .alamat-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        .alamat-table th,
        .alamat-table td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .alamat-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .action-btn {
            padding: 5px 10px;
            border: none;
            margin: 2px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }

        .edit-btn {
            background-color: #007bff;
            color: white;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .default-btn {
            background-color: #6c757d;
            color: white;
        }

        .default-badge {
            background-color: #28a745;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 0.9em;
        }

        .inline-form {
            display: inline;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 0 16px;
                margin: 24px auto;
            }

            .profile-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .card {
                padding: 24px;
            }

            .page-title {
                font-size: 28px;
            }

            header {
                padding: 12px 16px;
                flex-direction: column;
                gap: 16px;
            }

            nav {
                gap: 20px;
            }

            .modal-content {
                width: 95%;
                padding: 24px;
            }

            .modal-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="/halamanPembeli">Beranda</a>
            <a href="/keranjang">Keranjang</a>
            <a href="{{ route('histori.pembelian') }}">History</a>
            <a href="/profilPembeli" class="active">Profil Akun</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Profil Pembeli</h1>
            <p class="page-subtitle">Kelola alamat untuk pengiriman barang impian Anda</p>
        </div>

        <div class="profile-grid">
            <!-- Profile Card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 class="card-title">Informasi Profil</h2>
                </div>

                <div class="profile-form">
                    <div class="form-group">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <div class="form-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" id="nama" class="form-input" value="{{ $pembeli->NAMA_PEMBELI }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="telepon">Nomor Telepon</label>
                        <div class="form-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <input type="text" id="telepon" class="form-input" value="{{ $pembeli->NOMOR_TELEPON }}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email</label>
                        <div class="form-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" class="form-input" value="{{ $pembeli->EMAIL_PEMBELI }}"
                            readonly>
                    </div>
                </div>
            </div>

            <!-- Reward Card -->
            <div class="card reward-card">
                <div class="reward-content">
                    <div class="card-header">
                        <div class="card-icon" style="background: rgba(255, 255, 255, 0.2);">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h2 class="card-title" style="color: white;">Poin Reward</h2>
                    </div>

                    <div class="reward-points">{{ $pembeli->POIN_PEMBELI ?? 0 }}</div>
                    <div class="reward-label">Total Poin Anda</div>

                    <button class="reward-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#tukarPoinModal">
                        <i class="fas fa-exchange-alt me-2"></i>
                        Tukar Poin
                    </button>

                    <p class="reward-description">
                        Tukarkan poin Anda dengan merchandise menarik atau diskon khusus!
                    </p>
                </div>
            </div>
        </div>

        <!-- Address Section - FIXED: Moved outside of profile-grid -->
        <div class="address-section">
            <div class="card address-card">
                <div class="address-header">
                    <div class="card-header" style="margin-bottom: 0;">
                        <div class="card-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h2 class="card-title">Pengaturan Alamat</h2>
                    </div>
                    <button class="add-address-btn" id="addAddressBtn">
                        <i class="fas fa-plus"></i>
                        Tambah Alamat
                    </button>
                </div>

                <div class="search-container">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" class="search-input" placeholder="Cari alamat Anda..." id="search-address">
                </div>

                <!-- Address List Container -->
                <!-- Tabel Alamat -->
                <table class="alamat-table">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Alamat Lengkap</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kota</th>
                            <th>Kode Pos</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alamatList as $alamat)
                            <tr>
                                <td>{{ $alamat->LABEL_ALAMAT }}</td>
                                <td>{{ $alamat->NAMA_JALAN }}</td>
                                <td>{{ $alamat->KELURAHAN }}</td>
                                <td>{{ $alamat->KECAMATAN }}</td>
                                <td>{{ $alamat->KOTA }}</td>
                                <td>{{ $alamat->KODE_POS }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="action-btn edit-btn"
                                        onclick="openEditModal({{ $alamat->ID_ALAMAT }}, '{{ $alamat->LABEL_ALAMAT }}', '{{ $alamat->NAMA_JALAN }}', '{{ $alamat->KELURAHAN }}', '{{ $alamat->KECAMATAN }}', '{{ $alamat->KOTA }}', '{{ $alamat->KODE_POS }}')">Edit</button>

                                    <!-- Form Hapus -->
                                    <form action="{{ route('alamat.destroy', $alamat->ID_ALAMAT) }}" method="POST"
                                        class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn"
                                            onclick="return confirm('Yakin ingin menghapus alamat ini?')">Hapus</button>
                                    </form>

                                    <!-- Set Default -->
                                    @if ($alamat->IS_DEFAULT)
                                        <span class="default-badge">Default</span>
                                    @else
                                        <form action="{{ route('alamat.set_default', $alamat->ID_ALAMAT) }}" method="POST"
                                            class="inline-form">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="action-btn default-btn">Jadikan Default</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="
            background-color: #e63946;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            cursor: pointer;
        ">
                    LogOut
                    <i class="fas fa-sign-out-alt" style="margin-left: 10px;"></i>
                </button>
            </form>
        </div>

    </div>

    <!-- Modal Tambah -->
    <div id="addressModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Alamat Baru</h3>
                <button class="close-modal" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="addressForm" method="POST" action="{{ route('alamat.store') }}">
                @csrf
                <div class="modal-form">
                    <div class="form-group full-width">
                        <label class="form-label" for="label">Label Alamat</label>
                        <input type="text" name="LABEL_ALAMAT" id="label" class="modal-input"
                            placeholder="Contoh: Rumah, Kantor, Kos" required>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="jalan">Alamat Lengkap</label>
                        <input type="text" name="NAMA_JALAN" id="jalan" class="modal-input"
                            placeholder="Jalan, Nomor, RT/RW" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kelurahan">Kelurahan</label>
                        <input type="text" name="KELURAHAN" id="kelurahan" class="modal-input"
                            placeholder="Masukkan kelurahan" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kecamatan">Kecamatan</label>
                        <input type="text" name="KECAMATAN" id="kecamatan" class="modal-input"
                            placeholder="Masukkan kecamatan" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kota">Kota/Kabupaten</label>
                        <input type="text" name="KOTA" id="kota" class="modal-input"
                            placeholder="Masukkan kota/kabupaten" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kodepos">Kode Pos</label>
                        <input type="text" name="KODE_POS" id="kodepos" class="modal-input" placeholder="12345"
                            required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal-btn cancel-btn" id="cancelAddress">Batal</button>
                    <button type="submit" class="modal-btn save-btn">Simpan Alamat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Alamat -->
    <div id="editAddressModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Alamat</h3>
                <button class="close-modal" id="closeEditModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editAddressForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-form">
                    <div class="form-group full-width">
                        <label class="form-label" for="edit-label">Label Alamat</label>
                        <input type="text" name="LABEL_ALAMAT" id="edit-label" class="modal-input" required>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="edit-jalan">Alamat Lengkap</label>
                        <input type="text" name="NAMA_JALAN" id="edit-jalan" class="modal-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit-kelurahan">Kelurahan</label>
                        <input type="text" name="KELURAHAN" id="edit-kelurahan" class="modal-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit-kecamatan">Kecamatan</label>
                        <input type="text" name="KECAMATAN" id="edit-kecamatan" class="modal-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit-kota">Kota/Kabupaten</label>
                        <input type="text" name="KOTA" id="edit-kota" class="modal-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit-kodepos">Kode Pos</label>
                        <input type="text" name="KODE_POS" id="edit-kodepos" class="modal-input" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal-btn cancel-btn" id="cancelEditAddress">Batal</button>
                    <button type="submit" class="modal-btn save-btn">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tukarPoinModal" tabindex="-1" aria-labelledby="tukarPoinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="tukarPoinModalLabel">Informasi Penukaran Poin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    Silakan Tukar Poin Anda Melalui Aplikasi Mobile <strong>ReuseMart</strong>.
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript for interactions -->
    <script>
        // Modal Tambah Alamat
        const modal = document.getElementById('addressModal');
        const addAddressBtn = document.querySelector('.add-address-btn');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.getElementById('cancelAddress');
        const addressForm = document.getElementById('addressForm');
        const addressList = document.getElementById('addressList');
        const emptyState = document.getElementById('emptyState');

        // Modal Edit Alamat
        const editModal = document.getElementById('editAddressModal');
        const closeEditModal = document.getElementById('closeEditModal');
        const cancelEditBtn = document.getElementById('cancelEditAddress');
        const editAddressForm = document.getElementById('editAddressForm');

        // Tambahkan variabel global untuk melacak mode dan item yang sedang diedit
        let isEditMode = false;
        let currentEditItem = null;

        // Fungsi untuk update empty state
        function updateEmptyState() {
            if (addressList) {
                const addressItems = addressList.querySelectorAll('.address-item');
                if (addressItems.length === 0) {
                    if (emptyState) emptyState.style.display = 'block';
                } else {
                    if (emptyState) emptyState.style.display = 'none';
                }
            }
        }

        // Fungsi untuk membuka modal tambah alamat
        function openModal(mode, addressItem = null) {
            isEditMode = mode === 'edit';
            currentEditItem = addressItem;

            // Ubah judul modal berdasarkan mode
            document.querySelector('.modal-header h3').textContent = isEditMode ? 'Edit Alamat' : 'Tambah Alamat Baru';

            // Jika mode edit, isi form dengan data alamat yang ada
            if (isEditMode && addressItem) {
                const addressText = addressItem.querySelector('.address-text').value;

                // Parse alamat untuk mengisi form
                // Format alamat: "Label: Jalan, Kel. Kelurahan, Kec. Kecamatan, Kota, Kodepos"
                try {
                    const labelMatch = addressText.match(/(.*?):/);
                    const label = labelMatch ? labelMatch[1].trim() : '';

                    const jalanMatch = addressText.match(/: (.*?), Kel\./);
                    const jalan = jalanMatch ? jalanMatch[1].trim() : '';

                    const kelurahanMatch = addressText.match(/Kel\. (.*?), Kec\./);
                    const kelurahan = kelurahanMatch ? kelurahanMatch[1].trim() : '';

                    const kecamatanMatch = addressText.match(/Kec\. (.*?),/);
                    const kecamatan = kecamatanMatch ? kecamatanMatch[1].trim() : '';

                    const kotaMatch = addressText.match(/Kec\. .*?, (.*?),/);
                    const kota = kotaMatch ? kotaMatch[1].trim() : '';

                    const kodeposMatch = addressText.match(/, ([0-9]+)$/);
                    const kodepos = kodeposMatch ? kodeposMatch[1].trim() : '';

                    // Isi form dengan data yang di-parse
                    document.getElementById('label').value = label;
                    document.getElementById('jalan').value = jalan;
                    document.getElementById('kelurahan').value = kelurahan;
                    document.getElementById('kecamatan').value = kecamatan;
                    document.getElementById('kota').value = kota;
                    document.getElementById('kodepos').value = kodepos;
                } catch (e) {
                    console.error('Error parsing address:', e);
                }
            } else {
                // Reset form jika mode tambah
                addressForm.reset();
            }

            // Tampilkan modal
            modal.style.display = 'block';
        }

        // Fungsi untuk membuka modal edit alamat (dipanggil dari tombol edit di tabel)
        function openEditModal(id, label, jalan, kelurahan, kecamatan, kota, kodepos) {
            // Isi form edit dengan data alamat
            document.getElementById('edit-label').value = label || '';
            document.getElementById('edit-jalan').value = jalan || '';
            document.getElementById('edit-kelurahan').value = kelurahan || '';
            document.getElementById('edit-kecamatan').value = kecamatan || '';
            document.getElementById('edit-kota').value = kota || '';
            document.getElementById('edit-kodepos').value = kodepos || '';

            // Set action form untuk update alamat dengan ID yang benar
            const updateRoute = `/alamat/${id}`;
            editAddressForm.action = updateRoute;

            // Tampilkan modal edit
            editModal.style.display = 'block';
        }

        // Event listeners untuk modal tambah alamat
        if (addAddressBtn) {
            addAddressBtn.addEventListener('click', function () {
                // Reset form
                addressForm.reset();
                // Tampilkan modal tambah
                modal.style.display = 'block';
            });
        }

        // Close modal tambah when close button is clicked
        if (closeModal) {
            closeModal.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        }

        // Close modal tambah when cancel button is clicked
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });
        }

        // Event listeners untuk modal edit alamat
        if (closeEditModal) {
            closeEditModal.addEventListener('click', function () {
                editModal.style.display = 'none';
            });
        }

        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', function () {
                editModal.style.display = 'none';
            });
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        });

        // Handle form submission untuk tambah alamat
        if (addressForm) {
            addressForm.addEventListener('submit', function (e) {
                // Form akan disubmit secara normal ke backend
                // Tidak perlu preventDefault karena kita ingin backend memproses
            });
        }

        // Handle form submission untuk edit alamat
        if (editAddressForm) {
            editAddressForm.addEventListener('submit', function (e) {
                // Form akan disubmit secara normal ke backend
                // Tidak perlu preventDefault karena kita ingin backend memproses
            });
        }

        // Function to add address to the list (untuk JavaScript dinamis jika diperlukan)
        function addAddressToList(addressString) {
            if (!addressList) return;

            const newAddress = document.createElement('div');
            newAddress.className = 'address-item';
            newAddress.innerHTML = `
                <input type="text" class="address-text" value="${addressString}" readonly>
                <div class="address-actions">
                    <div class="address-set-primary">Atur Sebagai Utama</div>
                    <button class="btn-edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3 9.293V13h3.5L13.207 6.207a.5.5 0 0 0 0-.707z"/>
                        </svg>
                    </button>
                    <button class="btn-delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </div>
            `;
            addressList.appendChild(newAddress);

            // Add event listeners to new buttons
            setupAddressItemEventListeners(newAddress);
        }

        // Function to set up event listeners for address item buttons
        function setupAddressItemEventListeners(addressItem) {
            const editBtn = addressItem.querySelector('.btn-edit');
            const deleteBtn = addressItem.querySelector('.btn-delete');
            const setPrimaryBtn = addressItem.querySelector('.address-set-primary');

            if (editBtn) {
                editBtn.addEventListener('click', function () {
                    // Panggil fungsi openModal dengan mode 'edit' dan item yang akan diedit
                    openModal('edit', this.closest('.address-item'));
                });
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', function () {
                    if (confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
                        this.closest('.address-item').remove();
                        updateEmptyState();
                        showNotification('Alamat berhasil dihapus!', 'success');
                    }
                });
            }

            if (setPrimaryBtn) {
                setPrimaryBtn.addEventListener('click', function () {
                    const addressItem = this.closest('.address-item');
                    if (addressList) {
                        addressList.prepend(addressItem);
                    }
                    showNotification('Alamat berhasil diatur sebagai utama!', 'success');
                });
            }
        }

        // Search functionality
        const searchAddressInput = document.querySelector('#search-address');
        if (searchAddressInput) {
            searchAddressInput.addEventListener('input', function () {
                const searchQuery = this.value.toLowerCase();
                const addressItems = document.querySelectorAll('.address-item');

                addressItems.forEach(item => {
                    const addressText = item.querySelector('.address-text');
                    if (addressText) {
                        const addressValue = addressText.value.toLowerCase();
                        // Sembunyikan alamat yang tidak sesuai dengan pencarian
                        if (addressValue.includes(searchQuery)) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    }
                });
            });
        }

        // Simple notification function
        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1001;
                animation: slideIn 0.3s ease;
                font-weight: 500;
            `;
            notification.textContent = message;

            // Add to body
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Add CSS animations for notification
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Initialize empty state
        updateEmptyState();
    </script>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>