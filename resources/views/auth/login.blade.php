<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URBAN VIBE | Login</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
```

</head>
<body style="background:#0b0b0b;">

<section class="d-flex align-items-center min-vh-100">
    <div class="container">

```
    <div class="row justify-content-center">

        <div class="col-lg-5">

            <div class="card border-0 rounded-4 shadow-lg p-5"
                 style="background:#111;">

                <div class="text-center mb-4">

                    <h2 class="fw-bold text-white">
                        URBAN<span class="text-primary">VIBE</span>
                    </h2>

                    <p class="text-secondary small">
                        Login untuk melanjutkan belanja streetwear premium.
                    </p>

                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('login_error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold">
                            EMAIL
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control custom-input"
                            placeholder="name@example.com">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold">
                            PASSWORD
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control custom-input"
                            placeholder="••••••••">
                    </div>

                    <button class="btn btn-primary w-100 py-3 fw-bold">
                        SIGN IN
                    </button>
                </form>

                <div class="text-center mt-4">
                    <span class="text-secondary">
                        Belum punya akun?
                    </span>

                    <a href="{{ route('register') }}"
                       class="text-primary text-decoration-none fw-bold">
                        Daftar
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>
```

</section>

<style>
.custom-input{
    background:#1a1a1a;
    border:1px solid #2d2d2d;
    color:white;
}

.custom-input:focus{
    background:#1f1f1f;
    color:white;
    border-color:#0d6efd;
    box-shadow:0 0 0 .25rem rgba(13,110,253,.25);
}

.custom-input::placeholder{
    color:#6c757d;
}
</style>

</body>
</html>
