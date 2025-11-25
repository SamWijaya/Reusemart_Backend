<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - ReUseMart</title>
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

        .cart-table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .checkout-card {
            background: linear-gradient(135deg, #1e5631 0%, #2d7a47 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(30, 86, 49, 0.3);
        }

        .btn-remove {
            background-color: #dc3545;
            margin-left: 65px;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-checkout {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        }

        .empty-cart {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
        }

        .cart-icon {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .keranjang-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .keranjang-kiri {
            flex: 2;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .keranjang-kanan {
            flex: 1;
            background: #006644;
            color: white;
            padding: 20px;
            border-radius: 8px;
            height: fit-content;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .judul {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .table-keranjang {
            width: 100%;
            border-collapse: collapse;
        }

        .table-keranjang th,
        .table-keranjang td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .produk-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .produk-info img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .btn-hapus {
            background: #e3342f;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        .btn-checkout {
            background: #00c851;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-checkout:disabled {
            background-color: #ccc;
            color: #999;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Header with navigation -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="/halamanPembeli">Beranda</a>
            <a href="/keranjang" class="active">Keranjang</a>
            <a href="{{ route('histori.pembelian') }}">History</a> 
            <a href="/profilPembeli">Profil Akun</a>
        </nav>
    </header>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="fs-3 fw-bold mb-4">
                    <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
                </h2>
            </div>
        </div>

        <div class="keranjang-container">
            <div class="keranjang-kiri">
                <div class="judul">🛒 Keranjang Belanja</div>
                <table class="table-keranjang">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th style="text-align:right;">Harga</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @forelse ($keranjang as $item)
                            @php
                                $barang = $item->barang;
                                if ($barang && $barang->STATUS_BARANG === 'Tersedia') {
                                    $total += $barang->HARGA_BARANG;
                                }
                            @endphp

                            <tr>
                                <td>
                                    <div class="produk-info">
                                        @if($barang && $barang->GAMBAR_1)
                                            <img src="{{ asset('storage/' . $barang->GAMBAR_1) }}"
                                                alt="{{ $barang->NAMA_BARANG }}" width="60">
                                        @endif
                                        <div style="margin-left: 10px; display: inline-block; vertical-align: top;">
                                            <strong>{{ $barang->NAMA_BARANG }}</strong><br>
                                            <small>Kategori: {{ $barang->KATEGORI_BARANG ?? '-' }}</small><br>
                                            @if($barang->STATUS_BARANG === 'Terjual')
                                                <span
                                                    style="color: white; background-color: red; padding: 2px 6px; border-radius: 4px; font-size: 12px;">Terjual</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:right;">
                                    Rp{{ number_format($barang->HARGA_BARANG, 0, ',', '.') }}
                                </td>
                                <td style="text-align:center;">
                                    @if($barang->STATUS_BARANG === 'Terjual')
                                        <em style="color: gray;">Barang sudah terjual</em>
                                    @else
                                        <form action="{{ route('keranjang.hapus', $item->ID_BARANG) }}" method="POST"
                                            onsubmit="return confirm('Hapus barang ini dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-hapus">🗑️</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center;">Keranjang kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="keranjang-kanan">
                <h3 style="font-size: 18px;">📋 Ringkasan Belanja</h3>
                <p style="margin-top: 10px; font-size: 18px;">Total:</p>
                <h2 style="font-size: 28px; font-weight: bold;">Rp {{ number_format($total, 0, ',', '.') }}</h2>

                <form action="{{ route('checkout') }}" method="GET" style="margin-top: 20px;">
                    <button class="btn-checkout" {{ $total == 0 ? 'disabled' : '' }}>
                        Checkout
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white mt-5 py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 text-md-start">
                        <img src="/img/Logo ReuseMart.jpg" alt="ReUseMart Logo"
                            style="height: 80px; margin-left: -50px;">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 text-end">
                                <p class="mb-0"><strong>About us</strong><br>our story</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <p class="mb-0"><strong>Address</strong><br>Jl. Green Eco Park No. 456<br>Yogyakarta,
                                    12345<br>Indonesia</p>
                            </div>
                            <div class="col-md-4 text-end">
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

        <!-- Bootstrap JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Format currency function
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount).replace('IDR', 'Rp');
            }

            // Calculate total
            function calculateTotal() {
                let total = 0;
                document.querySelectorAll('.cart-item').forEach(row => {
                    const price = parseInt(row.querySelector('.item-price').dataset.price);
                    total += price;
                });
                return total;
            }

            // Update total
            function updateTotal() {
                const total = calculateTotal();
                document.getElementById('totalAmount').textContent = formatCurrency(total);
            }

            // Remove item from cart
            function removeItem(button) {
                if (confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
                    const row = button.closest('.cart-item');
                    row.remove();

                    // Check if cart is empty
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        document.querySelector('.cart-table').classList.add('d-none');
                        document.getElementById('emptyCart').classList.remove('d-none');
                    }

                    updateTotal();
                }
            }

            // Checkout function
            function checkout() {
                const cartItems = document.querySelectorAll('.cart-item');
                if (cartItems.length === 0) {
                    alert('Keranjang Anda kosong!');
                    return;
                }

                if (confirm('Lanjutkan ke pembayaran?')) {
                    // Here you would typically redirect to payment page
                    alert('Mengarahkan ke halaman pembayaran...');
                    window.location.href = '/checkout';
                }
            }

            // Initialize total on page load
            document.addEventListener('DOMContentLoaded', function () {
                updateTotal();
            });
        </script>
</body>

</html>