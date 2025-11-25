<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Penitipan - ReuseMart</title>
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
            max-width: 1400px;
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
            transform: translateY(-2px);
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

        /* Filter Bar */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-select {
            padding: 10px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            background: white;
            color: #374151;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .search-box {
            position: relative;
        }

        .search-input {
            padding: 10px 16px 10px 40px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            background: white;
            color: #374151;
            min-width: 250px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:hover {
            background: #f8fafc;
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .item-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .item-description {
            font-size: 12px;
            color: #64748b;
        }

        .date-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .date-main {
            font-weight: 500;
            color: #1e293b;
        }

        .date-sub {
            font-size: 12px;
            color: #64748b;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }

        .status-available {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
        }

        .status-sold {
            background: rgba(249, 191, 0, 0.1);
            color: rgba(0, 0, 0, 0.85);
        }

        .status-donated {
            background: rgba(168, 85, 247, 0.1);
            color: #7c3aed;
        }

        .status-returned {
            background: rgba(107, 114, 128, 0.1);
            color: #374151;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-extend {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
        }

        .btn-extend:hover {
            background: linear-gradient(135deg, #134e4a, #0f766e);
            transform: translateY(-1px);
        }

        .btn-pickup {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
        }

        .btn-pickup:hover {
            background: linear-gradient(135deg, #991b1b, #dc2626);
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .empty-description {
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 0 16px;
                margin: 24px auto;
            }

            .card {
                padding: 20px;
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

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                min-width: auto;
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                text-align: center;
                justify-content: center;
            }

            .table-container {
                font-size: 14px;
            }

            th,
            td {
                padding: 12px 8px;
            }

            .item-image {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="/halamanPenitip" class="active">Halaman Penitipan</a>
            <a href="profilPenitip">Profil Akun</a>
        </nav>
    </header>

    @php
        $belumLaku = 0;
        $jumlah = 0;
    @endphp

    @foreach($barangList as $barang)
        @if(in_array($barang->STATUS_BARANG, ['Tersedia', 'barang untuk donasi', 'Terdonasi', 'Diambil']))
            @php
                $belumLaku += 1;
            @endphp
        @endif
    @endforeach


    @foreach($barangList as $barang)

        @php
            $jumlah += 1;
        @endphp

    @endforeach

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Penitipan</h1>
            <p class="page-subtitle">Jumlah total barang yang anda titipkan : {{ $jumlah }}</p>
            <p class="page-subtitle">Jumlah barang yang belum laku : {{ $belumLaku }}</p>
        </div>

        <!-- History Table Card -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h2 class="card-title">Riwayat Penitipan Barang</h2>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Cari nama barang..." id="searchInput">
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @php
                $penitipanRendered = [];
            @endphp

            <div class="table-container">
                <table id="historyTable" class="table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Penitipan</th>
                            <th>Tanggal Berakhir</th>
                            <th>Status Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangList as $barang)
                            @php
                                $isFirstOfPenitipan = !in_array($barang->ID_PENITIPAN, $penitipanRendered);
                                $rowspan = $barangList->where('ID_PENITIPAN', $barang->ID_PENITIPAN)->count();
                            @endphp

                            <tr @if($isFirstOfPenitipan) style="border-top: 3px solid #aaa;" @endif>
                                <!-- Gambar -->
                                <td>
                                    <img src="{{ asset('storage/' . $barang->GAMBAR_1) }}" class="item-image"
                                        style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                        onclick="showModal('{{ addslashes($barang->NAMA_BARANG) }}', '{{ addslashes($barang->DESKRIPSI_BARANG) }}', '{{ $barang->STATUS_BARANG }}', '{{ asset('storage/' . $barang->GAMBAR_2) }}', '{{ asset('storage/' . $barang->GAMBAR_3) }}')"
                                        alt="{{ $barang->NAMA_BARANG }}">
                                </td>

                                <!-- Nama Barang -->
                                <td>
                                    <div class="item-name">{{ $barang->NAMA_BARANG }}</div>
                                    <div class="item-description">{{ $barang->DESKRIPSI_BARANG }}</div>
                                </td>

                                <!-- Tanggal Penitipan -->
                                @if($isFirstOfPenitipan)
                                    <td rowspan="{{ $rowspan }}">
                                        {{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_PENITIPAN)->format('d F Y') }}
                                    </td>
                                @endif

                                <!-- Tanggal Berakhir -->
                                @if($isFirstOfPenitipan)
                                    <td rowspan="{{ $rowspan }}">
                                        {{ \Carbon\Carbon::parse($barang->penitipan->TANGGAL_BERAKHIR)->format('d F Y') }}
                                    </td>
                                @endif

                                <!-- Status Barang -->
                                <td>
                                    @if($barang->STATUS_BARANG == 'Tersedia')
                                        <span class="status-badge status-available">Tersedia</span>
                                    @elseif($barang->STATUS_BARANG == 'Diambil')
                                        <span class="status-badge status-unavailable">Diambil</span>
                                    @elseif($barang->STATUS_BARANG == 'Terjual')
                                        <span class="status-badge status-unavailable">Terjual</span>
                                    @elseif(in_array($barang->STATUS_BARANG, ['barang untuk donasi', 'Terdonasi']))
                                        <span class="status-badge status-donasi">Barang Donasi</span>
                                    @else
                                        <span class="status-badge status-unknown">Tidak Diketahui</span>
                                    @endif
                                </td>


                                <!-- Aksi -->
                                @php
                                    $barangOfPenitipan = $barangList->where('ID_PENITIPAN', $barang->ID_PENITIPAN);
                                    $semuaTerjual = $barangOfPenitipan->every(function ($b) {
                                        return $b->STATUS_BARANG === 'Terjual';
                                    });
                                @endphp

                                @php
                                    $semuaDonasi = $barangOfPenitipan->every(function ($b) {
                                        return in_array($b->STATUS_BARANG, ['barang untuk donasi', 'Terdonasi']);
                                    });
                                @endphp


                                @if($isFirstOfPenitipan)
                                    <td rowspan="{{ $rowspan }}">
                                        <div class="action-buttons">
                                            @if ($semuaTerjual)
                                                <div
                                                    style="border: 1px solid green; padding: 6px; border-radius: 4px; color: green; text-align: center;">
                                                    Terjual Semua
                                                </div>
                                            @elseif ($semuaDonasi)
                                                <div
                                                    style="border: 1px solid blue; padding: 6px; border-radius: 4px; color: blue; text-align: center;">
                                                    Barang untuk Donasi
                                                </div>
                                            @else
                                                {{-- Tombol Perpanjang --}}
                                                @if(!$barang->penitipan->STATUS_PERPANJANGAN)
                                                    <form method="POST"
                                                        action="{{ route('barang.perpanjang', $barang->ID_PENITIPAN) }}">
                                                        @csrf
                                                        <button class="btn btn-extend" type="submit">
                                                            <i class="fas fa-clock"></i> Perpanjang
                                                        </button>
                                                    </form>
                                                @else
                                                    <div
                                                        style="border: 1px solid orange; padding: 6px; border-radius: 4px; color: orange; text-align: center;">
                                                        Sudah Diperpanjang
                                                    </div>
                                                @endif

                                                {{-- Tombol Ambil Kembali --}}
                                                @if($barang->penitipan->STATUS_AMBIL_KEMBALI)
                                                    <div
                                                        style="border: 1px solid gray; padding: 6px; border-radius: 4px; color: gray; text-align: center;">
                                                        Diambil Kembali
                                                    </div>
                                                @elseif(!$barang->penitipan->IS_AMBIL)
                                                    <form method="POST" action="{{ route('barang.ambil', $barang->ID_PENITIPAN) }}">
                                                        @csrf
                                                        <button class="btn btn-pickup" type="submit">
                                                            <i class="fas fa-hand-holding"></i> Ambil Kembali
                                                        </button>
                                                    </form>
                                                @else
                                                    <div
                                                        style="border: 1px solid red; padding: 6px; border-radius: 4px; color: red; text-align: center;">
                                                        Menunggu Konfirmasi
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    @php
                                        $penitipanRendered[] = $barang->ID_PENITIPAN;
                                    @endphp
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="customModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background-color: rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:white; padding:20px; border-radius:8px; max-width:600px; width:95%; position:relative;">
            <!-- Close Button -->
            <button onclick="closeModal()"
                style="position:absolute; top:10px; right:10px; border:none; background:none; font-size:24px;">&times;</button>

            <!-- Title -->
            <h4 id="modalNamaBarang" style="margin-bottom:10px;"></h4>

            <!-- Carousel -->
            <div id="carousel" style="position:relative; width:100%; height:300px; overflow:hidden;">
                <img id="carouselImage1" src="" style="width:100%; height:300px; object-fit:cover; display:block;">
                <img id="carouselImage2" src="" style="width:100%; height:300px; object-fit:cover; display:none;">
                <!-- Carousel Nav -->
                <!-- Ganti tombol panah jadi seperti ini -->
                <button onclick="showCarouselImage(1)" style="position:absolute; left:10px; top:50%; transform:translateY(-50%);
    z-index:10; background:rgba(255,255,255,0.7); border:none; padding:8px; cursor:pointer;">
                    ⟨
                </button>

                <button onclick="showCarouselImage(2)" style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
    z-index:10; background:rgba(255,255,255,0.7); border:none; padding:8px; cursor:pointer;">
                    ⟩
                </button>

            </div>

            <!-- Deskripsi & Status -->
            <p style="margin-top:15px;"><strong>Deskripsi:</strong> <span id="modalDeskripsi"></span></p>
            <p><strong>Status:</strong> <span id="modalStatus"></span></p>
        </div>
    </div>

    <script>
        let currentImage = 1;

        function showModal(nama, deskripsi, status, gambar2, gambar3) {
            document.getElementById('modalNamaBarang').innerText = nama;
            document.getElementById('modalDeskripsi').innerText = deskripsi;
            document.getElementById('modalStatus').innerText = status;

            document.getElementById('carouselImage1').src = gambar2;
            document.getElementById('carouselImage2').src = gambar3;

            currentImage = 1;
            showCarouselImage(currentImage);

            document.getElementById('customModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('customModal').style.display = 'none';
        }

        function showCarouselImage(index) {
            currentImage = index;
            document.getElementById('carouselImage1').style.display = (index === 1) ? 'block' : 'none';
            document.getElementById('carouselImage2').style.display = (index === 2) ? 'block' : 'none';
        }
    </script>



    <script>
        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('historyTable');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        function filterTable() {
            const searchValue = searchInput.value.toLowerCase();

            rows.forEach(row => {
                const nameCell = row.querySelector('.item-name');
                const searchMatch = !searchValue || nameCell.textContent.toLowerCase().includes(searchValue);

                row.style.display = searchMatch ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterTable);

        // Auto-refresh functionality (optional)
        setInterval(() => {
            // In real implementation, you might want to refresh data periodically
            // console.log('Checking for updates...');
        }, 60000); // Check every minute
    </script>
</body>

</html>