@extends('layout-master/app')

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Kategori Projek</h1>
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
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Kategori Projek" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAdd">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Kategori Projek
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_kategori_produk">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px text-dark">Nama Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($dataKategori as $val)
                                <tr>
                                    <td class="align-items-center">{{ $val->project_name }}</td>
                                    <td class="d-flex">
                                        <div class="dropdown">
                                            <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Atur
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <button class="dropdown-item p-2 ps-5" data-bs-toggle="modal" data-bs-kategori="{{ $val->id }}" data-bs-nama="{{ $val->project_name }}" data-bs-slug_kategori="{{ $val->slug }}" data-bs-target="#modalEdit" style="cursor: pointer">
                                                        <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item p-2 ps-5" data-bs-toggle="modal" data-bs-id_kategori="{{ $val->id }}" data-bs-target="#modalDelete" style="cursor: pointer">
                                                        <i style="color:#181C32;" class="fas fa-trash me-2"></i>
                                                        Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- <button class="border-0 bg-white p-0" style="margin-right: 4px;" data-bs-toggle="modal" data-bs-kategori="{{ $val->id }}" data-bs-nama="{{ $val->project_name }}" data-bs-slug_kategori="{{ $val->slug }}" data-bs-target="#modalEdit">
                                            <span class="badge badge-warning css-height-30">
                                                <i class="fas fa-edit text-white"></i>&nbsp;
                                                Edit
                                            </span>
                                        </button>
                                        <button class="border-0 bg-white p-0" data-bs-toggle="modal" data-bs-id_kategori="{{ $val->id }}" data-bs-target="#modalDelete">
                                            <span class="badge badge-danger css-height-30">
                                                <i class="fas fa-trash text-white"></i>&nbsp;
                                                Hapus
                                            </span>
                                        </button> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
            <div class="content-header">
                <div class="content-title">
                    <h4 class="css-lk3jsp">Tambah Kategori Projek</h4>
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
                    <form action="{{ route('admin.admin_store_category_product') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="required fw-semibold fs-6 mb-1">Nama Kategori</label>
                            <input type="text" class="form-control project_name" name="project_name" id="project_name" required>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
            <div class="content-header">
                <div class="content-title">
                    <h4 class="css-lk3jsp">Edit Kategori Projek</h4>
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
                    <form action="{{ route('admin.admin_update_category_product') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="hidden" name="idKategoriProduk" id="idKategoriProduk" readonly>
                            <label class="required fw-semibold fs-6 mb-1">Nama Kategori</label>
                            <input type="text" class="form-control project_name_edit" name="project_name_edit" id="project_name_edit" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-semibold fs-6 mb-1">Slug Kategori</label>
                            <input type="text" class="form-control slug_edit" name="slug_edit" id="slug_edit" style="background-color: #e4ebf5;cursor: not-allowed" readonly>
                        </div>
                    </div>
               </div> 
            </div>
            <div class="modal-footer">
                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" id="ubah-button" class="css-kl2kd9a">Simpan Perubahan</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="content-header">
                    <div class="content-title">
                        <h4 class="css-lk3jsp">Hapus Kategori Projek</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="css-flj2ej">
                    <div class="css-fjkpo0ma">
                        <div class="css-wj23sk">
                            <form action="{{ route('admin.admin_delete_category_product') }}" method="POST">
                                @csrf
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <input type="hidden" name="id_kategori" id="id">
                                    <div class="col-md-12 fv-row" >
                                        <span style="font-size: 15px">
                                            Apakah Anda yakin untuk menghapus data kategori projek ini?
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="css-kl2kd9a">
                                        <span class="indicator-label">Ya, saya yakin</span>
                                    </button>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- SLUG Tambah Data -->
    <script type="text/javascript">
        const project_name = document.querySelector('#project_name');
        const slug         = document.querySelector('#slug');

        project_name.addEventListener('change', function(){
            fetch('/admin/kategoriProdukSlug?project_name=' + project_name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <!-- slug edit -->
    <script type="text/javascript">
        const project_name_edit = document.querySelector('#project_name_edit');
        const slug_edit         = document.querySelector('#slug_edit');

        project_name_edit.addEventListener('change', function(){
            fetch('/admin/kategoriProdukSlug?project_name=' + project_name_edit.value)
            .then(response => response.json())
            .then(data => slug_edit.value = data.slug)
        });
    </script>

    <!-- Modal Edit Kategori -->
    <script type="text/javascript">
        var edit = document.getElementById('modalEdit');
        edit.addEventListener('show.bs.modal', function (event) {
            var button          = event.relatedTarget;
            var kategori        = button.getAttribute('data-bs-kategori');
            var project_name    = button.getAttribute('data-bs-nama');
            var slug_kategori   = button.getAttribute('data-bs-slug_kategori');

            document.getElementById('idKategoriProduk').value = kategori;
            document.getElementById('project_name_edit').value = project_name;
            document.getElementById('slug_edit').value = slug_kategori;
        });
    </script>

    <!-- Modal Hapus Kategori -->
    <script>
        var hapus = document.getElementById('modalDelete');
        hapus.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id_kategori = button.getAttribute('data-bs-id_kategori');
            id.value = id_kategori;
        });
    </script>

    <script>
        setTimeout(function() {
            document.querySelector('.alert.alert-success').remove();
        }, 3000);

        setTimeout(function() {
            document.querySelector('.alert.alert-danger').remove();
        }, 3000);
    </script>
@endsection