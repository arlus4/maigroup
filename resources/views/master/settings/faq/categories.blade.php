@extends('layout-master/app')

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Categories FaQ</h1>
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
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Category" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Category
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableCategoryBrand">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Kategori</th>
                                    <th class="min-w-100px text-dark">User</th>
                                    <th class="min-w-100px text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Kategori FaQ -->
            <div class="modal fade" id="modalAdd">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 8px;">
                    <div class="content-header">
                        <div class="content-title">
                            <h4 class="css-lk3jsp">Tambah Categories</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="css-flj2ej">
                        <div class="css-fjkpo0ma">
                            <div class="css-wj23sk">
                                <div class="css-pp2kjsn">
                                    <div class="css-fhxb1ns">
                                        <div class="css-akcdj8w">
                                            <div class="css-gh3knsa">
                                                <i class="fas fa-info-circle" style="color: #004085;"></i>
                                            </div>
                                            <div>
                                                <span class="css-vcnak2s">Inputan <strong>Nama Kategori</strong> Wajib Diisi.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <form action="{{ route('admin.admin_faq_category_store') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe User</label>
                                    <select class="form-select mb-2" name="users_type" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                        <option></option>
                                        <option value="3">Pembeli</option>
                                        <option value="2">Owner</option>
                                        <option value="4">Pegawai</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="required fw-semibold fs-6 mb-1">Nama Kategori</label>
                                    <input type="text" class="form-control name" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label class="fw-semibold fs-6 mb-1">Slug Kategori</label>
                                    <input type="text" class="form-control slug" name="slug" id="slug" style="background-color: #e4ebf5;cursor: not-allowed" readonly>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" id="simpan-button" class="css-kl2kd9a">Simpan</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Kategori FaQ -->
            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-edit"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form-update">
                            @csrf
                            <input type="hidden" name="id" class="form-control id" id="id" readonly>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Tipe User</label>
                                <select class="form-select mb-2" name="users_type" id="type_user" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                    <option></option>
                                    <option value="3">Pembeli</option>
                                    <option value="2">Owner</option>
                                    <option value="4">Pegawai</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Nama Kategori Brand</label>
                                <input type="text" name="nama_category_edit" class="form-control nama_category_edit" id="nama_category_edit" placeholder="Input Nama Kategori Brand" required>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Slug</label>
                                <input type="text" name="slug_edit" class="form-control form-control-solid slug_edit" id="slug_edit" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                Batalkan
                            </button>
                            <button type="submit" id="update" class="css-kl2kd9a">Simpan</button>
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
    <!-- SLUG Tambah Data -->
    <script type="text/javascript">
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function(){
            fetch('/admin/catFaQSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <!-- SLUG Edit Data -->
    <script type="text/javascript">
        const nama_category_edit = document.querySelector('#nama_category_edit');
        const slug_edit          = document.querySelector('#slug_edit');

        nama_category_edit.addEventListener('change', function(){
            fetch('/admin/catFaQSlug?name=' + nama_category_edit.value)
            .then(response => response.json())
            .then(data => slug_edit.value = data.slug)
        });
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableCategoryBrand').DataTable({
                processing: true,
                serverSide: false,
                ajax: "/admin/setting/faq/categories/get_data_faq_category",
                columns: [
                    { data: "name" },
                    {
                        data: "users_type",
                        render: function(data, type, row) {
                            var type_user = '';
                            if (row.users_type == 3) {
                                type_user += 'Pembeli';
                            } else if (row.users_type == 4) {
                                type_user += 'Pegawai';
                            } else if (row.users_type == 2) {
                                type_user += 'Owner';
                            }
                            return type_user;
                        }
                    },
                    {
                        data: 'atur',
                        render: function(data, type, row) {
                            return `<div class="dropdown">
                                        <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Atur
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                                            <li>
                                                <button onclick="editCat(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="deleteCat(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-trash me-2"></i>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    }
                ]
            });
        });

        // Action Update
        $(document).ready(function() {
            $('#form-update').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_edit').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/setting/faq/categories/faq_category_update",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableCategoryBrand').DataTable().ajax.reload();
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

        function editCat(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/categories/faq_category_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_edit').modal('show');
                    $('#modal-title-edit').text('Edit Data Kategori FaQ');
                    $('#id').val(data.id);
                    $('#nama_category_edit').val(data.name);
                    $('#slug_edit').val(data.slug);
                    $('#type_user').val(data.users_type).trigger('change');
                    $('#update').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function deleteCat(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Menghapus Data Kategori ini ?",
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
                        url: '/admin/setting/faq/categories/faq_category_delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            // toastr[response.status](response.message);
                            // // $('#tableCategoryBrand').DataTable().ajax.reload();
                            // $('#tableCategoryBrand').load(' #tableCategoryBrand');
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableCategoryBrand').DataTable().ajax.reload();
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