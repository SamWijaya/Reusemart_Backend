<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Verifikasi OTP</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0D5C4F;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Background Carousel */
        .background-carousel {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 0.7;
        }

        /* Overlay untuk memberikan efek transparan */
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(13, 92, 79, 0.8), rgba(13, 92, 79, 0.6));
            z-index: -1;
        }

        .container {
            display: flex;
            background-color: #E5E5E5;
            width: 80%;
            max-width: 900px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            height: 100%;
        }

        .left-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-section {
            flex: 1;
            background-color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .right-section .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-image {
            height: 60px;
            margin-right: 10px;
        }

        .right-section .logo-text {
            color: #0D5C4F;
            font-size: 22px;
            font-weight: bold;
        }

        .right-section .fast-easy {
            color: #666;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .input-with-icon {
            position: relative;
            width: 100%;
        }

        .input-with-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #AAA;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #DDD;
            border-radius: 5px;
            font-size: 16px;
            color: #666;
        }

        .form-control::placeholder {
            color: #AAA;
        }

        .role-dropdown {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #DDD;
            border-radius: 5px;
            font-size: 16px;
            color: #666;
            background-color: white;
            appearance: none;
        }

        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #AAA;
            pointer-events: none;
        }

        .login-btn {
            width: 100%;
            background-color: #8BC34A;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 14px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover {
            background-color: #7CB342;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: #333;
            text-decoration: none;
        }

        .register {
            text-align: center;
            margin-top: 20px;
        }

        .register a {
            color: #8BC34A;
            text-decoration: none;
            font-weight: bold;
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            width: 100%;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
    </style>
</head>
<body>
    <div class="background-carousel">
        <div class="carousel-slide active"
            style="background-image: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        </div>
        <div class="carousel-slide"
            style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        </div>
        <div class="carousel-slide"
            style="background-image: url('https://images.unsplash.com/photo-1472851294608-062f824d29cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        </div>
        <div class="carousel-slide"
            style="background-image: url('https://images.unsplash.com/photo-1607083206968-13611e3d76db?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')">
        </div>
    </div>

    <div class="background-overlay"></div>

    <div class="carousel-dots">
        <div class="dot active" data-slide="0"></div>
        <div class="dot" data-slide="1"></div>
        <div class="dot" data-slide="2"></div>
        <div class="dot" data-slide="3"></div>
        <div class="dot" data-slide="4"></div>
    </div>

    <div class="container">
        <div class="left-section">
            <img src="/img/Login Page Left.png" alt="Left Section">
        </div>

        <div class="right-section">
            <div class="logo-container">
                <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo" class="logo-image">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <p style="text-align: center; color: #666; margin-bottom: 20px;">
                Kami telah mengirimkan kode OTP ke email Anda:<br>
                <strong style="color: #333;">{{ $email }}</strong>
            </p>

            <form class="login-form" method="POST" action="{{ route('login.otp.verify') }}">
                @csrf

                <div class="form-group">
                    <label for="otp">Kode OTP</label>
                    <div class="input-with-icon">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>
                        </i>
                        <input type="text" class="form-control" id="otp" name="otp" 
                               placeholder="Masukkan 6 digit kode OTP" required maxlength="6"
                               style="letter-spacing: 5px; text-align: center; padding-left: 12px;">
                    </div>
                </div>

                <div class="form-group">
                    <div style="display: flex; width: 100%;">
                        <button type="submit" class="login-btn"
                            style="margin-top: 0; margin-bottom: 15px; margin-top: 17px;">
                            VERIFIKASI
                        </button>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="{{ route('login.otp.resend') }}">Tidak menerima kode? Kirim Ulang OTP</a>
                </div>

                <div class="register" style="margin-top: 20px;">
                    Salah akun? <a href="{{ route('login.form') }}" style="color: #CC3333;">Kembali ke Login</a>
                </div>
            </form>
        </div>
        </div>

    <div id="register-modal" class="modal">
        </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        let carouselInterval;
        function startCarousel() {
            carouselInterval = setInterval(nextSlide, 5000);
        }
        function stopCarousel() {
            clearInterval(carouselInterval);
        }
        setInterval(nextSlide, 5000);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        const container = document.querySelector('.container');
        container.addEventListener('mouseenter', stopCarousel);
        container.addEventListener('mouseleave', startCarousel);
        startCarousel();

    </script>
</body>
</html>