<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Donasi - ReuseMart</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #0D5C4F;
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

        .container-fluid {
            padding: 40px;
        }

        .main-content {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            color: #18594a;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .btn-request {
            background-color: #18594a;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-request:hover {
            background-color: orange;
            color: black;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 8px 40px 8px 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header {
            background-color: #18594a;
            color: white;
        }

        .badge-menunggu {
            background-color: #ffc107;
            color: #000;
        }

        .badge-disetujui {
            background-color: #28a745;
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
    <!-- Header -->
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
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Selamat datang, {{ $organisasi->NAMA_ORGANISASI }}</h2>
                <h2 class="page-title mb-0">Request Donasi</h2>

                <!-- Button to open modal for new request -->
                <button class="btn btn-request" data-bs-toggle="modal" data-bs-target="#requestModal">
                    <i class="fas fa-plus"></i> Request Donasi Baru
                </button>
            </div>

            <!-- Search container -->
            <div class="search-container">
                <div class="search-box">
                    <input type="text" class="search-input" id="searchInput" placeholder="Cari request donasi...">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>

            <!-- Request table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="table-header">
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Deskripsi Request</th>
                            <th scope="col">Tanggal Request</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="requestTableBody">
                        @forelse ($requestList as $request)
                            <tr>
                                <td>{{ $request->NAMA_BARANG }}</td>
                                <td>{{ $request->DESKRIPSI_REQUEST }}</td>
                                <td>{{ $request->TANGGAL_REQUEST }}</td>
                                <td>{{ $request->STATUS_REQUEST }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $request->ID_REQUEST }}">Edit</button>

                                    <!-- Tombol Hapus (dalam form) -->
                                    <form action="{{ route('request.destroy', $request->ID_REQUEST) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus request ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $request->ID_REQUEST }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $request->ID_REQUEST }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('request.update', $request->ID_REQUEST) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $request->ID_REQUEST }}">
                                                    Edit Request
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Tutup">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" name="NAMA_BARANG"
                                                        value="{{ $request->NAMA_BARANG }}" class="form-control" required>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label>Deskripsi</label>
                                                    <textarea name="DESKRIPSI_REQUEST" class="form-control"
                                                        required>{{ $request->DESKRIPSI_REQUEST }}</textarea>
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
                                <td colspan="6" class="text-center">Belum ada request donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for adding a new request -->
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('request.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestModalLabel">Request Donasi Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaBarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="NAMA_BARANG" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsiRequest" class="form-label">Deskripsi Request</label>
                            <textarea class="form-control" id="deskripsiRequest" name="DESKRIPSI_REQUEST" rows="3"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get DOM elements
            const searchInput = document.getElementById('searchInput');

            // Handle search functionality - PERBAIKAN
            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const searchText = this.value.toLowerCase();
                    // Ambil semua rows yang ada, termasuk yang di-render oleh server
                    const allRows = document.querySelectorAll('#requestTableBody tr');

                    allRows.forEach(function (row) {
                        // Skip jika row kosong atau hanya berisi pesan "Belum ada request donasi"
                        const isEmpty = row.querySelector('td[colspan]');
                        if (isEmpty) {
                            return; // Skip empty row message
                        }

                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Jika search kosong, tampilkan semua rows
                    if (searchText === '') {
                        allRows.forEach(function (row) {
                            row.style.display = '';
                        });
                    }
                });
            }

            // Fungsi-fungsi JavaScript lainnya tetap sama untuk modal dan form handling
            // (Kode JavaScript yang tidak berhubungan dengan search tidak diubah)
            
            // Array to store request data (untuk fungsi JavaScript tambahan)
            let requests = [];

            // Function to update table visibility
            function updateTableVisibility() {
                const noDataMessage = document.getElementById('noDataMessage');
                if (noDataMessage) {
                    if (requests.length > 0) {
                        noDataMessage.style.display = 'none';
                    } else {
                        noDataMessage.style.display = 'block';
                    }
                }
            }

            // Function to render the request table (untuk data JavaScript tambahan)
            function renderRequestTable() {
                // Fungsi ini tidak menghapus data yang di-render server
                // Hanya menambahkan data JavaScript jika ada
                if (requests.length > 0) {
                    const requestTableBody = document.getElementById('requestTableBody');
                    
                    requests.forEach(function (request) {
                        const row = document.createElement('tr');
                        
                        let badgeClass = '';
                        switch (request.status) {
                            case 'Menunggu':
                                badgeClass = 'badge-menunggu';
                                break;
                            case 'Disetujui':
                                badgeClass = 'badge-disetujui';
                                break;
                            default:
                                badgeClass = 'badge-menunggu';
                        }

                        row.innerHTML = `
                            <td>${request.namaBarang}</td>
                            <td>${request.deskripsi}</td>
                            <td>${request.namaPenerima}</td>
                            <td>${request.tanggal}</td>
                            <td><span class="badge ${badgeClass}">${request.status}</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-index="${requests.indexOf(request)}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" data-index="${requests.indexOf(request)}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        `;

                        requestTableBody.appendChild(row);
                    });
                }
                updateTableVisibility();
            }

            // Event handlers untuk tombol edit dan delete JavaScript
            const requestTableBody = document.getElementById('requestTableBody');
            if (requestTableBody) {
                requestTableBody.addEventListener('click', function (event) {
                    if (event.target.closest('.edit-btn')) {
                        const button = event.target.closest('.edit-btn');
                        const index = button.dataset.index;
                        editRequest(index);
                    }

                    if (event.target.closest('.delete-btn')) {
                        const button = event.target.closest('.delete-btn');
                        const index = button.dataset.index;
                        deleteRequest(index);
                    }
                });
            }

            // Function to edit a request
            function editRequest(index) {
                const request = requests[index];
                if (request) {
                    document.getElementById('namaBarang').value = request.namaBarang;
                    document.getElementById('deskripsiRequest').value = request.deskripsi;

                    const modal = new bootstrap.Modal(document.getElementById('requestModal'));
                    modal.show();
                }
            }

            // Function to delete a request
            function deleteRequest(index) {
                if (confirm('Apakah Anda yakin ingin menghapus request ini?')) {
                    requests.splice(index, 1);
                    renderRequestTable();
                }
            }

            // Initial setup
            updateTableVisibility();
        });
    </script>
</body>

</html>