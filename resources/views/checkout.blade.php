<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ReUseMart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Header styles */
        header {
            background-color: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 18px;
        }

        .nav-links a.active {
            color: #1e5631;
            font-weight: 600;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo img {
            height: 40px;
        }

        body {
            background-color: #f8f9fa;
        }

        .checkout-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-summary-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .form-check-input:checked {
            background-color: #1e5631;
            border-color: #1e5631;
        }

        .btn-primary {
            background: linear-gradient(45deg, #1e5631, #2d7a47);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 86, 49, 0.4);
        }

        .points-input {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .points-input:focus {
            border-color: #1e5631;
            box-shadow: 0 0 0 0.2rem rgba(30, 86, 49, 0.25);
        }

        .address-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-card:hover {
            border-color: #1e5631;
            background-color: #f8f9fa;
        }

        .address-card.selected {
            border-color: #1e5631;
            background-color: #e8f5e8;
        }

        .product-item {
            border-bottom: 1px solid #e9ecef;
            padding: 15px 0;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .shipping-option {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .shipping-option:hover {
            border-color: #1e5631;
        }

        .shipping-option.selected {
            border-color: #1e5631;
            background-color: #e8f5e8;
        }

        .points-reward-section {
            background: linear-gradient(135deg, #1e5631 0%, #2d7a47 100%);
            border: 2px solid #1e5631;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            color: white;
        }

        .points-reward-section h6 {
            color: white;
            margin-bottom: 10px;
        }

        .points-breakdown {
            font-size: 0.9em;
            color: #e9ecef;
        }

        .bonus-points {
            color: #90ee90;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <div class="nav-links">
            <a href="/halamanPembeli">Beranda</a>
            <a href="#" class="active">Keranjang</a>
            <a href="#">History</a>
            <a href="/profilPembeli">Profil Akun</a>
        </div>
    </header>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="fs-3 fw-bold mb-4">
                    <i class="bi bi-credit-card me-2"></i>Checkout
                </h2>
            </div>
        </div>

        <div class="row">
            <!-- Main Checkout Section -->
            <div class="col-lg-8">
                <!-- Shipping Method -->
                <div class="checkout-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-truck me-2"></i>Metode Pengiriman
                        </h5>

                        <div class="shipping-option" onclick="selectShipping('pickup', event)">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="pickup" value="pickup">
                                <label class="form-check-label fw-semibold" for="pickup">
                                    <i class="bi bi-bag-check me-2"></i>Ambil Sendiri
                                </label>
                            </div>
                            <small class="text-muted ms-4">Gratis - Ambil di toko kami</small>
                        </div>

                        <div class="shipping-option" onclick="selectShipping('delivery', event)">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="delivery"
                                    value="delivery">
                                <label class="form-check-label fw-semibold" for="delivery">
                                    <i class="bi bi-truck me-2"></i>Dikirim
                                </label>
                            </div>
                            <small class="text-muted ms-4">Rp100.000 - Dikirim ke alamat Anda</small>
                        </div>
                    </div>
                </div>

                <!-- Address Selection (Hidden by default) -->
                <div id="addressSection" class="checkout-card d-none">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-geo-alt me-2"></i>Pilih Alamat Pengiriman
                        </h5>

                        @foreach ($alamat as $address)
                            <div class="address-card {{ $address->IS_DEFAULT ? 'selected' : '' }}"
                                onclick="selectAddress({{ $address->ID_ALAMAT }})">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="address"
                                        id="address{{ $address->ID_ALAMAT }}" value="{{ $address->ID_ALAMAT }}" {{ $address->IS_DEFAULT ? 'checked' : '' }}>
                                    <label class="form-check-label" for="address{{ $address->ID_ALAMAT }}">
                                        <div class="fw-semibold">
                                            {{ $address->LABEL_ALAMAT }}
                                            @if ($address->IS_DEFAULT)
                                                <span class="badge bg-warning ms-2">Utama</span>
                                            @endif
                                        </div>
                                        <div class="text-muted">{{ $address->NAMA_JALAN }}</div>
                                        <div class="text-muted">Phone: {{ $address->KECAMATAN }}</div>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Points Section -->
                <div class="checkout-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-star me-2"></i>Tukar Poin
                        </h5>

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="mb-2">Poin Tersedia:
                                    <span class="fw-bold text-success">{{ number_format($pembeli->POIN_PEMBELI) }}
                                        poin</span>
                                </p>
                                <small class="text-muted">100 poin = Rp10.000 potongan harga</small>
                            </div>
                            <div class="col-md-6">
                                @php
                                    $rawPoin = $pembeli->POIN_PEMBELI ?? 0;
                                    $maxPoin = floor($rawPoin / 100) * 100;
                                @endphp
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="adjustPoints(-100)">-</button>
                                    <input type="number" class="form-control points-input" id="pointsInput" min="0"
                                        max="{{ $maxPoin }}" step="100" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="adjustPoints(100)">+</button>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="useMaxPoints()">Max</button>
                                </div>
                                <small class="text-muted">Potongan: <span id="pointsDiscount">Rp0</span></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary-card">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 text-dark">
                            <i class="bi bi-receipt me-2"></i>Ringkasan Pesanan
                        </h5>

                        <!-- Product List -->
                        <div class="mb-4">
                            @foreach ($keranjang as $item)
                                <div class="product-item mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item->barang->GAMBAR_1) }}"
                                            alt="{{ $item->barang->NAMA_BARANG }}" class="product-img me-3"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-dark">{{ $item->barang->NAMA_BARANG }}</div>
                                        </div>
                                        <div class="fw-bold text-dark">
                                            Rp{{ number_format($item->barang->HARGA_BARANG, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <!-- Price Breakdown -->
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-dark">Subtotal:</span>
                                <span class="text-dark" id="subtotal">{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" id="shippingFee">
                                <span class="text-dark">Ongkos Kirim:</span>
                                <span class="text-dark" id="shippingAmount">Rp0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" id="pointsDiscountRow"
                                style="display: none;">
                                <span class="text-dark">Potongan Poin:</span>
                                <span class="text-warning">-<span id="totalPointsDiscount">Rp0</span></span>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5 text-dark">Total:</span>
                                <span class="fw-bold fs-4 text-dark"
                                    id="finalTotal">{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Points Reward Section -->
                        <div class="points-reward-section">
                            <h6><i class="bi bi-gift me-2"></i>Poin yang Akan Didapat</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Poin Dasar:</span>
                                <span id="basePoints" class="fw-bold">0 poin</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" id="bonusPointsRow">
                                <span>Bonus Poin (20%):</span>
                                <span id="bonusPoints" class="bonus-points">+0 poin</span>
                            </div>
                            <hr class="my-2" style="border-color: #90ee90;">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Poin:</span>
                                <span id="totalPoints" class="fw-bold" style="color: #90ee90;">0 poin</span>
                            </div>
                            <div class="points-breakdown mt-2">
                                <small>
                                    <i class="bi bi-info-circle me-1"></i>
                                    1 poin = Rp10.000 | Bonus 20% untuk pembelian > Rp500.000
                                </small>
                            </div>
                        </div>

                        <form id="checkoutForm" method="POST" action="{{ route('pembelian.store') }}">
                            @csrf

                            <input type="hidden" name="ID_ALAMAT" id="alamatIdInput">
                            <input type="hidden" name="METODE_PENGIRIMAN" id="shippingMethodInput">
                            <input type="hidden" name="POIN_DIGUNAKAN" id="poinInput">
                            <input type="hidden" name="SUBTOTAL" id="subtotalInput">
                            <input type="hidden" name="TOTAL_BAYAR" id="totalBayarInput">
                            <input type="hidden" name="POIN_DIDAPAT" id="poinDidapatInput">


                            {{-- Tombol Bayar --}}
                            <button type="submit" class="btn btn-success w-100 fw-bold mt-3"
                                onclick="proceedToPayment(event)">
                                <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const baseSubtotal = {{ $subtotal }};
        let currentShipping = 0;
        let currentPointsDiscount = 0;
        let total = 0;
        let totalPoints = 0;

        // Format currency function
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount).replace('IDR', 'Rp');
        }

        // Format number with thousand separator
        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Calculate points to be earned - UPDATED: Only based on subtotal (excluding shipping)
        function calculatePointsReward() {
            // Hitung berdasarkan subtotal setelah potongan poin, tanpa ongkir
            const pointsEligibleAmount = baseSubtotal - currentPointsDiscount;

            // Poin dasar: 1 poin per Rp10.000
            const basePoints = Math.floor(pointsEligibleAmount / 10000);

            // Bonus poin 20% jika pembelian > Rp500.000
            let bonusPoints = 0;
            let showBonus = false;
            if (pointsEligibleAmount > 500000) {
                bonusPoints = Math.floor(basePoints * 0.2);
                showBonus = true;
            }

            totalPoints = basePoints + bonusPoints;

            // Update tampilan poin reward
            document.getElementById('basePoints').textContent = formatNumber(basePoints) + ' poin';
            document.getElementById('bonusPoints').textContent = '+' + formatNumber(bonusPoints) + ' poin';
            document.getElementById('totalPoints').textContent = formatNumber(totalPoints) + ' poin';

            // Tampilkan/hide baris bonus poin
            document.getElementById('bonusPointsRow').style.display = showBonus ? 'flex' : 'none';
        }

        // Select shipping method
        function selectShipping(method, event) {
            // Update radio button
            document.querySelectorAll('input[name="shipping"]').forEach(radio => {
                radio.checked = radio.value === method;
            });

            // Update visual selection
            document.querySelectorAll('.shipping-option').forEach(option => {
                option.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');

            // Tampilkan/hidden bagian alamat dan atur ongkir
            if (method === 'delivery') {
                document.getElementById('addressSection').classList.remove('d-none');

                // Jika subtotal >= 1.500.000, gratis ongkir
                if (baseSubtotal >= 1500000) {
                    currentShipping = 0;
                } else {
                    currentShipping = 100000;
                }
            } else {
                document.getElementById('addressSection').classList.add('d-none');
                currentShipping = 0;
            }

            // Selalu tampilkan biaya pengiriman
            document.getElementById('shippingFee').style.display = 'flex';
            document.getElementById('shippingAmount').textContent = formatCurrency(currentShipping);

            updateTotal();
        }


        // Select address
        function selectAddress(addressId) {
            document.querySelectorAll('input[name="address"]').forEach(radio => {
                radio.checked = radio.value == addressId;
            });

            document.querySelectorAll('.address-card').forEach(card => {
                card.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        // Handle points input
        const rawPoin = {{ $rawPoin }};
        const maxPoin = {{ $maxPoin }};

        function updateDiscount(points) {
            // Batasi points sesuai maxPoin dan kelipatan 100
            points = Math.min(Math.max(0, Math.floor(points / 100) * 100), maxPoin);

            // Hitung potongan poin (100 poin = Rp10.000)
            let potongan = (points / 100) * 10000;

            // Simpan potongan global
            currentPointsDiscount = potongan;

            // Update tampilan potongan poin
            document.getElementById('pointsDiscount').innerText = formatCurrency(potongan);
            document.getElementById('totalPointsDiscount').innerText = formatCurrency(potongan);

            if (potongan > 0) {
                document.getElementById('pointsDiscountRow').style.display = 'flex';
            } else {
                document.getElementById('pointsDiscountRow').style.display = 'none';
            }

            // Update nilai input poin supaya konsisten
            document.getElementById('pointsInput').value = points;

            // Update total pembayaran
            updateTotal();
        }

        // Fungsi tambah/kurang poin dengan tombol
        function adjustPoints(change) {
            let input = document.getElementById('pointsInput');
            let current = parseInt(input.value) || 0;
            let newValue = current + change;

            if (newValue >= 0 && newValue <= maxPoin) {
                updateDiscount(newValue);
            }
        }

        // Fungsi gunakan poin maksimal
        function useMaxPoints() {
            updateDiscount(maxPoin);
        }

        // Update total calculation
        function updateTotal() {
            total = baseSubtotal + currentShipping - currentPointsDiscount;
            document.getElementById('finalTotal').textContent = formatCurrency(total);

            // Update poin reward sesuai total produk setelah diskon poin
            calculatePointsReward();
        }

        // Proceed to payment - now directly processes the order
        function proceedToPayment(event) {
            event.preventDefault();

            const shippingMethod = document.querySelector('input[name="shipping"]:checked');
            if (!shippingMethod) {
                alert('Silakan pilih metode pengiriman!');
                return;
            }

            if (shippingMethod.value === 'delivery') {
                const selectedAddress = document.querySelector('input[name="address"]:checked');
                if (!selectedAddress) {
                    alert('Silakan pilih alamat pengiriman!');
                    return;
                }
                document.getElementById('alamatIdInput').value = selectedAddress.value;
            }

            const poin = document.getElementById('pointsInput').value || 0;
            document.getElementById('poinInput').value = poin;

            const methodValue = shippingMethod.value === 'delivery' ? 1 : 0;
            document.getElementById('shippingMethodInput').value = methodValue;

            // Isi input hidden lainnya
            document.getElementById('subtotalInput').value = baseSubtotal;
            document.getElementById('totalBayarInput').value = total;
            document.getElementById('poinDidapatInput').value = totalPoints;

            document.getElementById('checkoutForm').submit();
        }



        // Initialize shipping fee display and points calculation
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('shippingFee').style.display = 'flex';
            document.getElementById('shippingAmount').textContent = formatCurrency(0);
            currentShipping = 0;
            updateDiscount(0);
            updateTotal();
        });
    </script>
</body>

</html>