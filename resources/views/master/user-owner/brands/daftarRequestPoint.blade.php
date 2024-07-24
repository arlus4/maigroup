@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Request Point</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container container-xxl">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle" style="margin-right: 9px;color: #0f5132!important;"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle" style="margin-right: 9px;color: #f1416c!important;"></i>
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableRequestPoint">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Info Brand</th>
                                    <th class="min-w-100px text-dark">Invoice</th>
                                    <th class="min-w-50px text-dark">Point</th>
                                    <th class="min-w-50px text-dark">Jumlah</th>
                                    <th class="min-w-50px text-dark">Bukti</th>
                                    <th class="text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal-title-edit" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-title-edit">Detail Data Request Point</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Invoice No:</strong></div>
                                <div class="col-md-8" id="invoice_no"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Point Request:</strong></div>
                                <div class="col-md-8" id="point_request"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Jumlah Pembayaran:</strong></div>
                                <div class="col-md-8" id="jumlah_pembayaran"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Bukti Pembayaran:</strong></div>
                                <div class="col-md-8" id="path_bukti_pembayaran"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Created At:</strong></div>
                                <div class="col-md-8" id="created_at"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Brand Code:</strong></div>
                                <div class="col-md-8" id="brand_code"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Brand Name:</strong></div>
                                <div class="col-md-8" id="brand_name"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>No HP:</strong></div>
                                <div class="col-md-8" id="no_hp"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Nama Bank:</strong></div>
                                <div class="col-md-8" id="nama_bank"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Nomor Rekening:</strong></div>
                                <div class="col-md-8" id="nomor_rekening"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4"><strong>Requested By:</strong></div>
                                <div class="col-md-8" id="name"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        $(document).ready(function() {
            $('#tableRequestPoint').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataRequestPoint",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'brand_name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.brand_name}</span>
                                            <span>${row.brand_code}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    { data: 'invoice_no' },
                    { data: 'point_request' },
                    {
                        data: 'jumlah_pembayaran',
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        },
                    },
                    {
                        data: "Bukti Pembayaran",
                        render: function(data, type, row) {
                            return '<a href="https://apps.tokoseru.com/' + row.path_bukti_pembayaran + '" target="_blank" class="btn btn-primary fw-bold my-1 me-2 btn-sm hover-scale">Lihat</a>';
                        },
                    },
                    {
                        data: 'atur',
                        render: function(data, type, row) {
                            return `<div class="align-items-center d-flex">
                                        <button type="button" class="btn btn-light-success my-1 me-2 btn-sm" onclick="approveRequest(${row.id})">Approve</button>
                                        <button type="button" class="btn btn-light-primary my-1 me-2 btn-sm" onclick="detailRequest(${row.id})">Detail</button>
                                        <button type="button" class="btn btn-light-danger my-1 me-2 btn-sm" onclick="rejectRequest(${row.id})">Reject</button>
                                    </div>`;
                        }
                    }
                ],
            });
        });

        function approveRequest(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Menerima Request ini ?",
                icon: 'success',
                cancelButtonText: "Batal",
                showCancelButton: true,
                confirmButtonColor: '#04B00C',
                cancelButtonColor: '#d33',
                confirmButtonText: `Terima!`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/approveRequestPoint',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableRequestPoint').DataTable().ajax.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                        }
                    })
                }
            })
        }

        function detailRequest(id) {
            $.ajax({
                type: 'GET',
                url: `/admin/detailRequestPoint/${id}`,
                success: function(response) {
                    if (response.data) {
                        $('#modal-title-edit').text('Detail Data Request Point');
                        $('#invoice_no').text(response.data.invoice_no);
                        $('#point_request').text(response.data.point_request);
                        $('#jumlah_pembayaran').text(formatRupiah(response.data.jumlah_pembayaran));
                        $('#path_bukti_pembayaran').html('<a href="https://apps.tokoseru.com/' + response.data.path_bukti_pembayaran + '" target="_blank">Lihat Bukti</a>');
                        $('#created_at').text(formatDate(response.data.created_at));
                        $('#brand_code').text(response.data.brand_code);
                        $('#brand_name').text(response.data.brand_name);
                        $('#no_hp').text(response.data.no_hp);
                        $('#nama_bank').text(response.data.nama_bank);
                        $('#nomor_rekening').text(response.data.nomor_rekening);
                        $('#name').text(response.data.name);
                        $('#modal_edit').modal('show');
                    } else {
                        toastr.error("Data tidak ditemukan.");
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            });
        }

        function rejectRequest(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Menolak Request ini ?",
                icon: 'error',
                cancelButtonText: "Batal",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Ya, saya yakin!`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/rejectRequestPoint',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableRequestPoint').DataTable().ajax.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                        }
                    })
                }
            })
        }
    </script>
@endsection