@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Brands Owner Pending</h1>
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableBrandOwner">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Info Brand</th>
                                    <th class="min-w-100px text-dark">Owner</th>
                                    <th class="min-w-100px text-dark">Categories</th>
                                    <th class="min-w-100px text-dark">Register</th>
                                    <th class="text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal Approve User -->
            <div class="modal fade" id="modal_approve">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-approve"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form-approve">
                            @csrf
                            <input type="hidden" name="id" class="form-control id" id="id" readonly>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Brand Code</label>
                                <input type="text" class="form-control brand_code form-control-solid" id="brand_code" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Brand Name</label>
                                <input type="text" class="form-control brand_name form-control-solid" id="brand_name" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                Batalkan
                            </button>
                            <button type="submit" id="approve" class="css-kl2kd9a">Approve</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableBrandOwner').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDatabrandPending",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'brand_name',
                        render: function(data, type, row) {
                            var imagePath = row.brand_image_path ? row.brand_image_path : '/avatar.png';
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.brand_name}</span>
                                            <span>${row.brand_code}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.name}</span>
                                            <span>${row.email}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    { data: 'brand_category_name' },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            // Ubah format tanggal dari YYYY-MM-DDTHH:mm:ss.sssZ menjadi dd-MM-YYYY
                            var date = new Date(data);
                            var day = date.getDate().toString().padStart(2, '0');
                            var month = (date.getMonth() + 1).toString().padStart(2, '0');
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                    },
                    {
                        data: 'is_regis',
                        render: function(data, type, row) {
                            return `<div class="align-items-center d-flex">
                                    <button type="button" class="btn btn-primary me-4" onclick="window.location.href = '/admin/detail-brand-pending/${row.slug}'">Detail</button>
                                    <button type="button" class="btn btn-success me-4" onclick="approveBrand(${row.id})">Approve</button>
                                    <button type="button" class="btn btn-danger" onclick="rejectBrand(${row.id})">Reject</button>
                                </div>`;
                        }
                    }
                ]
            });
        });

        // Action Approve
        $(document).ready(function() {
            $('#form-approve').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_approve').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/approve-brand-pending",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableUserOwner').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function approveBrand(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/get_data_detail_brand_pending',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_approve').modal('show');
                    $('#modal-title-approve').text('Approve Data User');
                    $('#id').val(data.id);
                    $('#brand_code').val(data.brand_code);
                    $('#brand_name').val(data.brand_name);
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function rejectBrand(id) {
            console.log(id);
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Reject Data Brands ini ?",
                icon: 'warning',
                cancelButtonText: "Batal",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Ya, saya yakin!`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/reject-brand-pending',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            toastr[response.status](response.message);
                            $('#tableUserOwner').DataTable().ajax.reload();
                            // $('#tableUserOwner').load(' #tableUserOwner');
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