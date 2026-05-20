<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - IndieArt Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-navy { background-color: #0f172a !important; }
        .text-navy { color: #0f172a !important; }
        .badge-distributor { background-color: #ef4444; color: white; }
        .badge-retail { background-color: #3b82f6; color: white; }
    </style>
</head>
<body class="bg-light" style="font-family: 'Segoe UI', sans-serif;">

    <nav class="navbar navbar-dark bg-navy shadow-sm py-3">
        <div class="container">
            <span class="navbar-brand fw-bold d-flex align-items-center">
                <span class="me-2">🛒</span> toko baju — Modul Pelanggan
            </span>
            <a href="/" class="btn btn-sm btn-outline-light rounded-pill px-3">Kembali ke Login</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="mb-4">
            <h3 class="fw-bold text-navy mb-1">Data Pelanggan / Mitra B2B</h3>
            <p class="text-muted small">Halaman khusus untuk mengelola data toko grosir baju yang terdaftar di sistem.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr class="border-transparent">
                            <th class="ps-3">ID Pelanggan</th>
                            <th>Nama Toko</th>
                            <th>Nama Pemilik</th>
                            <th>Email Aktif</th>
                            <th>No. Handphone</th>
                            <th>Tipe Kemitraan</th>
                            <th class="pe-3">Alamat Toko</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semuaPelanggan as $p)
                            <tr class="border-bottom border-light">
                                <td class="fw-bold text-muted ps-3">#00{{ $p->id }}</td>
                                <td class="fw-bold text-navy">{{ $p->nama_toko }}</td>
                                <td class="fw-medium text-dark">{{ $p->nama_pemilik }}</td>
                                <td class="text-muted small">{{ $p->email }}</td>
                                <td><span class="badge bg-light text-secondary border px-2 py-1.5" style="border-radius: 6px;">{{ $p->no_hp }}</span></td>
                                <td>
                                    @if($p->tipe_mitra == 'distributor')
                                        <span class="badge badge-distributor px-3 py-1.5" style="border-radius: 6px;">Distributor</span>
                                    @elseif($p->tipe_mitra == 'agen')
                                        <span class="badge bg-warning text-dark px-3 py-1.5" style="border-radius: 6px;">Agen</span>
                                    @else
                                        <span class="badge badge-retail px-3 py-1.5" style="border-radius: 6px;">Toko Retail</span>
                                    @endif
                                </td>
                                <td class="text-muted small pe-3">{{ $p->alamat_lengkap }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">Belum ada data pelanggan yang terdaftar di database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>