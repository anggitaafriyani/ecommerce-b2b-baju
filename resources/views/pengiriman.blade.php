<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Pengiriman - Toko Baju B2B</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-navy {
            background-color: #0f172a !important;
        }

        .text-navy {
            color: #0f172a !important;
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-navy shadow-sm py-3">
        <div class="container">
            <span class="navbar-brand fw-bold">
                🚚 Toko Baju — Modul Pengiriman
            </span>
        </div>
    </nav>

    <div class="container my-5">

        <div class="mb-4">
            <h3 class="fw-bold text-navy mb-1">
                Data Pengiriman Pesanan B2B
            </h3>
            <p class="text-muted small">
                Halaman ini digunakan untuk mengelola pengiriman pesanan grosir,
                mulai dari ekspedisi, resi, ongkir kargo, sampai status pengiriman.
            </p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold text-navy mb-3">
                    Tambah Data Pengiriman
                </h5>

                <form id="formTambahPengiriman">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">
                                Kode Pesanan
                            </label>
                            <input
                                type="text"
                                id="kode_pesanan"
                                class="form-control"
                                placeholder="ORD-B2B-001"
                                required
                            >
                        </div>

                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">
                                Nama Pelanggan
                            </label>
                            <input
                                type="text"
                                id="nama_pelanggan"
                                class="form-control"
                                placeholder="Toko Makmur Baju"
                                required
                            >
                        </div>

                        <div class="col-md-4">
                            <label class="form-label small fw-semibold">
                                Ekspedisi / Kargo
                            </label>
                            <input
                                type="text"
                                id="ekspedisi"
                                class="form-control"
                                placeholder="JNE Cargo / J&T Cargo"
                            >
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-semibold">
                                Alamat Pengiriman
                            </label>
                            <textarea
                                id="alamat_pengiriman"
                                class="form-control"
                                rows="2"
                                placeholder="Alamat lengkap toko tujuan"
                                required
                            ></textarea>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">
                                Berat Barang
                            </label>
                            <input
                                type="number"
                                id="berat_kg"
                                class="form-control"
                                min="1"
                                value="10"
                                required
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">
                                Ongkir
                            </label>
                            <input
                                type="number"
                                id="ongkir"
                                class="form-control"
                                min="0"
                                value="0"
                                required
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">
                                Nomor Resi
                            </label>
                            <input
                                type="text"
                                id="no_resi"
                                class="form-control"
                                placeholder="Belum tersedia"
                            >
                        </div>

                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">
                                Status
                            </label>
                            <select id="status_pengiriman" class="form-select">
                                <option value="menunggu">Menunggu</option>
                                <option value="diproses">Diproses</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <button
                                type="submit"
                                class="btn btn-dark bg-navy px-4"
                            >
                                Simpan Pengiriman
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive p-3">
                <table class="table table-hover align-middle mb-0" id="tabelPengiriman">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th>ID</th>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Ekspedisi</th>
                            <th>Resi</th>
                            <th>Berat</th>
                            <th>Ongkir</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            loadDataPengiriman();

            function rupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(angka);
            }

            function badgeStatus(status) {
                if (status === 'menunggu') {
                    return '<span class="badge bg-secondary">Menunggu</span>';
                }

                if (status === 'diproses') {
                    return '<span class="badge bg-warning text-dark">Diproses</span>';
                }

                if (status === 'dikirim') {
                    return '<span class="badge bg-primary">Dikirim</span>';
                }

                return '<span class="badge bg-success">Selesai</span>';
            }

            function loadDataPengiriman() {
                $.ajax({
                    url: '/api/pengiriman',
                    type: 'GET',

                    success: function (response) {
                        let rows = '';

                        $.each(response.data, function (index, p) {
                            rows += `
                                <tr>
                                    <td class="fw-bold text-muted">#${p.id}</td>
                                    <td class="fw-bold text-navy">${p.kode_pesanan}</td>
                                    <td>${p.nama_pelanggan}</td>
                                    <td>${p.ekspedisi ?? '-'}</td>
                                    <td>${p.no_resi ?? '-'}</td>
                                    <td>${p.berat_kg} Kg</td>
                                    <td>${rupiah(p.ongkir)}</td>
                                    <td>${badgeStatus(p.status_pengiriman)}</td>
                                    <td class="small text-muted">
                                        ${p.alamat_pengiriman}
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-outline-primary btnEdit"
                                            data-id="${p.id}"
                                            data-ekspedisi="${p.ekspedisi ?? ''}"
                                            data-resi="${p.no_resi ?? ''}"
                                            data-ongkir="${p.ongkir}"
                                            data-status="${p.status_pengiriman}"
                                        >
                                            Update
                                        </button>

                                        <button
                                            class="btn btn-sm btn-outline-danger btnHapus"
                                            data-id="${p.id}"
                                        >
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            `;
                        });

                        $('#tabelPengiriman tbody').html(rows);
                    },

                    error: function (err) {
                        alert('Gagal memuat data pengiriman');
                        console.log(err);
                    }
                });
            }

            $('#formTambahPengiriman').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: '/api/pengiriman',
                    type: 'POST',

                    data: {
                        kode_pesanan: $('#kode_pesanan').val(),
                        nama_pelanggan: $('#nama_pelanggan').val(),
                        alamat_pengiriman: $('#alamat_pengiriman').val(),
                        ekspedisi: $('#ekspedisi').val(),
                        no_resi: $('#no_resi').val(),
                        berat_kg: $('#berat_kg').val(),
                        ongkir: $('#ongkir').val(),
                        status_pengiriman: $('#status_pengiriman').val()
                    },

                    success: function (response) {
                        alert(response.message);
                        $('#formTambahPengiriman')[0].reset();
                        loadDataPengiriman();
                    },

                    error: function (err) {
                        alert('Gagal menambahkan data pengiriman. Periksa input.');
                        console.log(err);
                    }
                });
            });

            $(document).on('click', '.btnEdit', function () {
                let id = $(this).data('id');

                let ekspedisi = prompt(
                    'Masukkan ekspedisi/kargo:',
                    $(this).data('ekspedisi')
                );

                let noResi = prompt(
                    'Masukkan nomor resi:',
                    $(this).data('resi')
                );

                let ongkir = prompt(
                    'Masukkan ongkir:',
                    $(this).data('ongkir')
                );

                let status = prompt(
                    'Status: menunggu / diproses / dikirim / selesai',
                    $(this).data('status')
                );

                if (!status) {
                    return;
                }

                $.ajax({
                    url: '/api/pengiriman/' + id,
                    type: 'PUT',

                    data: {
                        ekspedisi: ekspedisi,
                        no_resi: noResi,
                        ongkir: ongkir,
                        status_pengiriman: status
                    },

                    success: function (response) {
                        alert(response.message);
                        loadDataPengiriman();
                    },

                    error: function (err) {
                        alert('Gagal update data pengiriman');
                        console.log(err);
                    }
                });
            });

            $(document).on('click', '.btnHapus', function () {
                let id = $(this).data('id');

                if (!confirm('Yakin ingin menghapus data pengiriman ini?')) {
                    return;
                }

                $.ajax({
                    url: '/api/pengiriman/' + id,
                    type: 'DELETE',

                    success: function (response) {
                        alert(response.message);
                        loadDataPengiriman();
                    },

                    error: function (err) {
                        alert('Gagal menghapus data');
                        console.log(err);
                    }
                });
            });
        });
    </script>

</body>
</html>
```
