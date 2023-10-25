@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Data Kategori Produk</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container container-xxl">
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
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Kategori Produk" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Kategori Produk
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px text-dark">Nama Kategori</th>
                                <th class="min-w-125px text-dark">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            <tr>
                                <td class="align-items-center">Es Teh</td>
                                <td class="d-flex">
                                    <button class="border-0 bg-white p-0" style="margin-right: 4px;">
                                        <span class="badge badge-warning css-height-30">
                                            <i class="fas fa-edit text-white"></i>&nbsp;
                                            Edit
                                        </span>
                                    </button>
                                    <button class="border-0 bg-white p-0">
                                        <span class="badge badge-danger css-height-30">
                                            <i class="fas fa-trash text-white"></i>&nbsp;
                                            Hapus
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kt_modal_add_user">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
            <div class="content-header">
                <div class="content-title">
                    <h4 class="css-lk3jsp">Tambah Kategori Produk</h4>
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
                    <form action="#">
                        <div class="form-group mb-3">
                            <label class="required fw-semibold fs-6 mb-1">Nama Kategori</label>
                            <input type="text" class="form-control nama_kategori" name="nama_kategori" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-semibold fs-6 mb-1">Slug Kategori</label>
                            <input type="text" class="form-control slug_kategori" name="slug_kategori" style="background-color: #e2e2e2;cursor: not-allowed" readonly>
                        </div>
                    </form>
                </div>
               </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batalkan</button>
                <button type="button" class="css-kl2kd9a" style="width: 100px;">Simpan</button>
            </div>
            </div>
        </div>
    </div>
@endsection