<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - CS (Verifikasi Pembayaran)</title>
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

        .table td {
            vertical-align: middle;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .bukti-thumbnail {
            max-width: 80px;
            max-height: 80px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-verify {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-verify:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            margin-left: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-verified {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .filter-container {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-select {
            padding: 6px 12px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
                    <li>
                        <a href="/csForPenitip" class="cs-penitip">
                            <i class="fas fa-users"></i>
                            Data Penitip
                        </a>
                    </li>
                    <li class="active">
                        <a href=" {{ route('cs.verif') }}" class="cs-pembayaran">
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
                        <a href="{{ route('cs.diskusi.index') }}">
                            <i class="fas fa-comments"></i> Diskusi Produk
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h4 class="mb-4">Verifikasi Pembayaran</h4>

                <div class="filter-container">
                    <label for="statusFilter">Filter Status:</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="pending">Menunggu Verifikasi</option>
                        <option value="verified">Terverifikasi</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari berdasarkan ID atau nama pembeli...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">ID Pembelian</th>
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Bukti Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pembayaranTableBody">
                            @forelse($pembelianList as $item)
                                <tr>
                                    <td>#PB000{{ $item->ID_PEMBELIAN }}</td>
                                    <td>{{ $item->pembeli->NAMA_PEMBELI }}</td>
                                    <td>{{ $item->TANGGAL_PEMBELIAN }}</td>
                                    <td>Rp{{ number_format($item->TOTAL_BAYAR, 0, ',', '.') }}</td>
                                    <td>
                                        @if($item->BUKTI_PEMBAYARAN)
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#buktiModal"
                                                onclick="showBukti('{{ asset('storage/' . $item->BUKTI_PEMBAYARAN) }}')">
                                                Lihat
                                            </button>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->STATUS_PEMBAYARAN == 'pending')
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        @elseif($item->STATUS_PEMBAYARAN == 'verified')
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @elseif($item->STATUS_PEMBAYARAN == 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->STATUS_PEMBAYARAN == 'pending')
                                            <button class="btn btn-sm btn-success btn-verifikasi" data-bs-toggle="modal"
                                                data-bs-target="#verifyConfirmModal" data-id="{{ $item->ID_PEMBELIAN }}">
                                                Verifikasi
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-tolak" data-bs-toggle="modal"
                                                data-bs-target="#rejectConfirmModal" data-id="{{ $item->ID_PEMBELIAN }}">Tolak
                                            </button>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data pembayaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing bukti pembayaran -->
    <div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="buktiImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Verifikasi -->
    <div class="modal fade" id="verifyConfirmModal" tabindex="-1" aria-labelledby="verifyConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyConfirmModalLabel">Konfirmasi Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p id="verifyConfirmMessage">Apakah Anda yakin ingin memverifikasi pembelian ini?</p>
                </div>
                <div class="modal-footer">
                    <form id="formVerifikasi" method="POST" action="">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="confirmVerifyBtn" class="btn btn-success">Ya, Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for rejection confirmation -->
    <div class="modal fade" id="rejectConfirmModal" tabindex="-1" aria-labelledby="rejectConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectConfirmModalLabel">Konfirmasi Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-warning"
                            style="font-size: 48px; margin-bottom: 15px;"></i>
                        <p id="rejectConfirmMessage">Apakah Anda yakin ingin menolak pembelian ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="formTolak" method="POST" action="">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmRejectBtn">Ya, Tolak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showBukti(imageUrl) {
            console.log('Image URL:', imageUrl);
            document.getElementById('buktiImage').src = imageUrl;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const noDataMessage = document.getElementById('noDataMessage');
            const pembayaranTableBody = document.getElementById('pembayaranTableBody');
            const searchInput = document.querySelector('.search-input');
            const statusFilter = document.getElementById('statusFilter');
            let currentActionId = null;

            function getStatusBadge(status) {
                switch (status) {
                    case 'pending':
                        return '<span class="status-badge status-pending">Menunggu Verifikasi</span>';
                    case 'verified':
                        return '<span class="status-badge status-verified">Terverifikasi</span>';
                    case 'rejected':
                        return '<span class="status-badge status-rejected">Ditolak</span>';
                    default:
                        return '<span class="status-badge status-pending">Unknown</span>';
                }
            }

            function getActionButtons(pembayaran) {
                if (pembayaran.status === 'pending') {
                    return `
                        <button class="btn-verify" onclick="showVerifyConfirm('${pembayaran.id}')">
                            <i class="fas fa-check"></i> Verifikasi
                        </button>
                        <button class="btn-reject" onclick="showRejectConfirm('${pembayaran.id}')">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    `;
                } else {
                    return '<span class="text-muted">-</span>';
                }
            }

            function renderPembayaranTable(dataToRender = pembayaranData) {
                pembayaranTableBody.innerHTML = '';

                if (dataToRender.length === 0) {
                    noDataMessage.style.display = 'block';
                    return;
                } else {
                    noDataMessage.style.display = 'none';
                }

                dataToRender.forEach(function (pembayaran) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><strong>${pembayaran.id}</strong></td>
                        <td>${pembayaran.namaPembeli}</td>
                        <td>${new Date(pembayaran.tanggalPembelian).toLocaleDateString('id-ID')}</td>
                        <td><strong>Rp ${pembayaran.totalBayar.toLocaleString()}</strong></td>
                        <td>
                            <img src="${pembayaran.buktiPembayaran}" alt="Bukti" class="bukti-thumbnail" 
                                onclick="showBukti('${pembayaran.buktiPembayaran}')">
                        </td>
                        <td>${getStatusBadge(pembayaran.status)}</td>
                        <td>${getActionButtons(pembayaran)}</td>
                    `;
                    pembayaranTableBody.appendChild(row);
                });
            }

            function filterData() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;

                let filteredData = pembayaranData;

                // Filter by status
                if (statusValue !== 'all') {
                    filteredData = filteredData.filter(p => p.status === statusValue);
                }

                // Filter by search text
                if (searchText) {
                    filteredData = filteredData.filter(p =>
                        p.id.toLowerCase().includes(searchText) ||
                        p.namaPembeli.toLowerCase().includes(searchText)
                    );
                }

                renderPembayaranTable(filteredData);
            }

            let currentVerifikasiId = null;

            // Saat tombol verifikasi diklik
            document.querySelectorAll('.btn-verifikasi').forEach(button => {
                button.addEventListener('click', function () {
                    currentVerifikasiId = this.dataset.id;
                });
            });

            // Saat tombol konfirmasi di modal ditekan
            document.getElementById('confirmVerifyBtn').addEventListener('click', function () {
                const form = document.getElementById('formVerifikasi');
                form.action = `/pembelian/${currentVerifikasiId}/verifikasi`; // Set action URL
                form.submit();
            });

            document.querySelectorAll('.btn-tolak').forEach(button => {
                button.addEventListener('click', function () {
                    currentVerifikasiId = this.dataset.id;
                });
            });

            document.getElementById('confirmRejectBtn').addEventListener('click', function () {
                const form = document.getElementById('formTolak');
                form.action = `/pembelian/${currentVerifikasiId}/tolak`; // Set action URL
                form.submit();
            });


            // Event listeners
            searchInput.addEventListener('keyup', filterData);
            statusFilter.addEventListener('change', filterData);

            // Handle verify confirmation
            document.getElementById('confirmVerifyBtn').addEventListener('click', function () {
                if (currentActionId) {
                    verifyPayment(currentActionId);
                    bootstrap.Modal.getInstance(document.getElementById('verifyConfirmModal')).hide();
                    currentActionId = null;
                }
            });

            // Reset currentActionId when modals are closed
            document.getElementById('verifyConfirmModal').addEventListener('hidden.bs.modal', function () {
                currentActionId = null;
            });

            document.getElementById('rejectConfirmModal').addEventListener('hidden.bs.modal', function () {
                // Don't reset currentActionId here if we're going to show reject reason modal
            });

            document.getElementById('rejectModal').addEventListener('hidden.bs.modal', function () {
                currentActionId = null;
                document.getElementById('rejectForm').reset();
            });

            // Initial render
            renderPembayaranTable();
        });
    </script>
</body>

</html>