<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Penitip - ReuseMart</title>
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

        /* Right Column */
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Balance Card */
        .balance-card {
            text-align: center;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .balance-card::before {
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

        .balance-content {
            position: relative;
            z-index: 2;
        }

        .balance-amount {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .balance-label {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Points Card */
        .points-card {
            text-align: center;
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .points-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        .points-content {
            position: relative;
            z-index: 2;
        }

        .points-amount {
            font-size: 70px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .points-label {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 16px;
        }

        .points-info {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .exchange-btn {
            background: linear-gradient(135deg, #eab308 0%, #f59e0b 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(234, 179, 8, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .exchange-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
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
            <a href="/halamanPenitip">Halaman Penitipan</a>
            <a href="profilPenitip" class="active">Profil Akun</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Profil Penitip</h1>
            <p class="page-subtitle">Kelola informasi akun dan lihat perkembangan bisnis Anda</p>
        </div>

        <div class="profile-grid">
            <!-- Profile Card -->
            <div class="card" style="position: relative;">
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
                        <input type="text" id="nama" class="form-input" value="{{ $penitip->NAMA_PENITIP }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="telepon">Nomor Telepon</label>
                        <div class="form-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <input type="text" id="telepon" class="form-input" value="{{ $penitip->NOTELP_PENITIP }}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email</label>
                        <div class="form-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" class="form-input" value="{{ $penitip->EMAIL_PENITIP }}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="alamat">Alamat</label>
                        <div class="form-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <input type="text" id="alamat" class="form-input" value="{{ $penitip->ALAMAT_PENITIP }}"
                            readonly>
                    </div>
                </div>

                <!-- Tombol Logout di pojok kanan bawah card -->
                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="
            background-color: #e63946;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
            display: flex;
            align-items: center;
            cursor: pointer;
        ">
                            LogOut
                            <i class="fas fa-sign-out-alt" style="margin-left: 8px;"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <!-- Balance Card -->
                <div class="card balance-card">
                    <div class="balance-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: rgba(255, 255, 255, 0.2);">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <h2 class="card-title" style="color: white;">Saldo Anda</h2>
                        </div>

                        <div class="balance-amount">Rp{{ number_format($penitip->SALDO_PENITIP ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="balance-label">Total Saldo</div>
                    </div>
                </div>

                <!-- Points Card -->
                <div class="card points-card">
                    <div class="points-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: rgba(255, 255, 255, 0.2);">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h2 class="card-title" style="color: white;">Poin Reward</h2>
                        </div>

                        <div class="points-amount">{{ $penitip->POIN_PENITIP ?? 0 }}</div>
                        <div class="points-label">Total Poin Anda</div>
                        <div class="points-info">Tukarkan poin Anda dengan merchandise menarik!</div>

                        <button class="exchange-btn">
                            <i class="fas fa-exchange-alt"></i>
                            Tukar Poin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>