<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan B2B - IndieArt Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-navy { background-color: #0f172a; color: white; border-radius: 8px; }
        .btn-navy:hover { background-color: #1e293b; color: white; }
        .text-navy { color: #0f172a; }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card border-0 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 16px;">
        <div class="card-body p-4 m-2">
            <h3 class="text-center fw-bold text-navy mb-1">toko baju</h3>
            <p class="text-center text-muted small mb-4">Grosir Baju B2B — Login Toko Mitra</p>

            @if($errors->any())
                <div class="alert alert-danger small py-2">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/proses-login-web" method="POST">
                @csrf 
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Alamat Email Toko</label>
                    <input type="email" name="email" class="form-control py-2" value="makmurbaju@grosir.com" required style="border-radius: 8px;">
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control py-2" value="password123" required style="border-radius: 8px;">
                </div>
                <button type="submit" class="btn btn-navy w-100 fw-semibold py-2">Masuk Aplikasi</button>
            </form>
        </div>
    </div>

</body>
</html>