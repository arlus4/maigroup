@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Kategori Produk</h1>
                </div>
                <button type="button" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;" onclick="addData()">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus-circle text-white"></i>
                    </span>
                    Tambah Kategori
                </button>
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableCategoryProduct">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Categories</th>
                                    <th class="min-w-100px text-dark">Description</th>
                                    <th class="min-w-100px text-dark">Brand Categories</th>
                                    <th class="min-w-100px text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori Brand -->
    <div class="modal fade" id="modal_add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-save">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Brand</label>
                        <div class="input-group">
                            <select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" name="brand_category_code" required>
                                <option></option>
                                @foreach($brand_category as $kategori)
                                    <option value="{{ $kategori->brand_category_code }}">{{ $kategori->brand_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Nama Kategori Produk</label>
                        <input type="text" name="category_name" class="form-control category_name" id="category_name" placeholder="Input Nama Kategori Produk" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Slug</label>
                        <input type="text" name="slug" class="form-control form-control-solid slug" id="slug" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Deskripsi Kategori</label>
                        <textarea name="description" class="form-control description" id="description" cols="10" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                        Batalkan
                    </button>
                    <button type="submit" id="save" class="css-kl2kd9a">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori Produk -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-edit"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-update">
                    @csrf
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Code Kategori Produk</label>
                        <input type="text" name="code_category" class="form-control form-control-solid code_category" id="code_category" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Kategori Brand</label>
                        <select class="form-select mb-2 brand_category" name="brand_category" id="brand_category" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" required>
                            @foreach($brand_category as $category)
                                <option value="{{ $category->brand_category_code }}">{{ $category->brand_category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Nama Kategori Produk</label>
                        <input type="text" name="category_name_edit" class="form-control category_name_edit" id="category_name_edit" placeholder="Input Nama Kategori Produk" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Slug</label>
                        <input type="text" name="slug_edit" class="form-control form-control-solid slug_edit" id="slug_edit" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Deskripsi Kategori</label>
                        <textarea name="description_edit" class="form-control description_edit" id="description_edit" cols="10" rows="5"></textarea>
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
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
	<!-- slug add -->
    <script type="text/javascript">
        const category_name = document.querySelector('#category_name');
        const slug          = document.querySelector('#slug');

        category_name.addEventListener('change', function(){
            fetch('/admin/catProductSlug?category_name=' + category_name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <!-- slug edit -->
    <script type="text/javascript">
        const category_name_edit = document.querySelector('#category_name_edit');
        const slug_edit          = document.querySelector('#slug_edit');

        category_name_edit.addEventListener('change', function(){
            fetch('/admin/catProductSlug?category_name=' + category_name_edit.value)
            .then(response => response.json())
            .then(data => slug_edit.value = data.slug)
        });
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableCategoryProduct').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataProductCategory",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.category_name}</span>
                                            <span>${row.category_code}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'description',
                        render: function(data, type, row) {
                            var description = '';
                            if (row.description == null) {
                                description += '-';
                            } else {
                                description += row.description;
                            }
                            return description;
                        }
                    },
                    {
                        data: 'brand_category',
                        render: function(data, type, row) {
                            var brand_category = '';
                            if (row.brand_category_name == null) {
                                brand_category += '-';
                            } else {
                                brand_category += row.brand_category_name;
                            }
                            return brand_category;
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

        function addData() {
            $('#modal_add').modal('show');
            $('#modal-title').text('Tambah Kategori Produk Baru');
            $('#category_name').val('');
            $('#slug').val('');
            $('#description').val('');
            $('#save').text('Simpan');
        }

        // Store Data
        $(document).ready(function() {
            $('#form-save').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                console.log(formData);
                $('#modal_add').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/add_productCategory",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#tableCategoryProduct').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi. " + xhr.status + "." + xhr.statusText + "." + xhr.responseText);
                    }
                })
            })
        });

        function editCat(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/edit_productCategory',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#code_category').val(data.category_code);
                    $('#modal_edit').modal('show');
                    $('#modal-title-edit').text('Edit Data Kategori Product');

                    // Cek apakah data yang tersimpan ada di dropdown
                    let brandCategoryDropdown = $('#brand_category');
                    if (brandCategoryDropdown.find('option[value="' + data.brand_category_code + '"]').length === 0) {
                        // Tambahkan opsi jika tidak ada
                        brandCategoryDropdown.append(new Option(data.brand_category_code, data.brand_category_code, true, true));
                    } else {
                        // Pilih opsi yang sesuai
                        brandCategoryDropdown.val(data.brand_category_code);
                    };

                    $('#category_name_edit').val(data.category_name);
                    $('#slug_edit').val(data.slug);
                    $('#description_edit').val(data.description);

                    $('#form-update').append('<input type="hidden" name="id" id="edit_id" value="' + data.id + '">');

                    $('#update').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Update Data
        $(document).ready(function() {
            $('#form-update').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_edit').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/update_productCategory",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#edit_id').remove(); // Remove hidden id input
                        $('#tableCategoryProduct').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });
    </script>

@endsection