<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ReUseMart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
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

        .category-btn {
            white-space: nowrap;
        }

        .product-card img {
            height: 220px;
            object-fit: cover;
        }

        .category-scroll {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 15px;
        }

        .product-section {
            background-color: #1e5631;
            padding: 5rem 0;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            padding: 30px;
            position: relative;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            color: #0D5C4F;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .modal-header p {
            color: #666;
            font-size: 14px;
        }

        .close-modal {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 24px;
            color: #999;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: #333;
        }

        .register-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .register-option {
            border: 2px solid #DDD;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .register-option:hover {
            border-color: #8BC34A;
            background-color: #f9f9f9;
        }

        .option-icon {
            width: 50px;
            height: 50px;
            background-color: #E8F5E9;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .option-icon svg {
            width: 24px;
            height: 24px;
            fill: #0D5C4F;
        }

        .option-text {
            flex-grow: 1;
        }

        .option-text h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .option-text p {
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
            }

            .left-section {
                height: 200px;
            }

            .right-section {
                padding: 20px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <!-- Header with navigation -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <div class="d-flex">
            <a href="{{ route('login.form') }}" class="btn btn-success me-2">Masuk</a>

            <div class="dropdown" style="position: relative;">
                <a href="#" id="register-link" class="btn btn-outline-success">Daftar</a>
            </div>
        </div>
    </header>

    <!-- product Search -->
    <div class="product-section text-white text-center">
        <div class="container">
            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" class="form-control form-control-lg" id="searchInput"
                    placeholder="Cari produk atau kategori..." aria-label="Cari Produk">
            </div>
            <h1 class="display-5 fw-bold">
                Search for anything<br>on ReUseMart
            </h1>
        </div>
    </div>

    <!-- Categories -->
    <div class="container mt-4">
        <div class="category-scroll">
            <div class="d-inline-flex gap-3">
                <button data-category="all"
                    class="category-btn btn btn-light border shadow-sm px-4 py-3 fw-semibold active">📦 Semua
                    Kategori</button>
                <button data-category="Elektronik & Gadget"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">📱
                    Elektronik dan Gadget</button>
                <button data-category="Pakaian & Aksesori"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">👕 Pakaian
                    dan Aksesori</button>
                <button data-category="Perabotan Rumah Tangga"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🪑
                    Perabotan Rumah Tangga</button>
                <button data-category="Buku, Alat Tulis, & Peralatan Sekolah"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">📚 Buku &
                    Alat Tulis</button>
                <button data-category="Hobi, Mainan, & Koleksi"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🎮 Hobi &
                    Koleksi</button>
                <button data-category="Perlengkapan Bayi & Anak"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🍼
                    Perlengkapan Bayi</button>
                <button data-category="Otomotif & Aksesori"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🚗
                    Otomotif</button>
                <button data-category="Perlengkapan Taman & Outdoor"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🌿 Taman &
                    Outdoor</button>
                <button data-category="Peralatan Kantor & Industri"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">🏢 Kantor &
                    Industri</button>
                <button data-category="Kosmetik & Perawatan Diri"
                    class="category-btn btn btn-white border shadow-sm px-4 py-3">💄
                    Kosmetik</button>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <div class="container mt-5">
        <h2 class="fs-4 fw-semibold mb-4">Produk</h2>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach ($products as $product)
                <div class="col product-card" data-category="{{ $product->KATEGORI_BARANG }}">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('storage/' . $product->GAMBAR_1) }}" class="card-img-top rounded-top"
                            alt="{{ $product->NAMA_BARANG }}">
                        <div class="card-body">
                            <h5 class="card-title fs-6 fw-semibold">{{ $product->NAMA_BARANG }}</h5>
                            <p class="card-text fw-bold fs-5 mb-0">
                                Rp{{ number_format($product->HARGA_BARANG, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-white mt-5 py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-md-start">
                    <img src="/img/Logo ReuseMart.jpg" alt="ReUseMart Logo" style="height: 80px; margin-left: -50px;">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 text-end"> <!-- Ubah text-left menjadi text-end -->
                            <p class="mb-0"><strong>About us</strong><br>our story</p>
                        </div>
                        <div class="col-md-4 text-end"> <!-- Ubah text-left menjadi text-end -->
                            <p class="mb-0"><strong>Address</strong><br>Jl. Green Eco Park No. 456<br>Yogyakarta,
                                12345<br>Indonesia</p>
                        </div>
                        <div class="col-md-4 text-end"> <!-- Ubah text-left menjadi text-end -->
                            <p class="mb-0"><strong>Follow us</strong></p>
                            <div class="mt-2">
                                <a href="#" class="text-decoration-none text-dark d-block mb-2">
                                    <i class="bi bi-facebook fs-5 me-2"></i>Facebook
                                </a>
                                <a href="#" class="text-decoration-none text-dark d-block mb-2">
                                    <i class="bi bi-instagram fs-5 me-2"></i>Instagram
                                </a>
                                <a href="#" class="text-decoration-none text-dark d-block mb-2">
                                    <i class="bi bi-linkedin fs-5 me-2"></i>LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 text-secondary small">
                <p class="mb-0">© 2025 ReUseMart. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Register Modal -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <div class="modal-header">
                <h2>Daftar Akun</h2>
                <p>Pilih jenis akun yang ingin Anda daftarkan</p>
            </div>
            <div class="register-options">
                <a href="/register" class="register-option">
                    <div class="option-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <div class="option-text">
                        <h3>Pembeli / Individu</h3>
                        <p>Mendaftar sebagai pengguna perorangan untuk membeli barang</p>
                    </div>
                </a>
                <a href="/registerOrganisasi" class="register-option">
                    <div class="option-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                        </svg>
                    </div>
                    <div class="option-text">
                        <h3>Organisasi / Komunitas</h3>
                        <p>Mendaftar sebagai organisasi untuk melakukan request barang donasi</p>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script kategori -->
    <script>
        // JavaScript untuk mengatur modal
        const registerLink = document.getElementById('register-link');
        const registerModal = document.getElementById('register-modal');
        const closeModal = document.querySelector('.close-modal');

        // Membuka modal saat link daftar diklik
        registerLink.addEventListener('click', function (e) {
            e.preventDefault();
            registerModal.style.display = 'flex';
        });

        // Menutup modal saat tombol close diklik
        closeModal.addEventListener('click', function () {
            registerModal.style.display = 'none';
        });

        // Menutup modal saat mengklik di luar modal
        window.addEventListener('click', function (e) {
            if (e.target === registerModal) {
                registerModal.style.display = 'none';
            }
        });

        const categoryButtons = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selected = button.getAttribute('data-category');

                productCards.forEach(card => {
                    if (selected === 'all') {
                        card.style.display = '';
                    } else {
                        card.style.display = (card.getAttribute('data-category') === selected) ? '' : 'none';
                    }
                });

                // Update active state for buttons
                categoryButtons.forEach(btn => {
                    btn.classList.remove('active', 'btn-light');
                    btn.classList.add('btn-white');
                });
                button.classList.remove('btn-white');
                button.classList.add('active', 'btn-light');
            });
        });

        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();

            productCards.forEach(card => {
                const productTitle = card.querySelector('.card-title').textContent.toLowerCase();
                if (productTitle.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

    </script>

</body>

</html>