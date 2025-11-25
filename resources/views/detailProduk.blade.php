<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Produk - ReUseMart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            margin-top: 15px;
            width: 95%;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #5a6268;
            color: white;
            text-decoration: none;
            transform: translateX(-2px);
        }

        .product-detail-img {
            max-width: 95%;
            width: 260px;
            /* Ubah sesuai kebutuhan */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin-bottom: 10%;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 15px;
        }

        .product-description {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.5;
        }

        .product-info {
            margin-top: 10px;
        }

        .product-info p {
            font-weight: 500;
        }

        .comment-section {
            margin-top: 3rem;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .comment-header {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        /* Styling untuk area diskusi yang scrollable */
        #discussion {
            max-height: 300px;
            /* Batasi tinggi maksimal */
            overflow-y: auto;
            /* Aktifkan scroll vertikal */
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
            margin-bottom: 15px;
        }

        /* Custom scrollbar styling */
        #discussion::-webkit-scrollbar {
            width: 8px;
        }

        #discussion::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #discussion::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        #discussion::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .comment-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            font-size: 1rem;
            background-color: #f1f1f1;
            resize: vertical;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .add-to-cart-btn {
            background-color: #28a745;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            cursor: pointer;
            transition: all 0.3s;
            width: 95%;
            margin-top: 20px;
            box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .add-to-cart-btn:active {
            transform: translateY(0);
        }

        .comment-item {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #007bff;
        }

        .comment-item strong {
            color: #007bff;
        }

        .comment-item p {
            margin-top: 5px;
            margin-bottom: 0;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .product-detail-img {
                margin-bottom: 20px;
            }

            #discussion {
                max-height: 250px;
                /* Tinggi lebih kecil untuk mobile */
            }
        }

        .alert {
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="container mt-4">


        <div class="row">
            <div class="col-md-6">
                <!-- Carousel untuk gambar produk -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Gambar 1 -->
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $produk->GAMBAR_2) }}"
                                class="d-block w-100 product-detail-img" alt="{{ $produk->NAMA_BARANG }}">
                        </div>
                        <!-- Gambar 2 -->

                        <div class="carousel-item">
                            <img src="{{ asset('storage/' . $produk->GAMBAR_3) }}"
                                class="d-block w-100 product-detail-img" alt="{{ $produk->NAMA_BARANG }} Gambar 2">
                        </div>

                    </div>

                    <!-- Kontrol carousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Button Masukkan ke Keranjang -->
                @if (session('user_type') === 'pembeli')
                    <form action="{{ route('keranjang.tambah', $produk->ID_BARANG) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">
                            🛒 Masukkan ke Keranjang
                        </button>
                    </form>

                @endif

                @if (session('user_type') === 'pembeli')
                    <!-- Tombol Back -->
                    <a href="/halamanPembeli" class="back-btn">
                        Kembali Ke Halaman Utama
                    </a>
                @endif

                @if (session('user_type') === 'pegawai')
                    <!-- Tombol Back -->
                    <a href="{{ route('cs.diskusi.index') }}" class="back-btn">
                        Kembali
                    </a>
                @endif
            </div>

            <div class="col-md-6">
                <h2 class="product-title">{{ $produk->NAMA_BARANG }}</h2>
                <p class="product-price text-danger fw-bold">Rp{{ number_format($produk->HARGA_BARANG, 0, ',', '.') }}
                </p>
                <p class="product-description">Deskripsi: {{ $produk->DESKRIPSI_BARANG ?? 'Tidak ada deskripsi.' }}</p>

                <div class="product-info">
                    <p class="fw-bold">Garansi: {{ $produk->GARANSI ?? 'Tidak ada informasi' }}</p>
                    <p class="fw-bold">Berat (Kg): {{ $produk->BERAT ?? 'N/A' }}</p>
                </div>

                <!-- Diskusi / Komentar -->
                <div class="comment-section mt-4">
                    <div class="comment-header fs-5 fw-semibold mb-2">Diskusi Produk</div>
                    <div class="discussion-container mb-3"
                        style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; background-color: #f9f9f9;">
                        @foreach ($discussions as $d)
                            <div class="comment-item border rounded p-2 mb-2">
                                @if ($d->ID_PEGAWAI)
                                    <strong>CS:</strong>
                                @else
                                    {{-- Tampilkan nama pembeli yang mengirim pesan --}}
                                    <strong>{{ $d->pembeli->NAMA_PEMBELI ?? 'Pembeli' }}:</strong>
                                @endif
                                <p class="mb-0">{{ $d->PESAN }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if (session('user_type') === 'pembeli')
                        <!-- Form input diskusi hanya untuk pembeli yang login -->
                        <form action="{{ route('diskusi.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="ID_BARANG" value="{{ $produk->ID_BARANG }}">
                            <textarea name="PESAN" class="form-control mb-2" rows="2" placeholder="Tulis pesan diskusi..."
                                required></textarea>
                            <button type="submit" class="btn btn-sm btn-success">Kirim Komentar</button>
                        </form>
                    @endif

                    @if (session('user_type') === 'pegawai')
                        <!-- Form untuk CS -->
                        <form action="{{ route('diskusi.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="ID_BARANG" value="{{ $produk->ID_BARANG }}">
                            <textarea name="PESAN" class="form-control mb-2" rows="2" placeholder="Tulis tanggapan CS..."
                                required></textarea>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim Tanggapan CS</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let comments = [
            { user: "Pembeli1", text: "Apakah produk ini masih tersedia?" },
            { user: "CS", text: "Ya, produk ini masih tersedia." }
        ];

        function displayComments() {
            const discussionDiv = document.getElementById('discussion');
            discussionDiv.innerHTML = "";
            comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.classList.add('comment-item');
                commentElement.innerHTML = `<strong>${comment.user}:</strong> <p>${comment.text}</p>`;
                discussionDiv.appendChild(commentElement);
            });

            // Auto scroll ke bawah setelah menambah komentar baru
            discussionDiv.scrollTop = discussionDiv.scrollHeight;
        }

        function submitComment() {
            const commentInput = document.getElementById('commentInput');
            const newComment = commentInput.value.trim();
            if (newComment) {
                comments.push({ user: "Pembeli", text: newComment });
                commentInput.value = '';
                displayComments();
            }
        }

        // Event listener untuk Enter key
        document.getElementById('commentInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                submitComment();
            }
        });

        function addToCart() {
            // Simulasi menambahkan ke keranjang
            alert('Produk berhasil ditambahkan ke keranjang!');
            console.log('Product added to cart:', {
                name: 'IPhone 16 Pro Max',
                price: 'Rp16.000.000',
                quantity: 1
            });
        }

        function goBack() {
            // Fungsi untuk kembali ke halaman sebelumnya
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Jika tidak ada history, arahkan ke halaman utama atau halaman produk
                window.location.href = 'index.html'; // Ganti dengan URL halaman utama Anda
            }
        }

        displayComments();
    </script>

</body>

</html>