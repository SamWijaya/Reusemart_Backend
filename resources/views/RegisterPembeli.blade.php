<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- FontAwesome CDN untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Bootstrap CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #0D5C4F;
            font-family: Arial, sans-serif;
        }
        
        .card {
            border: none;
            border-radius: 8px;
        }
        
        .input-group-text {
            border-radius: 4px 0 0 4px;
        }
        
        .form-control {
            border-radius: 0 4px 4px 0;
            height: 45px;
        }
        
        .btn-success {
            border-radius: 4px;
            font-weight: bold;
            height: 45px;
        }
        
        a.text-success:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded mt-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <a href="#">
                            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo" class="img-fluid" style="max-height: 50px;">
                        </a>
                    </div>
                    
                    <h2 class="text-center font-weight-bold mb-4">BUAT AKUN PEMBELI</h2>
                    
                    <form method="POST" action="{{ route('pembeli.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-user text-secondary"></i>
                                    </span>
                                </div>
                                <input id="NAMA_PEMBEI" type="text" class="form-control border-left-0" name="NAMA_PEMBELI" required placeholder="Masukkan Nama Anda">
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-envelope text-secondary"></i>
                                    </span>
                                </div>
                                <input id="EMAIL_PEMBELI" type="email" class="form-control border-left-0" name="EMAIL_PEMBELI" required placeholder="Masukkan Email Anda">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-phone text-secondary"></i>
                                    </span>
                                </div>
                                <input id="NOMOR_TELEPON" type="nomor" class="form-control border-left-0" name="NOMOR_TELEPON" required placeholder="Masukkan Nomor Anda">
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="fas fa-lock text-secondary"></i>
                                    </span>
                                </div>
                                <input id="PASSWORD_PEMBELI" type="password" class="form-control border-left-0" name="PASSWORD_PEMBELI" required placeholder="Masukkan Password Anda">
                            </div>
                        </div>
                        
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-success w-100 py-2" style="background-color: #8BC34A; border: none;">
                                SIGN UP
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Sudah Punya Akun? <a href="/login" class="text-success font-weight-bold" style="color: #8BC34A !important; text-decoration: none;">Login Disini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional script section --}}
<script>
    // Custom JavaScript here
</script>

{{-- Bootstrap JS CDN --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
