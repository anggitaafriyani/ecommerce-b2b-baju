<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan B2B - IndieArt Connect</title>

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>

        body{
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-navy{
            background-color: #0f172a !important;
        }

        .text-navy{
            color: #0f172a !important;
        }

        .card{
            border-radius: 16px;
        }

        .table-hover tbody tr:hover{
            background-color: #f8fafc;
            transition: 0.2s;
        }

    </style>

</head>

<body class="bg-light">

    <!-- LOGIN SECTION -->
    <div id="loginSection"
         class="d-flex align-items-center justify-content-center"
         style="height: 100vh;">

        <div class="card border-0 shadow-sm"
             style="width: 100%; max-width: 400px;">

            <div class="card-body p-4 m-2">

                <h3 class="text-center fw-bold text-navy mb-1">
                    Toko Baju
                </h3>

                <p class="text-center text-muted small mb-4">
                    Grosir Baju B2B — Login Toko Mitra
                </p>

                <!-- ERROR -->
                <div id="loginError"
                     class="alert alert-danger small py-2 d-none">
                </div>

                <!-- FORM LOGIN -->
                <form id="formLoginView">

                    <div class="mb-3">

                        <label class="form-label small fw-semibold text-secondary">
                            Alamat Email Toko
                        </label>

                        <input type="email"
                               id="email"
                               class="form-control py-2"
                               required
                               style="border-radius: 8px;">

                    </div>

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Password
                        </label>

                        <input type="password"
                               id="password"
                               class="form-control py-2"
                               required
                               style="border-radius: 8px;">

                    </div>

                    <button type="submit"
                            class="btn btn-dark bg-navy w-100 fw-semibold py-2"
                            style="border-radius: 8px;">

                        Masuk Aplikasi

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- DASHBOARD -->
    <div id="dashboardSection" class="d-none">

        <!-- NAVBAR -->
        <nav class="navbar navbar-dark bg-navy shadow-sm py-3">

            <div class="container">

                <span class="navbar-brand fw-bold d-flex align-items-center">

                    <span class="me-2">🛒</span>

                    Toko Baju — Modul Pelanggan

                </span>

                <button id="btnLogOut"
                        class="btn btn-sm btn-outline-light rounded-pill px-3">

                    Log Out

                </button>

            </div>

        </nav>

        <!-- CONTENT -->
        <div class="container my-5">

            <div class="mb-4">

                <h3 class="fw-bold text-navy mb-1">
                    Data Pelanggan / Mitra B2B
                </h3>

                <p class="text-muted small">
                    Halaman khusus untuk mengelola data toko grosir baju
                    yang terdaftar di sistem (Asinkron murni via jQuery AJAX).
                </p>

            </div>

            <!-- CARD TABLE -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="table-responsive p-3">

                    <table class="table table-hover align-middle mb-0"
                           id="tabelPelanggan">

                        <thead class="table-light text-secondary small text-uppercase">

                            <tr>

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

                            <!-- AJAX DATA -->

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

<script>

    // CSRF AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        // LOGIN
        $('#formLoginView').submit(function(e) {

            e.preventDefault();

            $('#loginError').addClass('d-none');

            $.ajax({

                url: '/api/pelanggan/login',

                type: 'POST',

                data: {
                    email: $('#email').val(),
                    password: $('#password').val()
                },

                success: function(response) {

                    alert(response.message);

                    // tampil dashboard
                    $('#loginSection').addClass('d-none');

                    $('#dashboardSection').removeClass('d-none');

                    // load data pelanggan
                    loadDataPelanggan();
                },

                error: function(err) {

                    $('#loginError')
                        .removeClass('d-none')
                        .text(err.responseJSON.message);

                }

            });

        });

        // LOAD DATA
        function loadDataPelanggan() {

            $.ajax({

                url: '/api/pelanggan',

                type: 'GET',

                success: function(response) {

                    let rows = '';

                    $.each(response.data, function(index, p) {

                        let badgeMitra = '';

                        if(p.tipe_mitra === 'distributor') {

                            badgeMitra =
                                '<span class="badge bg-danger px-3 py-1">Distributor</span>';

                        } else if(p.tipe_mitra === 'agen') {

                            badgeMitra =
                                '<span class="badge bg-warning text-dark px-3 py-1">Agen</span>';

                        } else {

                            badgeMitra =
                                '<span class="badge bg-primary px-3 py-1">Toko Retail</span>';
                        }

                        rows += `
                            <tr class="border-bottom border-light">

                                <td class="fw-bold text-muted ps-3">
                                    #00${p.id}
                                </td>

                                <td class="fw-bold text-navy">
                                    ${p.nama_toko}
                                </td>

                                <td class="fw-medium text-dark">
                                    ${p.nama_pemilik}
                                </td>

                                <td class="text-muted small">
                                    ${p.email}
                                </td>

                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1">
                                        ${p.no_hp}
                                    </span>
                                </td>

                                <td>
                                    ${badgeMitra}
                                </td>

                                <td class="text-muted small pe-3">
                                    ${p.alamat_lengkap}
                                </td>

                            </tr>
                        `;
                    });

                    $('#tabelPelanggan tbody').html(rows);

                },

                error: function(err) {

                    console.error(
                        "Gagal memuat data pelanggan",
                        err
                    );

                }

            });

        }

        // LOGOUT
        $('#btnLogOut').click(function() {

            $('#dashboardSection').addClass('d-none');

            $('#loginSection')
                .removeClass('d-none')
                .addClass('d-flex');

            $('#formLoginView')[0].reset();

        });

    });

</script>

</body>
</html>