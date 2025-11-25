<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Tambah Penitipan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .btn-add:hover {
            background-color: #218838;
            color: white;
        }

        .btn-print {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-print:hover {
            background-color: #0056b3;
            color: white;
        }

        .btn-detail {
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-detail:hover {
            background-color: #138496;
            color: white;
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
        }

        .no-data-message {
            text-align: center;
            padding: 40px;
            font-style: italic;
            color: #777;
        }

        .page-title {
            color: #18594a;
            font-weight: 600;
            margin-bottom: 20px;
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
                <a href="{{ route('halamanGudang') }}" class="btn btn-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <h4 class="page-title">Tambah Penitipan Untuk {{ $penitip->NAMA_PENITIP }}</h4>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="btn btn-add" data-bs-toggle="modal"
                        data-bs-target="#modalTambahPenitipan">
                        <i class="fas fa-plus me-2"></i>Tambah Penitipan
                    </button>
                </div>

                <!-- Penitipan Table -->
                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">ID Penitipan</th>
                                <th scope="col">Tanggal Dititipkan</th>
                                <th scope="col">Tanggal Berakhir</th>
                                <th scope="col">Status Perpanjangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="penitipanTableBody">
                            @forelse ($penitipanList as $penitipan)
                                <tr>
                                    <td>PT00{{ $penitipan->ID_PENITIPAN }}</td>
                                    <td>{{ \Carbon\Carbon::parse($penitipan->TANGGAL_PENITIPAN)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($penitipan->TANGGAL_BERAKHIR)->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($penitipan->STATUS_PERPANJANGAN)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('penitipan.detail', $penitipan->ID_PENITIPAN) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Detail Barang
                                        </a>

                                        <a href="{{ route('penitipan.cetak', $penitipan->ID_PENITIPAN) }}"
                                            class="btn btn-secondary">
                                            <i class="fas fa-file-pdf me-2"></i> Cetak Nota
                                        </a>

                                        @if ($penitipan->IS_AMBIL && !$penitipan->STATUS_AMBIL_KEMBALI)
                                            <form method="POST"
                                                action="{{ route('penitipan.konfirmasiAmbil', $penitipan->ID_PENITIPAN) }}"
                                                style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm mt-1 ">
                                                    <i class="fas fa-check-circle"></i> Konfirmasi Pengambilan Kembali
                                                </button>
                                            </form>
                                        @elseif ($penitipan->STATUS_AMBIL_KEMBALI)
                                            <span class="badge bg-success mt-1">Pengambilan Kembali Sudah Dikonfirmasi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data penitipan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="noDataMessage" class="no-data-message d-none">
                        Belum ada data penitipan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Penitipan -->
    <div class="modal fade" id="modalTambahPenitipan" tabindex="-1" aria-labelledby="modalTambahPenitipanLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('penitipan.create', $penitip->ID_PENITIP) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPenitipanLabel">Tambah Penitipan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ID_HUNTER" class="form-label">Pilih Hunter</label>
                            <select name="ID_HUNTER" id="ID_HUNTER" class="form-select">
                                <option value="" selected>Tanpa Hunter (barang titipan langsung oleh penitip)</option>
                                @foreach ($hunters as $hunter)
                                    <option value="{{ $hunter->ID_HUNTER }}">{{ $hunter->NAMA_HUNTER }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // DOM elements
            const pageTitle = document.getElementById('pageTitle');
            const penitipanTableBody = document.getElementById('penitipanTableBody');
            const noDataMessage = document.getElementById('noDataMessage');

            // Initialize page
            function init() {
                updatePageTitle();
                renderPenitipanTable();
            }

            // Update page title with depositor name
            function updatePageTitle() {
                pageTitle.textContent = `Tambah Penitipan Untuk ${currentDepositor.ownerName}`;
            }

            // Format date to Indonesian format
            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            // Calculate end date (30 days from start date)
            function calculateEndDate(startDate) {
                const date = new Date(startDate);
                date.setDate(date.getDate() + 30);
                return date.toISOString().split('T')[0]; // Return in YYYY-MM-DD format
            }

            // Get current date in YYYY-MM-DD format
            function getCurrentDate() {
                const today = new Date();
                return today.toISOString().split('T')[0];
            }

            // Get status badge for perpanjangan
            function getStatusBadge(status) {
                const badgeClass = status === 'Ya' ? 'status-tersedia' : 'status-terjual';
                return `<span class="status-badge ${badgeClass}">${status}</span>`;
            }

            // Render penitipan table
            function renderPenitipanTable() {
                penitipanTableBody.innerHTML = '';

                if (currentDepositor.penitipanList.length === 0) {
                    noDataMessage.classList.remove('d-none');
                    return;
                }

                noDataMessage.classList.add('d-none');

                currentDepositor.penitipanList.forEach(function (penitipan) {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${formatDate(penitipan.tanggalDititipkan)}</td>
                        <td>${formatDate(penitipan.tanggalBerakhir)}</td>
                        <td>${getStatusBadge(penitipan.statusPerpanjangan)}</td>
                        <td>
                            <button class="btn btn-detail btn-sm me-2" onclick="lihatDetailBarang(${penitipan.id})">
                                <i class="fas fa-eye me-1"></i>Lihat Detail Barang
                            </button>
                            <button class="btn btn-print btn-sm" onclick="cetakNota(${penitipan.id})">
                                <i class="fas fa-print me-1"></i>Cetak Nota
                            </button>
                        </td>
                    `;

                    penitipanTableBody.appendChild(row);
                });
            }

            // Add new penitipan
            window.addPenitipan = function () {
                const currentDate = getCurrentDate();
                const endDate = calculateEndDate(currentDate);

                // Get current time
                const now = new Date();
                const currentTime = now.toLocaleTimeString('id-ID', {
                    hour12: false,
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                const newPenitipan = {
                    id: nextPenitipanId++,
                    tanggalDititipkan: currentDate,
                    tanggalBerakhir: endDate,
                    statusPerpanjangan: "Tidak",
                    waktuPenitipan: currentTime,
                    barangList: []
                };

                currentDepositor.penitipanList.push(newPenitipan);
                renderPenitipanTable();

                // Show success message
                alert(`Penitipan baru berhasil ditambahkan!\n\nTanggal Dititipkan: ${formatDate(currentDate)}\nTanggal Berakhir: ${formatDate(endDate)}`);
            };

            // Print receipt as PDF
            window.cetakNota = function (penitipanId) {
                // Find the specific penitipan
                const penitipan = currentDepositor.penitipanList.find(p => p.id === penitipanId);
                if (!penitipan) {
                    alert('Data penitipan tidak ditemukan');
                    return;
                }

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Set font
                doc.setFont("helvetica");

                // Header - ReUseMart
                doc.setFontSize(24);
                doc.setTextColor(0, 0, 0);
                doc.text('ReUseMart', 20, 25);

                // Address
                doc.setFontSize(12);
                doc.text('Jl. Green Eco Park No. 456 Yogyakarta', 20, 35);

                // Line separator
                doc.setDrawColor(0, 0, 0);
                doc.setLineWidth(1);
                doc.line(20, 45, 190, 45);

                let yPosition = 60;

                // No Nota
                doc.setFontSize(12);
                doc.text(`No Nota : ${penitipan.id.toString().padStart(3, '0')}`, 20, yPosition);
                yPosition += 15;

                // Format tanggal dengan waktu (DD/M/YYYY HH:MM:SS)
                const tanggalPenitipan = new Date(penitipan.tanggalDititipkan);
                const formattedDate = `${tanggalPenitipan.getDate()}/${tanggalPenitipan.getMonth() + 1}/${tanggalPenitipan.getFullYear()} ${penitipan.waktuPenitipan}`;

                const tanggalBerakhir = new Date(penitipan.tanggalBerakhir);
                const formattedEndDate = `${tanggalBerakhir.getDate()}/${tanggalBerakhir.getMonth() + 1}/${tanggalBerakhir.getFullYear()}`;

                // Tanggal penitipan
                doc.text(`Tanggal penitipan : ${formattedDate}`, 20, yPosition);
                yPosition += 15;

                // Masa penitipan sampai
                doc.text(`Masa penitipan sampai : ${formattedEndDate}`, 20, yPosition);
                yPosition += 20;

                // Penitip
                doc.text(`Penitip : ${currentDepositor.ownerId} / ${currentDepositor.ownerName}`, 20, yPosition);
                yPosition += 20;

                // Daftar barang
                if (penitipan.barangList && penitipan.barangList.length > 0) {
                    penitipan.barangList.forEach(function (barang) {
                        // Nama barang dan harga
                        doc.text(`${barang.nama}  :  ${barang.harga}`, 20, yPosition);
                        yPosition += 10;

                        // Garansi (jika ada)
                        if (barang.garansi) {
                            doc.text(barang.garansi, 20, yPosition);
                            yPosition += 10;
                        }

                        // Berat barang
                        doc.text(`Berat barang : ${barang.berat}`, 20, yPosition);
                        yPosition += 20;
                    });
                } else {
                    doc.text('Belum ada barang yang dititipkan', 20, yPosition);
                    yPosition += 20;
                }

                // Diterima dan QC oleh
                doc.text(`Diterima dan QC oleh :`, 20, yPosition);
                yPosition += 20;

                doc.text(`${staffQC.id} - ${staffQC.nama}`, 20, yPosition);

                // Save the PDF
                const fileName = `Nota_${penitipan.id.toString().padStart(3, '0')}_${currentDepositor.ownerName.replace(/\s+/g, '_')}.pdf`;
                doc.save(fileName);
            };

            // Navigate to detail barang page (previously tambah barang page)
            window.lihatDetailBarang = function (penitipanId) {
                // In real application, this would navigate to detail barang page with penitipan ID
                alert(`Mengarahkan ke halaman Detail Barang untuk Penitipan ID: ${penitipanId}`);
                // window.location.href = `detail-barang.html?penitipan_id=${penitipanId}`;
            };

            // Go back function
            window.goBack = function () {
                // In real application, this would navigate back to the previous page
                alert('Kembali ke halaman Kelola Penitipan');
                // window.history.back();
            };

            // Initialize the page
            init();
        });
    </script>
</body>

</html>