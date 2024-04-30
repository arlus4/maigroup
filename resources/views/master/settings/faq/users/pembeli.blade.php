@extends('layout-master/app')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">FaQ User Pembeli</h1>
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
                            Tambah FaQ Pembeli
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableFaQ">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px text-dark">Kategori</th>
                                <th class="min-w-100px text-dark">Pertanyaan</th>
                                <th class="min-w-100px text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah FaQ -->
            <div class="modal fade" id="modalAdd">
                <div class="modal-dialog modal-dialog-centered mw-1000px">
                    <div class="modal-content" style="border-radius: 8px;">
                    <div class="content-header">
                        <div class="content-title">
                            <h4 class="css-lk3jsp">Tambah FaQ User Owner</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="css-flj2ej">
                        <div class="css-fjkpo0ma">
                            <div class="css-wj23sk">
                            <form action="{{ route('admin.admin_faq_user_pembeli_store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                    <select class="form-select mb-2" name="faqs_categories" data-control="select2" data-placeholder="Pilih Tipe Kategori" data-allow-clear="true" required>
                                        <option></option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                    <input type="text" class="form-control question" name="question" id="question" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                    <textarea name="answer" id="answer"></textarea>
                                    <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
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

            <!-- Modal Detail FaQ -->
            <div class="modal fade" id="modal_detail">
                <div class="modal-dialog modal-dialog-centered mw-1000px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title fs-2x" id="modal-title-detail"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="fs-2x text-gray-800 w-bolder mb-6" id="question_detail"></div>
                            <p class="mb-4 text-gray-600 fw-semibold fs-6 ps-10" id="answer_detail"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                Batalkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Kategori FaQ -->
            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog modal-dialog-centered mw-1000px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title-edit"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" id="form-update">
                            @csrf
                            <input type="hidden" name="id" class="form-control id" id="id_edit" readonly>
                            <div class="form-group mb-3">
                                <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                <select class="form-select mb-2" name="faqs_categories" id="faqs_categories_edit" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                    <option></option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                <input type="text" class="form-control question" name="question" id="question_edit" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                <textarea name="answer_edit" id="answer_edit"></textarea>
                                <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
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
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'answer' );
    </script>
    <script>
        CKEDITOR.replace( 'answer_edit' );
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableFaQ').DataTable({
                processing: true,
                serverSide: false,
                ajax: "/admin/setting/faq/user/get_data_faq_user_pembeli",
                columns: [
                    { data: "category_name" },
                    { data: "question" },
                    {
                        data: 'atur',
                        render: function(data, type, row) {
                            return `<div class="dropdown">
                                        <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Atur
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                                            <li>
                                                <button onclick="detailCat(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-circle-info me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
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

        function detailCat(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pembeli_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_detail').modal('show');
                    $('#modal-title-detail').text('Kategori ' + data.category_name);
                    $('#question_detail').text(data.question);
                    $('#answer_detail').html(data.answer);
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function editCat(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pembeli_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_edit').modal('show');
                    $('#modal-title-edit').text('Edit Data Kategori FaQ');
                    $('#id_edit').val(data.id);
                    $('#faqs_categories_edit').val(data.category_id).trigger('change');
                    $('#question_edit').val(data.question);
                    CKEDITOR.instances['answer_edit'].setData(data.answer);
                    $('#update').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Action Update
        $(document).ready(function() {
            $('#form-update').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_edit').modal('hide');
                $.ajax({
                    type: 'POST',
                    // url: "/admin/setting/faq/user/faq_user_pembeli_update", // answer masih ngebugs karena update datanya masih null
                    url: "#",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableFaQ').DataTable().ajax.reload();
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

        function deleteCat(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Menghapus Data FaQ ini ?",
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
                        url: '/admin/setting/faq/user/faq_user_pembeli_delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableFaQ').DataTable().ajax.reload();
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