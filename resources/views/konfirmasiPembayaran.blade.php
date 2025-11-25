<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - ReUseMart</title>
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

        .payment-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .countdown-card {
            background: linear-gradient(135deg, #FFB300 0%, #FFEA00 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
        }

        .countdown-timer {
            font-size: 3rem;
            font-weight: bold;
            margin: 15px 0;
        }

        .order-summary-card {
            background: linear-gradient(135deg, #1e5631 0%, #2d7a47 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(30, 86, 49, 0.3);
            position: sticky;
            top: 20px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #1e5631, #2d7a47);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 86, 49, 0.4);
        }

        .bank-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .bank-card:hover {
            border-color: #1e5631;
            background-color: #f8f9fa;
        }

        .upload-area {
            border: 2px dashed #1e5631;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            background-color: #e8f5e8;
        }

        .upload-area.dragover {
            border-color: #2d7a47;
            background-color: #e8f5e8;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #1e5631;
        }

        .step-number {
            background-color: #1e5631;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            display: none;
        }

        .file-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .uploaded-file {
            background-color: #e8f5e8;
            border: 1px solid #1e5631;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }

        .copy-item {
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .copy-item:hover {
            background-color: rgba(30, 86, 49, 0.1);
            border-radius: 4px;
        }

        .copy-icon {
            transition: all 0.3s ease;
        }

        .copy-success {
            color: #28a745 !important;
        }

        /* Custom Accordion Styles */
        .custom-accordion .accordion-item {
            border: 1px solid #e9ecef;
            border-radius: 10px !important;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-accordion .accordion-header .accordion-button {
            background: white;
            color: #1e5631;
            border-radius: 10px !important;
            font-weight: 600;
            padding: 15px 20px;
            border: none;
            transition: all 0.3s ease;
        }

        .custom-accordion .accordion-header .accordion-button:hover {
            background-color: #f8f9fa;
        }

        .custom-accordion .accordion-header .accordion-button:not(.collapsed) {
            background: white;
            color: #1e5631;
            box-shadow: none;
            border-bottom: 1px solid #e9ecef;
            border-radius: 10px 10px 0 0 !important;
        }

        .custom-accordion .accordion-header .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(30, 86, 49, 0.25);
            border-color: transparent;
        }

        .custom-accordion .accordion-header .accordion-button::after {
            filter: none;
            color: #1e5631;
        }

        .custom-accordion .accordion-body {
            padding: 20px;
            background-color: #fafafa;
            border-radius: 0 0 10px 10px;
        }

        .custom-accordion .accordion-collapse {
            border-radius: 0 0 10px 10px;
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
        <!-- Order Status (Hidden initially, shown when cancelled) -->
        <div id="cancelledStatus" class="status-cancelled">
            <i class="bi bi-x-circle-fill" style="font-size: 3rem; margin-bottom: 15px;"></i>
            <h3>Pesanan Dibatalkan</h3>
            <p>Waktu pembayaran telah habis. Pesanan Anda telah dibatalkan secara otomatis.</p>
            <button class="btn btn-light mt-3" onclick="window.location.href='{{ route('batal.beli', ['id' => $pembelian->ID_PEMBELIAN]) }}'">
                Kembali ke Beranda
            </button>
        </div>

        <!-- Main Payment Section -->
        <div id="paymentSection">
            <!-- Countdown Timer -->
            <div class="countdown-card">
                <h4><i class="bi bi-clock-fill me-2"></i>Selesaikan Pembayaran Dalam</h4>
                <div class="countdown-timer" id="countdown">01:00</div>
                <p class="mb-0">Pesanan akan dibatalkan otomatis jika waktu habis</p>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2 class="fs-3 fw-bold mb-4">
                        <i class="bi bi-credit-card me-2"></i>Konfirmasi Pembayaran
                    </h2>
                </div>
            </div>

            <div class="row">
                <!-- Payment Instructions -->
                <div class="col-lg-8">
                    <!-- Bank Transfer Information -->
                    <div class="payment-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-bank me-2"></i>Informasi Transfer Bank
                            </h5>

                            <div class="bank-card">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://logo.clearbit.com/bca.co.id" alt="BCA"
                                        style="width: 40px; height: 40px; margin-right: 15px;">
                                    <div>
                                        <div class="fw-bold">Bank Central Asia (BCA)</div>
                                        <div class="text-muted">a.n. ReUseMart Indonesia</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">Nomor Rekening:</small>
                                        <div class="fw-bold fs-5 copy-item"
                                            onclick="copyToClipboard('1234567890', 'rekening')">
                                            1234567890
                                            <i class="bi bi-clipboard text-primary copy-icon" id="rekening-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Jumlah Transfer:</small>
                                        <div class="fw-bold fs-5 text-danger copy-item"
                                            onclick="copyToClipboard({{ $pembelian->TOTAL_BAYAR }}, 'jumlah')">
                                            Rp {{ number_format($pembelian->TOTAL_BAYAR, 0, ',', '.') }}
                                            <i class="bi bi-clipboard text-primary copy-icon" id="jumlah-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions with Accordion -->
                    <div class="payment-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">
                                <i class="bi bi-list-check me-2"></i>Cara Pembayaran
                            </h5>

                            <div class="accordion custom-accordion" id="paymentAccordion">
                                <!-- ATM Instructions -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#atmCollapse"
                                            aria-expanded="false" aria-controls="atmCollapse">
                                            <i class="bi bi-credit-card me-2"></i>
                                            Pembayaran Melalui ATM
                                        </button>
                                    </h2>
                                    <div id="atmCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#paymentAccordion">
                                        <div class="accordion-body">
                                            <div class="step-item">
                                                <div class="step-number">1</div>
                                                <div>
                                                    <strong>Masukkan kartu ATM</strong> dan PIN Anda
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">2</div>
                                                <div>
                                                    Pilih menu <strong>"Transfer"</strong> → <strong>"Ke Bank
                                                        Lain"</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">3</div>
                                                <div>
                                                    Masukkan <strong>kode bank</strong> + <strong>nomor rekening
                                                        tujuan</strong>
                                                    <br><small class="text-muted">BCA: 014, Mandiri: 008</small>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">4</div>
                                                <div>
                                                    Masukkan jumlah transfer: <strong>sesuai nominal pembayaran</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">5</div>
                                                <div>
                                                    Konfirmasi transfer dan <strong>simpan bukti transfer</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile Banking Instructions -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#mobileCollapse"
                                            aria-expanded="false" aria-controls="mobileCollapse">
                                            <i class="bi bi-phone me-2"></i>
                                            Pembayaran Melalui Mobile Banking
                                        </button>
                                    </h2>
                                    <div id="mobileCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#paymentAccordion">
                                        <div class="accordion-body">
                                            <div class="step-item">
                                                <div class="step-number">1</div>
                                                <div>
                                                    Buka aplikasi <strong>mobile banking</strong> Anda
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">2</div>
                                                <div>
                                                    Login dengan <strong>username</strong> dan <strong>password</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">3</div>
                                                <div>
                                                    Pilih menu <strong>"Transfer"</strong> → <strong>"Transfer Bank
                                                        Lain"</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">4</div>
                                                <div>
                                                    Masukkan <strong>nomor rekening</strong> dan <strong>jumlah
                                                        transfer</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">5</div>
                                                <div>
                                                    Konfirmasi dengan <strong>PIN/Token</strong> dan screenshot bukti
                                                    transfer
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Internet Banking Instructions -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#internetCollapse"
                                            aria-expanded="false" aria-controls="internetCollapse">
                                            <i class="bi bi-globe me-2"></i>
                                            Pembayaran Melalui Internet Banking
                                        </button>
                                    </h2>
                                    <div id="internetCollapse" class="accordion-collapse collapse"
                                        data-bs-parent="#paymentAccordion">
                                        <div class="accordion-body">
                                            <div class="step-item">
                                                <div class="step-number">1</div>
                                                <div>
                                                    Akses website <strong>internet banking</strong> bank Anda
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">2</div>
                                                <div>
                                                    Login dengan <strong>User ID</strong> dan <strong>Password</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">3</div>
                                                <div>
                                                    Pilih menu <strong>"Transfer"</strong> → <strong>"Transfer Antar
                                                        Bank"</strong>
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">4</div>
                                                <div>
                                                    Isi data rekening tujuan dan jumlah transfer
                                                </div>
                                            </div>
                                            <div class="step-item">
                                                <div class="step-number">5</div>
                                                <div>
                                                    Konfirmasi dengan <strong>Token/SMS OTP</strong> dan simpan bukti
                                                    transfer
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Payment Proof -->
                    <form id="paymentForm" action="{{ route('upload.bukti', ['id' => $pembelian->ID_PEMBELIAN]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="payment-card">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="bi bi-cloud-upload me-2"></i>Upload Bukti Pembayaran
                                </h5>

                                <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                                    <div id="uploadContent">
                                        <i class="bi bi-cloud-upload"
                                            style="font-size: 3rem; color: #1e5631; margin-bottom: 15px;"></i>
                                        <h6>Klik untuk upload atau drag & drop</h6>
                                        <p class="text-muted mb-0">Format: JPG, PNG, PDF (Max 5MB)</p>
                                    </div>
                                </div>

                                <input type="file" id="fileInput" name="BUKTI_PEMBAYARAN" accept=".jpg,.jpeg,.png,.pdf"
                                    style="display: none;" onchange="handleFileUpload(this)">

                                <div id="uploadedFile" class="uploaded-file" style="display: none;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark-check me-2 text-success"></i>
                                            <span id="fileName"></span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="removeFile()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <img id="filePreview" class="file-preview"
                                        style="display: none; max-width: 200px; margin-top: 10px;">
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-3" id="confirmPaymentBtn"
                                    disabled>
                                    <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="order-summary-card text-white">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-receipt me-2"></i>Detail Pesanan
                            </h5>

                            <div class="mb-3">
                                <small class="opacity-75">Order ID:</small>
                                <div class="fw-bold">#PB000{{ $pembelian->ID_PEMBELIAN }}</div>
                            </div>

                            <div class="mb-3">
                                <small class="opacity-75">Metode Pengiriman:</small>
                                <div class="fw-bold">
                                    {{ $pembelian->METODE_PENGIRIMAN ? 'Delivery' : 'Pickup' }}
                                </div>

                            </div>

                            <div class="mb-4">
                                <small class="opacity-75">Alamat Pengiriman:</small>
                                <div class="fw-bold">
                                    @if ($pembelian->METODE_PENGIRIMAN)
                                        {{ $pembelian->alamat->NAMA_JALAN }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>{{ number_format($pembelian->SUBTOTAL, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim:</span>
                                    <span>
                                        @if ($pembelian->METODE_PENGIRIMAN && $pembelian->SUBTOTAL < 1500000)
                                            Rp{{ number_format(100000, 0, ',', '.') }}
                                        @else
                                            Rp0
                                        @endif
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span>Potongan Poin:</span>
                                    <span class="text-warning">
                                        -Rp{{ number_format($pembelian->POIN_DIGUNAKAN * 100, 0, ',', '.') }}
                                    </span>
                                </div>

                                <hr class="my-3">
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="fw-bold fs-5">Total Bayar:</span>
                                    <span
                                        class="fw-bold fs-4">{{ number_format($pembelian->TOTAL_BAYAR, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="alert alert-warning text-dark mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <small>Transfer sesuai jumlah exact untuk mempercepat verifikasi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran Berhasil -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <i class="bi bi-check-circle-fill text-success mb-3" style="font-size: 3rem;"></i>
                    <h5 class="mb-3">Pembayaran Berhasil!</h5>
                    <p>Terima kasih, bukti pembayaran Anda telah dikirim. Kami akan memverifikasi dalam 1x24 jam.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Countdown Timer
        let timeLeft = 60; // 1 minute in seconds
        let countdownInterval;

        function startCountdown() {
            countdownInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    cancelOrder();
                    return;
                }

                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                const display = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                document.getElementById('countdown').textContent = display;
                timeLeft--;
            }, 1000);
        }

        function cancelOrder() {
            document.getElementById('paymentSection').style.display = 'none';
            document.getElementById('cancelledStatus').style.display = 'block';
        }

        // Copy to clipboard function with visual feedback
        function copyToClipboard(text, iconId) {
            navigator.clipboard.writeText(text).then(() => {
                const icon = document.getElementById(iconId + '-icon');

                // Change icon to check mark
                icon.className = 'bi bi-check-circle-fill copy-success';

                // Reset icon after 2 seconds
                setTimeout(() => {
                    icon.className = 'bi bi-clipboard text-primary copy-icon';
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin: ', err);
            });
        }

        // File upload handling
        function handleFileUpload(input) {
            const file = input.files[0];
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                return;
            }

            document.getElementById('fileName').textContent = file.name;
            document.getElementById('uploadedFile').style.display = 'block';
            document.getElementById('confirmPaymentBtn').disabled = false;

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('filePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('filePreview').style.display = 'none';
            }
        }

        function removeFile() {
            document.getElementById('fileInput').value = '';
            document.getElementById('uploadedFile').style.display = 'none';
            document.getElementById('confirmPaymentBtn').disabled = true;
            document.getElementById('filePreview').style.display = 'none';
        }

        // Drag and Drop Support
        const uploadArea = document.querySelector('.upload-area');
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('fileInput').files = files;
                handleFileUpload(document.getElementById('fileInput'));
            }
        });

        @if (session('payment_success'))
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();

            // Redirect ke halaman utama pembeli setelah 3 detik
            setTimeout(() => {
                window.location.href = "{{ route('halamanPembeli') }}";
            }, 3000);
        @endif

        // Start countdown when page loads
        window.addEventListener('load', () => {
            startCountdown();
        });
    </script>
</body>

</html>