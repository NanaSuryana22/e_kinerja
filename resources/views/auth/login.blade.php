<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem E-Kinerja Pegawai</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background: white;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header i {
            font-size: 3rem;
            color: #435ebe;
        }
        .login-header h2 {
            font-weight: 700;
            color: #25396f;
            margin-top: 10px;
            font-size: 1.5rem;
        }
        .btn-login {
            background-color: #435ebe;
            border: none;
            padding: 0.8rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #364b98;
            transform: translateY(-2px);
        }
        .form-control {
            padding: 0.8rem 1rem;
            border-radius: 8px;
        }
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-person-workspace"></i>
            <h2>E-Kinerja Pegawai</h2>
            <p class="text-muted small">Silakan masuk untuk mengelola laporan kinerja Anda</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 px-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-secondary small fw-bold">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" placeholder="nama@perusahaan.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-secondary small fw-bold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-login text-white">
                    MASUK KE SISTEM
                </button>
            </div>
        </form>

        <div class="footer-text">
            &copy; {{ date('Y') }} Sistem E-Kinerja Pegawai <br>
            <strong><a href="https://portfolio-nana-suryana.vercel.app/" target="_blank">Nana Suryana</strong>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>