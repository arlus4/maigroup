@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">FaQ</h1>
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
        <div class="row d-flex">
            <div class="col-xl-6">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h4 class="text-dark fw-bold fs-4">FaQ User Owner</h4>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAddOwner">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fas fa-plus-circle text-white"></i>
                                    </span>
                                    Tambah FaQ Owner
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableFaQOwner">
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
                    <div class="modal fade" id="modalAddOwner">
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
                                    <form action="{{ route('admin.admin_faq_user_owner_store') }}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" class="form-control questionOwner" name="question" id="questionOwner" required>
                                        </div>
                                        <div class="form-group" style="padding-bottom: 2%">
                                            <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                            <textarea name="answer" id="answerOwner"></textarea>
                                            <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 2%">
                                                <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                                <input type="file" class="form-control form-control-transparent" name="image" id="imageOwner" accept=".jpg, .jpeg, .png">
                                                <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                                <img id="image_previewOwner" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                            <input type="text" class="form-control url" name="url" id="url" />
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
                    <div class="modal fade" id="modal_detail_owner">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fs-2x" id="modal-title-detailOwner"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="fs-2x text-gray-800 w-bolder mb-6" id="question_detailOwner"></div>
                                    <p class="mb-4 text-gray-600 fw-semibold fs-6 ps-10" id="answer_detailOwner"></p>
                                    <!-- Menampilkan gambar -->
                                    <img id="image_detailOwner" src="" alt="Image" style="max-width: 100%; display: none;">
                                    <!-- Menampilkan video YouTube -->
                                    <div id="video_detailOwner"></div>
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
                    <div class="modal fade" id="modal_edit_owner">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title-editOwner"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" id="form-updateOwner" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" class="form-control id" id="id_editOwner" readonly>
                                    <div class="form-group mb-3">
                                        <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                        <select class="form-select mb-2" name="faqs_categories" id="faqs_categories_editOwner" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                        <input type="text" class="form-control question_editOwner" name="question" id="question_editOwner" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                        <textarea name="answer_edit" id="answer_editOwner"></textarea>
                                        <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="padding-bottom: 2%">
                                            <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                            <input type="file" class="form-control form-control-transparent" name="imageOwner" id="image_editOwner" accept=".jpg, .jpeg, .png">
                                            <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                            <img id="image_preview_editOwner" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                        <input type="text" class="form-control url" name="url" id="url_edit" />
                                        <div id="video_preview_editOwner" style="margin-top: 10px;"></div>
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
            <div class="col-xl-6">
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h4 class="text-dark fw-bold fs-4">FaQ User Pembeli</h4>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAddPembeli">
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableFaQPembeli">
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
                    <div class="modal fade" id="modalAddPembeli">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content" style="border-radius: 8px;">
                            <div class="content-header">
                                <div class="content-title">
                                    <h4 class="css-lk3jsp">Tambah FaQ User Pembeli</h4>
                                </div>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="css-flj2ej">
                                <div class="css-fjkpo0ma">
                                    <div class="css-wj23sk">
                                    <form action="{{ route('admin.admin_faq_user_pembeli_store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                            <select class="form-select mb-2" name="faqs_categories" data-control="select2" data-placeholder="Pilih Tipe Kategori" data-allow-clear="true" required>
                                                <option></option>
                                                @foreach ($cat_pembeli as $cat_pem)
                                                    <option value="{{ $cat_pem->id }}">{{ $cat_pem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                            <input type="text" class="form-control questionPembeli" name="question" id="questionPembeli" required>
                                        </div>
                                        <div class="form-group" style="padding-bottom: 2%">
                                            <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                            <textarea name="answer" id="answerPembeli"></textarea>
                                            <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 2%">
                                                <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                                <input type="file" class="form-control form-control-transparent" name="image" id="imagePembeli" accept=".jpg, .jpeg, .png">
                                                <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                                <img id="image_preview_pembeli" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                            <input type="text" class="form-control url" name="url" id="url" />
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
                    <div class="modal fade" id="modal_detail_pembeli">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fs-2x" id="modal-title-detail-pembeli"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="fs-2x text-gray-800 w-bolder mb-6" id="question_detail_pembeli"></div>
                                    <p class="mb-4 text-gray-600 fw-semibold fs-6 ps-10" id="answer_detail_pembeli"></p>
                                    <!-- Menampilkan gambar -->
                                    <img id="image_detail_pembeli" src="" alt="Image" style="max-width: 100%; display: none;">
                                    <!-- Menampilkan video YouTube -->
                                    <div id="video_detail_pembeli"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                        Batalkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Modal Edit FaQ -->
                    <div class="modal fade" id="modal_edit_pembeli">
                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal-title-edit-pembeli"></h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" id="form-update-pembeli" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" class="form-control id" id="id_editPembeli" readonly>
                                    <div class="form-group mb-3">
                                        <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                        <select class="form-select mb-2" name="faqs_categories" id="faqs_categories_edit_pembeli" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($cat_pembeli as $cat_pem)
                                                    <option value="{{ $cat_pem->id }}">{{ $cat_pem->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                        <input type="text" class="form-control question" name="question" id="question_edit_pembeli" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                        <textarea name="answer_edit" id="answer_edit_pembeli"></textarea>
                                        <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="padding-bottom: 2%">
                                            <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                            <input type="file" class="form-control form-control-transparent" name="image" id="image_edit_pembeli" accept=".jpg, .jpeg, .png">
                                            <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                            <img id="image_preview_edit_pembeli" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                        <input type="text" class="form-control url" name="url" id="url_edit" />
                                        <div id="video_preview_edit_pembeli" style="margin-top: 10px;"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                        Batalkan
                                    </button>
                                    <button type="submit" id="updatePembeli" class="css-kl2kd9a">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <br> <br>
        
        <div class="row">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h4 class="text-dark fw-bold fs-4">FaQ User Pegawai</h4>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAddPegawai">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah FaQ Pegawai
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableFaQPegawai">
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
                <div class="modal fade" id="modalAddPegawai">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content" style="border-radius: 8px;">
                        <div class="content-header">
                            <div class="content-title">
                                <h4 class="css-lk3jsp">Tambah FaQ User Pegawai</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="css-flj2ej">
                            <div class="css-fjkpo0ma">
                                <div class="css-wj23sk">
                                <form action="{{ route('admin.admin_faq_user_pegawai_store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                        <select class="form-select mb-2" name="faqs_categories" data-control="select2" data-placeholder="Pilih Tipe Kategori" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($cat_pegawai as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                        <input type="text" class="form-control questionPegawai" name="question" id="questionPegawai" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                        <textarea name="answer" id="answer_pegawai"></textarea>
                                        <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" style="padding-bottom: 2%">
                                            <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                            <input type="file" class="form-control form-control-transparent" name="image" id="image_pegawai" accept=".jpg, .jpeg, .png">
                                            <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                            <img id="image_preview_pegawai" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                        <input type="text" class="form-control url" name="url" id="url_pegawai" />
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
                <div class="modal fade" id="modal_detail_pegawai">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fs-2x" id="modal-title-detail-pegawai"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="fs-2x text-gray-800 w-bolder mb-6" id="question_detail_pegawai"></div>
                                <p class="mb-4 text-gray-600 fw-semibold fs-6 ps-10" id="answer_detail_pegawai"></p>
                                <!-- Menampilkan gambar -->
                                <img id="image_detail_pegawai" src="" alt="Image" style="max-width: 100%; display: none;">
                                <!-- Menampilkan video YouTube -->
                                <div id="video_detail_pegawai"></div>
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
                <div class="modal fade" id="modal_edit_pegawai">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title-edit-pegawai"></h4>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="form-update-pegawai" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" class="form-control id" id="id_edit_pegawai" readonly>
                                <div class="form-group mb-3">
                                    <label class="form-label required" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tipe Kategori</label>
                                    <select class="form-select mb-2" name="faqs_categories" id="faqs_categories_edit_pegawai" data-control="select2" data-placeholder="Pilih Tipe User" data-allow-clear="true" required>
                                        <option></option>
                                        @foreach ($cat_pegawai as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="required fw-semibold fs-6 mb-1">Pertanyaan</label>
                                    <input type="text" class="form-control question" name="question" id="question_edit_pegawai" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jawaban</label>
                                    <textarea name="answer_edit" id="answer_edit_pegawai"></textarea>
                                    <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan jawaban memuat penjelasan yang jelas.</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding-bottom: 2%">
                                        <label class="fs-6 fw-semibold mb-2">Attach Image</label>
                                        <input type="file" class="form-control form-control-transparent" name="image" id="image_edit_pegawai" accept=".jpg, .jpeg, .png">
                                        <span style="color: blue; font-size: 11px">Mohon untuk melampirkan gambar dengan format .jpg atau .png (jika diperlukan)</span> <br>
                                        <img id="image_preview_pegawai_edit" src="#" alt="Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="fw-semibold fs-6 mb-1">Url Video</label>
                                    <input type="text" class="form-control url" name="url" id="url_edit_pegawai" />
                                    <div id="video_preview_edit" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                    Batalkan
                                </button>
                                <button type="submit" id="update_pegawai" class="css-kl2kd9a">Simpan</button>
                                </form>
                            </div>
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
        CKEDITOR.replace( 'answerOwner' );
        CKEDITOR.replace( 'answerPembeli' );
        CKEDITOR.replace( 'answer_pegawai' );
        CKEDITOR.replace( 'answer_editOwner' );
        CKEDITOR.replace( 'answer_edit_pembeli' );
        CKEDITOR.replace( 'answer_edit_pegawai' );
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableFaQOwner').DataTable({
                processing: true,
                serverSide: false,
                ajax: "/admin/setting/faq/user/get_data_faq_user_owner",
                columns: [
                    { data: "category_name" },
                    {
                        data: "question",
                        render: function(data, type, row) {
                            return data.length > 20 ? data.substr(0, 40) + '...' : data;
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
                                                <button onclick="detailCatOwner(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-circle-info me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="editCatOwner(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="deleteCatOwner(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
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

        function detailCatOwner(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_owner_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_detail_owner').modal('show');
                    $('#modal-title-detailOwner').text('Kategori ' + data.category_name);
                    $('#question_detailOwner').text(data.question);
                    $('#answer_detailOwner').html(data.answer);
                    // Menampilkan gambar
                    if (data.image_path) {
                        var imagePath = '/' + data.image_path;
                        $('#image_detailOwner').attr('src', imagePath).show();
                    } else {
                        $('#image_detailOwner').hide();
                    }
                    // Menampilkan video YouTube
                    if (data.url) {
                        $('#video_detailOwner').html(data.url).show();
                    } else {
                        $('#video_detailOwner').hide();
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function editCatOwner(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_owner_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_edit_owner').modal('show');
                    $('#modal-title-editOwner').text('Edit Data Kategori FaQ');
                    $('#id_editOwner').val(data.id);
                    $('#faqs_categories_editOwner').val(data.category_id).trigger('change');
                    $('#question_editOwner').val(data.question);
                    CKEDITOR.instances['answer_editOwner'].setData(data.answer);
                    // Menampilkan gambar jika ada
                    if (data.imageOwner) {
                        var imagePath_edit = '/' + data.image_path;
                        $('#image_preview_editOwner').attr('src', imagePath_edit);
                        $('#image_preview_editOwner').css('display', 'block');
                    } else {
                        $('#image_preview_editOwner').attr('src', '#');
                        $('#image_preview_editOwner').css('display', 'none');
                    }
                    
                    // Menampilkan video YouTube jika ada
                    if (data.url) {
                        $('#video_preview_editOwner').html(data.url);
                    } else {
                        $('#video_preview_editOwner').html('');
                    }
                    $('#update').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Action Update
        $(document).ready(function() {
            $('#form-updateOwner').submit(function(e) {
                e.preventDefault();

                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                
                let formData = new FormData(this);
                $('#modal_edit_owner').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/setting/faq/user/faq_user_owner_update",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableFaQOwner').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                            $('#tableFaQOwner').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function deleteCatOwner(id) {
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
                        url: '/admin/setting/faq/user/faq_user_owner_delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableFaQOwner').DataTable().ajax.reload();
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

    <!-- Image Preview -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_previewOwner').attr('src', e.target.result);
                    $('#image_previewOwner').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURL
            $('#imageOwner').change(function() {
                readURL(this);
            });
        });
    </script>
    <script>
        function readURLEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_editOwner').attr('src', e.target.result);
                    $('#image_preview_editOwner').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURLEdit
            $('#image_editOwner').change(function() {
                readURLEdit(this);
            });
        });
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableFaQPembeli').DataTable({
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
                                                <button onclick="detailCat_Pembeli(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-circle-info me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="editCat_Pembeli(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="deleteCat_Pembeli(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
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

        function detailCat_Pembeli(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pembeli_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_detail_pembeli').modal('show');
                    $('#modal-title-detail-pembeli').text('Kategori ' + data.category_name);
                    $('#question_detail_pembeli').text(data.question);
                    $('#answer_detail_pembeli').html(data.answer);
                    // Menampilkan gambar
                    if (data.image_path) {
                        var imagePath = '/' + data.image_path;
                        $('#image_detail_pembeli').attr('src', imagePath).show();
                    } else {
                        $('#image_detail_pembeli').hide();
                    }
                    // Menampilkan video YouTube
                    if (data.url) {
                        $('#video_detail_pembeli').html(data.url).show();
                    } else {
                        $('#video_detail_pembeli').hide();
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function editCat_Pembeli(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pembeli_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_edit_pembeli').modal('show');
                    $('#modal-title-edit-pembeli').text('Edit Data Kategori FaQ');
                    $('#id_editPembeli').val(data.id);
                    $('#faqs_categories_edit_pembeli').val(data.category_id).trigger('change');
                    $('#question_edit_pembeli').val(data.question);
                    CKEDITOR.instances['answer_edit_pembeli'].setData(data.answer);
                    // Menampilkan gambar jika ada
                    if (data.image) {
                        var imagePath_edit = '/' + data.image_path;
                        $('#image_preview_edit_pembeli').attr('src', imagePath_edit);
                        $('#image_preview_edit_pembeli').css('display', 'block');
                    } else {
                        $('#image_preview_edit_pembeli').attr('src', '#');
                        $('#image_preview_edit_pembeli').css('display', 'none');
                    }
                    
                    // Menampilkan video YouTube jika ada
                    if (data.url) {
                        $('#video_preview_edit_pembeli').html(data.url);
                    } else {
                        $('#video_preview_edit_pembeli').html('');
                    }
                    $('#updatePembeli').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Action Update
        $(document).ready(function() {
            $('#form-update-pembeli').submit(function(e) {
                e.preventDefault();

                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                let formData = new FormData(this);
                $('#modal_edit_pembeli').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/setting/faq/user/faq_user_pembeli_update",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableFaQPembeli').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                            $('#tableFaQPembeli').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function deleteCat_Pembeli(id) {
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
                                $('#tableFaQPembeli').DataTable().ajax.reload();
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

    <!-- Image Preview -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_pembeli').attr('src', e.target.result);
                    $('#image_preview_pembeli').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURL
            $('#imagePembeli').change(function() {
                readURL(this);
            });
        });
    </script>
    <script>
        function readURLEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_edit_pembeli').attr('src', e.target.result);
                    $('#image_preview_edit_pembeli').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURLEdit
            $('#image_edit_pembeli').change(function() {
                readURLEdit(this);
            });
        });
    </script>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableFaQPegawai').DataTable({
                processing: true,
                serverSide: false,
                ajax: "/admin/setting/faq/user/get_data_faq_user_pegawai",
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
                                                <button onclick="detailCatPegawai(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-circle-info me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="editCatPegawai(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="deleteCatPegawai(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
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

        function detailCatPegawai(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pegawai_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_detail_pegawai').modal('show');
                    $('#modal-title-detail-pegawai').text('Kategori ' + data.category_name);
                    $('#question_detail_pegawai').text(data.question);
                    $('#answer_detail_pegawai').html(data.answer);
                    // Menampilkan gambar
                    if (data.image_path) {
                        var imagePath = '/' + data.image_path;
                        $('#image_detail_pegawai').attr('src', imagePath).show();
                    } else {
                        $('#image_detail_pegawai').hide();
                    }
                    // Menampilkan video YouTube
                    if (data.url) {
                        $('#video_detail_pegawai').html(data.url).show();
                    } else {
                        $('#video_detail_pegawai').hide();
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function editCatPegawai(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/setting/faq/user/faq_user_pegawai_edit',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modal_edit_pegawai').modal('show');
                    $('#modal-title-edit-pegawai').text('Edit Data Kategori FaQ');
                    $('#id_edit_pegawai').val(data.id);
                    $('#faqs_categories_edit_pegawai').val(data.category_id).trigger('change');
                    $('#question_edit_pegawai').val(data.question);
                    CKEDITOR.instances['answer_edit_pegawai'].setData(data.answer);
                    // Menampilkan gambar jika ada
                    if (data.image) {
                        var imagePath_edit = '/' + data.image_path;
                        $('#image_preview_pegawai_edit').attr('src', imagePath_edit);
                        $('#image_preview_pegawai_edit').css('display', 'block');
                    } else {
                        $('#image_preview_pegawai_edit').attr('src', '#');
                        $('#image_preview_pegawai_edit').css('display', 'none');
                    }
                    
                    // Menampilkan video YouTube jika ada
                    if (data.url) {
                        $('#video_preview_edit').html(data.url);
                    } else {
                        $('#video_preview_edit').html('');
                    }
                    $('#update_pegawai').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        // Action Update
        $(document).ready(function() {
            $('#form-update-pegawai').submit(function(e) {
                e.preventDefault();

                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                
                let formData = new FormData(this);
                $('#modal_edit_pegawai').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "/admin/setting/faq/user/faq_user_pegawai_update",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#tableFaQPegawai').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                            $('#tableFaQPegawai').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function deleteCatPegawai(id) {
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
                        url: '/admin/setting/faq/user/faq_user_pegawai_delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#tableFaQPegawai').DataTable().ajax.reload();
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

    <!-- Image Preview -->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_pegawai').attr('src', e.target.result);
                    $('#image_preview_pegawai').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURL
            $('#image_pegawai').change(function() {
                readURL(this);
            });
        });
    </script>
    <script>
        function readURLEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview_pegawai_edit').attr('src', e.target.result);
                    $('#image_preview_pegawai_edit').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Ketika input file berubah, panggil fungsi readURLEdit
            $('#image_edit_pegawai').change(function() {
                readURLEdit(this);
            });
        });
    </script>
@endsection