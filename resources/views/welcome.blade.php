<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndieArt Connect — Modul Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .bg-navy { background-color: #0f172a !important; }
        .text-navy { color: #0f172a !important; }
        .btn-navy { background-color: #0f172a; color: white; border-radius: 8px; transition: 0.3s; }
        .btn-navy:hover { background-color: #1e293b; color: white; }
        .card-custom { border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.04); }
        .table-custom th { background-color: #0f172a !important; color: white; font-weight: 600; border: none; }
        .table-custom th:first-child { border-top-left-radius: 10px; }
        .table-custom th:last-child { border-top-right-radius: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark bg-navy shadow-sm py-3 mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h4 fw-bold"><i class="bi bi-shop me-2"></i>Fashion Gidyrismi</span>
        </div>
    </nav>

    <div id="modul-pembayaran" class="container my-5">
        <div class="card card-custom">
            <div class="card-body p-4 p-md-5">
                
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h4 class="fw-bold text-navy mb-0"><i class="bi bi-wallet2 me-2"></i>Modul Pembayaran B2B</h4>
                    <button class="btn btn-navy px-4 py-2 mt-3 mt-md-0 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahTagihan">
                        <i class="bi bi-plus-lg me-1"></i> Buat Tagihan
                    </button>
                </div>
                
                <hr class="mb-4" style="opacity: 0.1;">
                
                <div class="table-responsive">
                    <table class="table align-middle table-borderless table-custom" id="tabelPembayaran">
                        <thead>
                            <tr>
                                <th class="py-3 ps-4">No. Invoice</th>
                                <th class="py-3">Total Tagihan</th>
                                <th class="py-3">Metode</th>
                                <th class="py-3">Jumlah Dibayar</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 pe-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border-top border-light">
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahTagihan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header bg-navy text-white" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title"><i class="bi bi-file-earmark-plus me-2"></i>Buat Tagihan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formTagihan">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Total Tagihan (Rp)</label>
                            <input type="number" class="form-control" id="total_tagihan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" required>
                                <option value="transfer_bank" selected>Transfer Bank (Bayar Lunas)</option>
                                <option value="dp">Down Payment (DP)</option>
                                <option value="termin">Termin (Cicilan)</option>
                            </select>
                        </div>
                        <div class="mb-3" id="wadah_jumlah_dibayar" style="display: none;">
                            <label class="form-label fw-medium">Jumlah yang Sudah Dibayar (Rp)</label>
                            <input type="number" class="form-control" id="jumlah_dibayar">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pb-4 pe-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-navy" onclick="simpanTagihan()">Simpan Tagihan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTagihan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none;">
                <div class="modal-header bg-navy text-white" style="border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Update Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="formEditTagihan">
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Update Jumlah Dibayar (Rp)</label>
                            <input type="number" class="form-control" id="edit_jumlah_dibayar" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Update Status</label>
                            <select class="form-select" id="edit_status_pembayaran">
                                <option value="Pending">Pending</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Gagal">Gagal</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pb-4 pe-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-navy" onclick="updateTagihan()">Update Data</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            loadDataPembayaran(); 
            
            $('#metode_pembayaran').change(function() {
                if ($(this).val() === 'transfer_bank') {
                    $('#wadah_jumlah_dibayar').slideUp();
                } else {
                    $('#wadah_jumlah_dibayar').slideDown();
                    $('#jumlah_dibayar').val('');
                }
            });
        });

        function loadDataPembayaran() {
            $.ajax({
                url: '/api/pembayaran',
                type: 'GET',
                success: function(response) {
                    let rows = '';
                    if (response.data.length === 0) {
                        rows = `<tr><td colspan="6" class="text-center py-5"><p class="mt-3 text-muted fw-medium">Belum ada data pembayaran</p></td></tr>`;
                    } else {
                        $.each(response.data, function(index, item) {
                            let badgeColor = 'bg-warning text-dark';
                            
                            if(item.status_pembayaran === 'Lunas') { 
                                badgeColor = 'bg-success text-white'; 
                            } else if(item.status_pembayaran === 'Gagal') { 
                                badgeColor = 'bg-danger text-white'; 
                            }

                            let total = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.total_tagihan);
                            let dibayar = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.jumlah_dibayar);

                            rows += `
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="fw-bold text-navy ps-4">${item.no_invoice}</td>
                                    <td class="text-secondary fw-medium">${total}</td>
                                    <td><span class="badge bg-light text-secondary border text-capitalize px-3 py-2" style="border-radius: 6px;">${item.metode_pembayaran.replace('_', ' ')}</span></td>
                                    <td class="text-secondary fw-medium">${dibayar}</td>
                                    <td class="text-center"><span class="badge ${badgeColor} px-3 py-2 shadow-sm" style="border-radius: 6px;">${item.status_pembayaran}</span></td>
                                    <td class="pe-4 text-center">
                                        <button class="btn btn-sm btn-outline-secondary me-1" onclick="bukaModalEdit(${item.id}, ${item.jumlah_dibayar}, '${item.status_pembayaran}')">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="hapusTagihan(${item.id})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>`;
                        });
                    }
                    $('#tabelPembayaran tbody').html(rows);
                }
            });
        }

        function simpanTagihan() {
            let tagihan = $('#total_tagihan').val();
            let metode = $('#metode_pembayaran').val();
            let dibayar = $('#jumlah_dibayar').val();
            
            if (metode === 'transfer_bank') dibayar = tagihan;

            $.ajax({
                url: '/api/pembayaran',
                type: 'POST',
                data: { total_tagihan: tagihan, metode_pembayaran: metode, jumlah_dibayar: dibayar },
                success: function() {
                    $('#modalTambahTagihan').modal('hide');
                    $('#formTagihan')[0].reset();
                    $('#wadah_jumlah_dibayar').hide();
                    loadDataPembayaran();
                }
            });
        }

        function bukaModalEdit(id, dibayar, status) {
            $('#edit_id').val(id);
            $('#edit_jumlah_dibayar').val(dibayar);
            $('#edit_status_pembayaran').val(status);
            $('#modalEditTagihan').modal('show');
        }

        function updateTagihan() {
            let id = $('#edit_id').val();
            let dibayar = $('#edit_jumlah_dibayar').val();
            let status = $('#edit_status_pembayaran').val();

            $.ajax({
                url: '/api/pembayaran/' + id,
                type: 'PUT',
                data: { jumlah_dibayar: dibayar, status_pembayaran: status },
                success: function() {
                    $('#modalEditTagihan').modal('hide');
                    loadDataPembayaran();
                },
                error: function() {
                    alert("Gagal mengupdate data.");
                }
            });
        }

        // Hapus Data
        function hapusTagihan(id) {
            if (confirm("Apakah kamu yakin ingin menghapus tagihan ini?")) {
                $.ajax({
                    url: '/api/pembayaran/' + id,
                    type: 'DELETE',
                    success: function(response) {
                        loadDataPembayaran(); 
                    },
                    error: function() {
                        alert("Gagal menghapus data.");
                    }
                });
            }
        }
    </script>
</body>
</html>