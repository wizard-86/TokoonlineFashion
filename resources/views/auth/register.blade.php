<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URBAN VIBE | Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #0b0b0b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 520px;
            background: #121212;
            border: 1px solid #222;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 0 30px rgba(0,0,0,.4);
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .text-primary-custom {
            color: #0d6efd;
        }

        .form-control,
        .form-select {
            background: #1a1a1a;
            border: 1px solid #2d2d2d;
            color: white;
            padding: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            background: #1f1f1f;
            color: white;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
        }

        .form-control::placeholder {
            color: #777;
        }

        .btn-register {
            background: #0d6efd;
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            transition: .3s;
        }

        .btn-register:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }

        .login-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="register-card">

    <div class="text-center mb-4">
        <h1 class="brand-title">
            URBAN <span class="text-primary-custom">VIBE</span>
        </h1>
        <p class="text-secondary mb-0">
            Buat akun baru dan mulai belanja streetwear premium
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Masukkan nama lengkap"
                   value="{{ old('name') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Masukkan email"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   placeholder="08xxxxxxxxxx"
                   value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Minimal 6 karakter"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Ulangi password"
                   required>
        </div>

        <button type="submit" class="btn btn-primary btn-register w-100">
            <i class="bi bi-person-plus-fill me-2"></i>
            DAFTAR SEKARANG
        </button>
    </form>

    <div class="text-center mt-4">
        <span class="text-secondary">
            Sudah punya akun?
        </span>
        <a href="{{ route('login') }}" class="login-link">
            Login disini
        </a>
    </div>

</div>

</body>
</html>