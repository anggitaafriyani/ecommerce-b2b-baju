@extends('layouts.master')

@section('title', 'Modul Pembayaran B2B (Estetik Grid & Animated)')

@section('content')
    <div id="modul-pembayaran">
        <div class="card card-main p-1">
            <div class="card-body p-4 p-md-5">
                
                <div class="d-flex justify-content-between align-items-start mb-5 flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1" style="color: var(--navy-main); letter-spacing: -0.8px;">Modul Pembayaran B2B</h3>
                        <p class="text-muted mb-0">Halaman pengelolaan tagihan dan verifikasi bukti transfer antar perusahaan.</p>
                    </div>
                    <button class="btn btn-navy d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahTagihan">
                        <i class="bi bi-plus-circle"></i> Buat Tagihan Baru
                    </button>
                </div>
                
                <div class="table-responsive-custom">
                    <table class="table table-custom" id="tabelPembayaran">
                        <thead>
                            <tr>
                                <th class="ps-4">No. Invoice</th>
                                <th>Total Tagihan</th>
                                <th>Metode</th>
                                <th>Jumlah Dibayar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Resi</th>
                                <th class="pe-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahTagihan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-file-earmark-diff me-2"></i>Penerbitan Tagihan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 p-md-5">
                    <form id="formTagihan">
                        <div class="mb-4">
                            <label class="form-label">Total Nominal Tagihan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="total_tagihan" placeholder="0" required style="border-radius: 0 10px 10px 0;">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Pilih Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" required>
                                <option value="transfer_bank" selected>Transfer Bank (Bayar Lunas)</option>
                                <option value="dp">Down Payment (DP)</option>
                                <option value="termin">Termin (Cicilan)</option>
                            </select>
                        </div>
                        <div class="mb-4" id="wadah_jumlah_dibayar" style="display: none;">
                            <label class="form-label">Jumlah Uang Muka yang Sudah Dibayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="jumlah_dibayar" placeholder="0" style="border-radius: 0 10px 10px 0;">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Upload Resi Bukti Transfer <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="file" class="form-control" id="bukti_pembayaran" accept="image/png, image/jpeg">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 pe-4">
                    <button type="button" class="btn btn-light text-secondary fw-semibold px-4" style="border-radius: 10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-navy px-4" onclick="simpanTagihan()">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditTagihan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Update Data Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 p-md-5">
                    <form id="formEditTagihan">
                        <input type="hidden" id="edit_id">
                        <div class="mb-4">
                            <label class="form-label">Update Nominal yang Dibayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="edit_jumlah_dibayar" required style="border-radius: 0 10px 10px 0;">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Status Pembayaran</label>
                            <select class="form-select" id="edit_status_pembayaran">
                                <option value="Pending">Pending</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Ganti/Upload Resi Bukti Transfer Baru</label>
                            <input type="file" class="form-control" id="edit_bukti_pembayaran" accept="image/png, image/jpeg">
                            <small class="text-muted d-block mt-2 font-monospace">*Kosongkan jika resi tidak berubah</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 pe-4">
                    <button type="button" class="btn btn-light text-secondary fw-semibold px-4" style="border-radius: 10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-navy px-4" onclick="updateTagihan()">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            loadDataPembayaran(); 
            
            // Toggle input jumlah dibayar berdasarkan metode
            $('#metode_pembayaran').change(function() {
                if ($(this).val() === 'transfer_bank') {
                    $('#wadah_jumlah_dibayar').slideUp();
                } else {
                    $('#wadah_jumlah_dibayar').slideDown();
                    $('#jumlah_dibayar').val('');
                }
            });

            // Event Delegation untuk tombol Edit
            $('#tabelPembayaran').on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                let dibayar = $(this).data('dibayar');
                let status = $(this).data('status');
                
                $('#edit_id').val(id);
                $('#edit_jumlah_dibayar').val(dibayar);
                $('#edit_status_pembayaran').val(status);
                $('#edit_bukti_pembayaran').val(''); 
                $('#modalEditTagihan').modal('show');
            });

            // Event Delegation untuk tombol Delete menggunakan SweetAlert2
            $('#tabelPembayaran').on('click', '.btn-delete', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data tagihan ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0f172a',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/pembayaran/' + id,
                            type: 'DELETE',
                            success: function(response) {
                                loadDataPembayaran(); 
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: response.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Gagal menghapus data.',
                                });
                            }
                        });
                    }
                });
            });
        });

        function loadDataPembayaran() {
            $.ajax({
                url: '/api/pembayaran',
                type: 'GET',
                success: function(response) {
                    let rows = '';
                    if (response.data.length === 0) {
                        rows = `<tr><td colspan="7" class="text-center py-5 border-right-0"><div class="text-muted"><i class="bi bi-inbox fs-2 d-block mb-3"></i><span class="fw-medium">Belum ada data pembayaran terekam</span></div></td></tr>`;
                    } else {
                        $.each(response.data, function(index, item) {
                            
                            let badgeStyle = 'background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a;';
                            if(item.status_pembayaran === 'Lunas') badgeStyle = 'background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0;'; 
                            else if(item.status_pembayaran === 'Gagal') badgeStyle = 'background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;'; 

                            let total = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.total_tagihan);
                            let dibayar = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(item.jumlah_dibayar);
                            
                            let resiLink = '<span class="text-muted"><i class="bi bi-dash"></i></span>';
                            if(item.bukti_pembayaran) {
                                resiLink = `<a href="/storage/${item.bukti_pembayaran}" target="_blank" class="btn-resi-view"><i class="bi bi-image me-1"></i>Lihat</a>`;
                            }

                            // Menyematkan data id, dibayar, dan status ke dalam atribut tombol
                            rows += `
                                <tr>
                                    <td class="fw-bold ps-4" style="color: var(--navy-main); font-family: font-monospace;">${item.no_invoice}</td>
                                    <td class="fw-semibold text-dark">${total}</td>
                                    <td><span class="badge text-secondary bg-light border text-capitalize fw-medium px-3 py-2" style="border-radius: 6px;">${item.metode_pembayaran.replace('_', ' ')}</span></td>
                                    <td class="fw-semibold" style="color: #334155;">${dibayar}</td>
                                    <td class="text-center"><span class="badge-status" style="${badgeStyle}">${item.status_pembayaran}</span></td>
                                    <td class="text-center">${resiLink}</td>
                                    <td class="pe-4 text-center Kolom-Aksi">
                                        <button class="btn-action-circle btn-edit me-1" title="Edit Data" data-id="${item.id}" data-dibayar="${item.jumlah_dibayar}" data-status="${item.status_pembayaran}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn-action-circle btn-delete" title="Hapus Data" data-id="${item.id}">
                                            <i class="bi bi-trash3"></i>
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

            let formData = new FormData();
            formData.append('total_tagihan', tagihan);
            formData.append('metode_pembayaran', metode);
            formData.append('jumlah_dibayar', dibayar);
            
            if ($('#bukti_pembayaran')[0].files[0]) {
                formData.append('bukti_pembayaran', $('#bukti_pembayaran')[0].files[0]);
            }

            $.ajax({
                url: '/api/pembayaran',
                type: 'POST',
                data: formData,
                contentType: false, 
                processData: false, 
                success: function(response) {
                    $('#modalTambahTagihan').modal('hide');
                    $('#formTagihan')[0].reset();
                    $('#wadah_jumlah_dibayar').hide();
                    loadDataPembayaran();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal menyimpan data.',
                    });
                }
            });
        }

        function updateTagihan() {
            let id = $('#edit_id').val();
            let formData = new FormData();
            formData.append('jumlah_dibayar', $('#edit_jumlah_dibayar').val());
            formData.append('status_pembayaran', $('#edit_status_pembayaran').val());
            formData.append('_method', 'PUT'); 

            if ($('#edit_bukti_pembayaran')[0].files[0]) {
                formData.append('bukti_pembayaran', $('#edit_bukti_pembayaran')[0].files[0]);
            }

            $.ajax({
                url: '/api/pembayaran/' + id,
                type: 'POST', 
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#modalEditTagihan').modal('hide');
                    loadDataPembayaran();
                    Swal.fire({
                        icon: 'success',
                        title: 'Update Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mengupdate data.',
                    });
                }
            });
        }
    </script>
@endpush