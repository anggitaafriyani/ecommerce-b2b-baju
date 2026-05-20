<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modul Pesanan</title>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>

        body{
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        .bg-navy{
            background-color: #0f172a !important;
        }

        .card{
            border-radius: 16px;
        }

        .btn-navy{
            background-color: #0f172a;
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn-navy:hover{
            background-color: #1e293b;
            color: white;
        }

        .hero-box{
            background: linear-gradient(
                135deg,
                #0f172a,
                #1e293b
            );

            border-radius: 20px;
            color: white;
        }

        .badge{
            padding: 8px 12px;
            border-radius: 10px;
        }

    </style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-navy shadow-sm py-3">

    <div class="container">

        <span class="navbar-brand fw-bold">
            🛒 IndieArt Connect
        </span>

        <button class="btn btn-outline-light rounded-pill px-4">
            Logout
        </button>

    </div>

</nav>

<div class="container py-5">

    <!-- HERO -->
    <div class="hero-box p-5 mb-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h1 class="fw-bold">
                    Modul Pesanan
                </h1>

                <p class="mb-0 opacity-75">
                    Kelola transaksi pesanan B2B
                </p>

            </div>

            <button
                class="btn btn-light fw-semibold px-4"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

                + Tambah Pesanan

            </button>

        </div>

    </div>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>

                        <th>ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody id="orderTable">

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="modalTambah">

    <div class="modal-dialog">

        <div class="modal-content rounded-4">

            <div class="modal-header bg-navy text-white">

                <h5 class="modal-title">
                    Tambah Pesanan
                </h5>

                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body p-4">

                <form id="formTambahPesanan">

                    <input
                        type="number"
                        id="total_price"
                        class="form-control mb-3"
                        placeholder="Total Harga"
                        required>

                    <select
                        id="status"
                        class="form-select mb-3">

                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>

                    </select>

                    <textarea
                        id="shipping_address"
                        class="form-control mb-3"
                        rows="3"
                        placeholder="Alamat"
                        required></textarea>

                    <button class="btn btn-navy w-100">

                        Simpan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

$(document).ready(function () {

    // ======================
    // CSRF
    // ======================
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ======================
    // LOAD DATA
    // ======================
    loadOrders();

    function loadOrders() {

        $.ajax({

            url: "/api/orders",
            method: "GET",

            success: function(response) {

                let data = response;

                if(response.data){
                    data = response.data;
                }

                let rows = "";

                if(data.length > 0){

                    data.forEach(function(order){

                        let badge = '';

                        if(order.status === 'pending'){
                            badge = `
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            `;
                        }
                        else if(order.status === 'diproses'){
                            badge = `
                                <span class="badge bg-info">
                                    Diproses
                                </span>
                            `;
                        }
                        else if(order.status === 'dikirim'){
                            badge = `
                                <span class="badge bg-primary">
                                    Dikirim
                                </span>
                            `;
                        }
                        else{
                            badge = `
                                <span class="badge bg-success">
                                    Selesai
                                </span>
                            `;
                        }

                        rows += `
                            <tr>

                                <td>#${order.id}</td>

                                <td>
                                    Rp ${Number(order.total_price).toLocaleString('id-ID')}
                                </td>

                                <td>
                                    ${badge}
                                </td>

                                <td>
                                    ${order.shipping_address}
                                </td>

                                <td>

                                    <button
                                        class="btn btn-danger btn-sm btnDelete"
                                        data-id="${order.id}">

                                        Hapus

                                    </button>

                                </td>

                            </tr>
                        `;
                    });

                } else {

                    rows = `
                        <tr>

                            <td colspan="5" class="text-center py-4">

                                Belum ada data

                            </td>

                        </tr>
                    `;
                }

                $("#orderTable").html(rows);
            },

            error: function(xhr){

                console.log(xhr);

            }

        });

    }

    // ======================
    // TAMBAH DATA
    // ======================
    $("#formTambahPesanan").submit(function (e) {

        e.preventDefault();

        $.ajax({

            url: "/api/orders",
            type: "POST",

            data: {

                user_id: 1,
                total_price: $("#total_price").val(),
                status: $("#status").val(),
                shipping_address: $("#shipping_address").val()

            },

            success: function () {

                alert("Berhasil ditambahkan");

                $("#formTambahPesanan")[0].reset();

                const modalEl = document.getElementById('modalTambah');

                const modal = bootstrap.Modal.getInstance(modalEl);

                if (modal) {
                    modal.hide();
                }

                loadOrders();
            },

            error: function (err) {

                console.log(err);

                alert("Gagal tambah data");

            }

        });

    });

    // ======================
    // DELETE
    // ======================
    $(document).on("click", ".btnDelete", function () {

        let id = $(this).data("id");

        if(confirm("Yakin hapus data?")){

            $.ajax({

                url: "/api/orders/" + id,
                type: "DELETE",

                success: function () {

                    alert("Berhasil dihapus");

                    loadOrders();
                }

            });

        }

    });

});

</script>

</body>
</html>