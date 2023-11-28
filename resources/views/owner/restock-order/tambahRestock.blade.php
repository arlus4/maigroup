@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Tambah Restock Order</h1>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
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
            <form action="{{ route('owner.owner_store_restock_order') }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="tab-content">
                        <input type="hidden" name="outlet_id" value="{{ Auth::user()->outlet_id }}">
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2 style="font-size: 16px;">Pengelolaan Paket</h2>
                                        </div>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="d-flex flex-column">
                                            <div class="mb-13 text-center">
                                                <div class="text-gray-900 fw-semibold fs-6">
                                                    Pilih Paket Sesuai Kebutuhan Outlet Anda, untuk detail Paket Silahkan
                                                    <a href="#" class="link-primary fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Klik Disini</a>
                                                </div>
                                            </div>
                                            <div class="row g-10">
                                                <div data-kt-buttons="true">
                                                    <div class="row mb-4">
                                                        <div class="col-md-4">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5">
                                                                <div class="d-flex align-items-center me-2">
                                                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                                        <input class="form-check-input" type="radio" name="plan" value="startup" />
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h3 class="d-flex align-items-center fs-6 fw-bold flex-wrap">Paket 25</h3>
                                                                        <div class="fw-semibold fs-7 opacity-50">Paket Jualan 25 Cup</div>
                                                                        <a class="text-dark fs-8 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPaket25">Lihat Detail > </a>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-5">
                                                                    <span class="mb-2">Rp.</span>
                                                                    <span class="fs-2 fw-bold">50.000</span> <br>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5">
                                                                <div class="d-flex align-items-center me-2">
                                                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                                        <input class="form-check-input" type="radio" name="plan" value="advanced" />
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h3 class="d-flex align-items-center fs-6 fw-bold flex-wrap">Paket 50</h3>
                                                                        <div class="fw-semibold fs-7 opacity-50">Paket Jualan 50 Cup</div>
                                                                        <a class="btn btn-flush detail-link fs-8 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPaket50">Lihat Detail ></a>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-5">
                                                                    <span class="mb-2">Rp.</span>
                                                                    <span class="fs-2 fw-bold">98.000</span> <br>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5">
                                                                <div class="d-flex align-items-center me-2">
                                                                    <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                                        <input class="form-check-input" type="radio" name="plan" value="custom" id="custom" />
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <h3 class="d-flex align-items-center fs-6 fw-bold flex-wrap">Paket Juragan</h3>
                                                                        <div class="fw-semibold fs-7 opacity-50">Paket Jualan Lebih dari 50 Cup</div>
                                                                        <a class="btn btn-flush detail-link fs-8 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPaketJuragan">Lihat Detail ></a>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <br>
                                                            <div class="form-group" style="display: none">
                                                                <select class="form-select" data-kt-repeater="select2" id="qtyPaket" name="qtyPaket" data-placeholder="Pilih QTY">
                                                                    <option></option>
                                                                    @for ($i = 75; $i <= 500; $i +=25) <option value="{{ $i }}">{{ $i }}</option>
                                                                        @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mt-5">
                                                        <a href="javascript:;" class="btn btn-sm btn-danger" id="batal" style="padding:7px 16px;">
                                                            <i class="fas fa-circle-xmark text-white"></i>&nbsp;
                                                            Batalkan Paket
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2 style="font-size: 16px;">Pengelolaan Varian</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div id="data_restock_order">
                                            <div class="form-group">
                                                <div data-repeater-list="data_restock_order">
                                                    <div data-repeater-item>
                                                        <div class="css-dabj72">
                                                            <div class="form-group mb-4">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Pilihan Varian</label>
                                                                <select class="form-select mb-2 produkId" data-kt-repeater="select2" data-placeholder="Pilih Varian" id="produk_id" data-allow-clear="true" name="id_produk">
                                                                    <option></option>
                                                                    @foreach($getProduk as $produk)
                                                                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-4">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">SKU Code</label>
                                                                    <input type="text" name="sku_id" id="sku_code" class="form-control mb-2 sku_code" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Project</label>
                                                                    <input type="text" name="project_name" id="project_name" class="form-control mb-2 project_name" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                    <input type="hidden" name="id_project" id="id_project" class="form-control mb-2 id_project" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="####" readonly>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Harga Satuan</label>
                                                                    <input type="text" name="harga_satuan" id="harga-satuan" class="form-control mb-2 harga-satuan" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-5">
                                                                    <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">QTY</label>
                                                                    <select class="form-select qtyid" data-kt-repeater="select2" id="qty" name="qty" data-placeholder="Pilih QTY">
                                                                        <option></option>
                                                                        @for ($i = 5; $i <= 100; $i +=5) <option value="{{ $i }}">{{ $i }}</option>
                                                                            @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Total Harga</label>
                                                                    <button type="button" class="border-0 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Total Harga = Harga Satuan * Jumlah QTY">
                                                                        <i class="fas fa-info-circle" style="color: #212121;"></i>
                                                                    </button>
                                                                    <input type="text" name="amount" id="amount" class="form-control mb-2 amount" style="background-color: #e2e2e2;cursor: not-allowed;" placeholder="Rp 0" readonly>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="javascript:;" data-repeater-delete>
                                                                        <i class="fas fa-trash text-danger" style="font-size: 18px;margin-top: 35px;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="css-kl2kd9a" style="color: #fff!important;width: 110px;padding:7px 16px;height: 38px;">
                                                    <i class="fas fa-plus-circle text-white"></i>&nbsp;
                                                    Tambah
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                    <div class="card-header align-items-center">
                                        <div class="card-title">
                                            <h2 style="font-size: 16px">Catatan</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="form-group row">
                                            <div class="form-group mt-3">
                                                {{-- <input type="text" name="noted" id="noted" class="form-control mb-2" placeholder="Contoh : Bakso & soto, Jajanan, Minuman"/> --}}
                                                <textarea class="form-control mb-2" name="noted" id="noted" cols="30" rows="7"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a id="kt_ecommerce_add_product_cancel" class="css-ca2jq0s">Batalkan</a>
                        <button type="submit" class="css-kl2kd9a" id="simpan" style="height: 43px;background-color: #e2e2e2;color: #929292;cursor: not-allowed;" disabled>Simpan</button>
                    </div>
                </div>
            </form>


            <!-- Modal Paket 25 -->
            <div class="modal fade" id="modalPaket25" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded">
                        <div class="modal-header justify-content-between border-0 pb-0">
                            <h4 class="card-tittle">Detail Paket 25</h4>
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body pt-0 pb-15 px-5 px-xl-10">
                            <div class="tab-content rounded h-100 bg-light p-10">
                                <div class="pb-5">
                                    <h2 class="fw-bold text-dark">Paket 25</h2>
                                    <div class="text-muted fw-semibold">Paket Jualan 25 Cup Terdiri dari :</div>
                                </div>
                                <div class="pt-1">
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Original MaiTea 90gr</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Gula 1kg</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Cup 22 oz (25 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Plastik (25 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sedotan (25 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Bonus Cup 22 Oz (2 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-muted flex-grow-1">Tutup Plastik</span>
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor"></rect>
                                                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor"></rect>
                                                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Paket 50 -->
            <div class="modal fade" id="modalPaket50" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded">
                        <div class="modal-header justify-content-between border-0 pb-0">
                            <h4 class="card-tittle">Detail Paket 50</h4>
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body pt-0 pb-15 px-5 px-xl-10">
                            <div class="tab-content rounded h-100 bg-light p-10">
                                <div class="pb-5">
                                    <h2 class="fw-bold text-dark">Paket 50</h2>
                                    <div class="text-muted fw-semibold">Paket Jualan 50 Cup Terdiri dari :</div>
                                </div>
                                <div class="pt-1">
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Original MaiTea 180gr</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Gula 2kg</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Cup 22 oz (50 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Plastik (50 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sedotan (50 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Bonus Cup 22 Oz (5 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Tutup Plastik (5 pcs)</span>
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Paket Juragan -->
            <div class="modal fade" id="modalPaketJuragan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded">
                        <div class="modal-header justify-content-between border-0 pb-0">
                            <h4 class="card-tittle">Detail Paket Juragan</h4>
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body pt-0 pb-15 px-5 px-xl-10">
                            <div class="tab-content rounded h-100 bg-light p-10">
                                <div class="pb-5">
                                    <h2 class="fw-bold text-dark">Paket Juragan</h2>
                                    <div class="text-muted fw-semibold">Paket Jualan Juragan Cup Terdiri dari :</div>
                                </div>
                                <div class="pt-1">
                                    <div class="d-flex align-items-center mb-7">
                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sesuai Pesanan</span>
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <!--begin::Modal content-->
                    <div class="modal-content rounded">
                        <!--begin::Modal header-->
                        <div class="modal-header justify-content-end border-0 pb-0">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                            <!--begin::Heading-->
                            <div class="mb-8 text-center">
                                <h1 class="mb-3">Detail Paket</h1>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Plans-->
                            <div class="d-flex flex-column">
                                <!--begin::Row-->
                                <div class="row mt-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6 mb-10 mb-lg-0">
                                        <!--begin::Tabs-->
                                        <div class="nav flex-column">
                                            <!--begin::Tab link-->
                                            <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">
                                                <!--end::Description-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Radio-->
                                                    <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                        <input class="form-check-input" type="radio" name="plan" checked="checked" value="startup" />
                                                    </div>
                                                    <!--end::Radio-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Paket 25</div>
                                                        <div class="fw-semibold opacity-75">Paket Jualan 25 Cup</div>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Description-->
                                                <!--begin::Price-->
                                                <div class="ms-5">
                                                    <span class="mb-2">Rp.</span>
                                                    <span class="fs-2x fw-bold">50.000</span>
                                                </div>
                                                <!--end::Price-->
                                            </label>
                                            <!--end::Tab link-->
                                            <!--begin::Tab link-->
                                            <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">
                                                <!--end::Description-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Radio-->
                                                    <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                        <input class="form-check-input" type="radio" name="plan" value="advanced" />
                                                    </div>
                                                    <!--end::Radio-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Paket 50</div>
                                                        <div class="fw-semibold opacity-75">Paket Jualan 50 Cup</div>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Description-->
                                                <!--begin::Price-->
                                                <div class="ms-5">
                                                    <span class="mb-2">Rp.</span>
                                                    <span class="fs-2x fw-bold">98.000</span>
                                                </div>
                                                <!--end::Price-->
                                            </label>
                                            <!--end::Tab link-->
                                            <!--begin::Tab link-->
                                            <label class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6" data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_enterprise">
                                                <!--end::Description-->
                                                <div class="d-flex align-items-center me-2">
                                                    <!--begin::Radio-->
                                                    <div class="form-check form-check-custom form-check-solid form-check-success flex-shrink-0 me-6">
                                                        <input class="form-check-input" type="radio" name="plan" value="enterprise" />
                                                    </div>
                                                    <!--end::Radio-->
                                                    <!--begin::Info-->
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center fs-2 fw-bold flex-wrap">Paket Juragan</div>
                                                        <div class="fw-semibold opacity-75">Paket Jualan Lebih dari 50 Cup</div>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Description-->
                                            </label>
                                            <!--end::Tab link-->
                                        </div>
                                        <!--end::Tabs-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Tab content-->
                                        <div class="tab-content rounded h-100 bg-light p-10">
                                            <!--begin::Paket 25-->
                                            <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">
                                                <div class="pb-5">
                                                    <h2 class="fw-bold text-dark">Paket 25</h2>
                                                    <div class="text-muted fw-semibold">Paket Jualan 25 Cup Terdiri dari :</div>
                                                </div>
                                                <div class="pt-1">
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Original MaiTea 90gr</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Gula 1kg</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Cup 22 oz (25 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Plastik (25 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sedotan (25 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Bonus Cup 22 Oz (2 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-muted flex-grow-1">Tutup Plastik</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                        <span class="svg-icon svg-icon-1">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Paket 25-->

                                            <!--begin::Paket 50-->
                                            <div class="tab-pane fade" id="kt_upgrade_plan_advanced">
                                                <div class="pb-5">
                                                    <h2 class="fw-bold text-dark">Paket 50</h2>
                                                    <div class="text-muted fw-semibold">Paket Jualan 50 Cup Terdiri dari :</div>
                                                </div>
                                                <div class="pt-1">
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Original MaiTea 180gr</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Gula 2kg</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Cup 22 oz (50 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Plastik (50 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sedotan (50 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Bonus Cup 22 Oz (5 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Tutup Plastik (5 pcs)</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Paket 50-->

                                            <!--begin::Paket Juragan-->
                                            <div class="tab-pane fade" id="kt_upgrade_plan_enterprise">
                                                <div class="pb-5">
                                                    <h2 class="fw-bold text-dark">Paket Juragan</h2>
                                                </div>
                                                <div class="pt-1">
                                                    <div class="d-flex align-items-center mb-7">
                                                        <span class="fw-semibold fs-5 text-gray-700 flex-grow-1">Sesuai Pesanan</span>
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Paket Juragan-->
                                        </div>
                                        <!--end::Tab content-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Plans-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-center flex-row-fluid pt-12">
                                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Tutup</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Upgrade plan-->
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#data_restock_order').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="select2"]').select2();
                $(this).find('.qtyid').select2();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                $('[data-kt-repeater="select2"]').select2();
            }
        });

        $(document).on('change', '.form-select', function() {
            updateProductDetails($(this).closest('[data-repeater-item]'));
        });

        $(document).on('click', '[data-repeater-create]', function() {
            var newItem = $(this).closest('[data-repeater-group]').find('[data-repeater-item]:last');
            resetFields(newItem);
            newItem.find('.select2').select2();
        });

        $(document).on('change', '.produkId, .qtyid', function() {
            var item = $(this).closest('[data-repeater-item]');
            hitungTotalAmount(item);
        });

        function validasiToggle() {
        var enableSimpanBtn = false;
        $('#data_restock_order [data-repeater-item]').each(function() {
            var pilihanVarian = $(this).find('.produkId').val();
            var qty = $(this).find('.qtyid').val();
            if (pilihanVarian && qty) {
                enableSimpanBtn = true;
                // Hentikan perulangan jika menemukan item yang terisi
                return false;
            }
        });

        // Atur properti disabled dari tombol simpan berdasarkan kondisi item
        $('#simpan').prop('disabled', !enableSimpanBtn);
        ubahButtonStyle(enableSimpanBtn);
    }

    function ubahButtonStyle(isEnabled) {
        if (isEnabled) {
            $('#simpan').css({
                'background-color': '#039344',
                'color': '#fff',
                'cursor': 'pointer'
            });
        } else {
            $('#simpan').css({
                'background-color': '#e2e2e2',
                'color': '#929292',
                'cursor': 'not-allowed'
            });
        }
    }

    $('#data_restock_order').on('change', '.produkId, .qtyid', validasiToggle);

    $('#data_restock_order').on('click', '[data-repeater-delete]', function() {
        // Hapus item repeater
        $(this).closest('[data-repeater-item]').remove();
        validasiToggle();
    });

    $(document).on('click', '[data-repeater-create]', function() {
        setTimeout(validasiToggle, 0);
    });

    // Validasi awal untuk status tombol simpan
    validasiToggle();
    });

    function resetFields(item) {
        item.find('.harga-satuan, .amount, .sku_code, .id_project, .project_name').val('').trigger('change');
    }

    function updateProductDetails(item) {
        var productId = item.find('.produkId').val();
        var qty = item.find('.qtyid').val();

        $.ajax({
            url: 'get-harga-order-penjual/' + productId,
            type: 'GET',
            success: function(response) {
                var hargaSatuan = parseFloat(response.harga.replace(/\D/g, ''));
                if (!isNaN(qty) && !isNaN(hargaSatuan)) {
                    var totalAmount = hargaSatuan * qty;
                    item.find('.amount').val(formatRupiah(totalAmount)).trigger('change');
                } else {
                    item.find('.amount').val('');
                }

                item.find('.sku_code').val(response.sku);
                item.find('.project_name').val(response.project_name);
                item.find('.id_project').val(response.id_project);
                item.find('.harga-satuan').val(formatRupiah(response.harga));
            },
            error: function(error) {
                console.error('Gagal memuat harga:', error);
                item.find('.amount').val('');
            }
        });
    }

    function formatRupiah(angka) {
        var number_string = angka.toString();
        var split = number_string.split('.');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }

    function hitungTotalAmount(item) {
        var qty = parseFloat(item.find('.qty').val());
        var hargaSatuanString = item.find('.harga-satuan').val();
        var numbersFromString = hargaSatuanString.match(/\d+/g);
        var hargaSatuanCleaned = numbersFromString ? numbersFromString.join('') : '';
        var hargaSatuan = parseFloat(hargaSatuanCleaned);

        if (!isNaN(qty) && !isNaN(hargaSatuan)) {
            var totalAmount = hargaSatuan * qty;
            item.find('.amount').val(formatRupiah(totalAmount));
        } else {
            item.find('.amount').val('');
        }
    }

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menampilkan atau menyembunyikan form select
    function toggleSelect(customSelected) {
        var selectDiv = document.querySelector('.form-group');
        var selectElement = document.getElementById('qtyPaket');
        if (customSelected) {
            selectDiv.style.display = 'block';
            selectElement.required = true;
        } else {
            selectDiv.style.display = 'none';
            selectElement.required = false;
        }
    }

    // Fungsi untuk memeriksa status tombol Simpan
    function checkSaveButtonStatus() {
        const isAnyPackageSelected = document.querySelector('input[name="plan"]:checked') !== null;
        let isAnyVariantSelected = false;
        
        // Cek jika setidaknya satu varian dan QTY telah dipilih
        document.querySelectorAll('.produkId').forEach(function(select) {
            if (select.value !== "") isAnyVariantSelected = true;
        });
        
        const saveButton = document.getElementById('simpan');

        // Enable atau disable tombol Simpan berdasarkan kondisi
        if (isAnyPackageSelected && isAnyVariantSelected) {
            saveButton.disabled = false;
            saveButton.style.backgroundColor = '#039344'; // Ganti dengan warna yang diinginkan
            saveButton.style.color = '#fff'; // Ganti dengan warna yang diinginkan
            saveButton.style.cursor = 'pointer';
        } else {
            saveButton.disabled = true;
            saveButton.style.backgroundColor = '#e2e2e2'; // Ganti dengan warna yang diinginkan
            saveButton.style.color = '#929292'; // Ganti dengan warna yang diinginkan
            saveButton.style.cursor = 'not-allowed';
        }
    }

    // Menyembunyikan select pada awal load halaman
    toggleSelect(false);

    // Event listener untuk radio buttons
    var radios = document.querySelectorAll('input[type="radio"][name="plan"]');
    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            toggleSelect(this.id === 'custom');
            checkSaveButtonStatus(); // Memeriksa status tombol Simpan setiap kali ada perubahan pada radio buttons
        });
    });

    // Event listener untuk select varian dan QTY
    document.querySelectorAll('.produkId, .qtyid').forEach(function(select) {
        select.addEventListener('change', checkSaveButtonStatus);
    });

    // Event listener untuk tombol 'batal'
    document.getElementById('batal').addEventListener('click', function() {
        radios.forEach(function(radio) {
            radio.checked = false;
        });
        toggleSelect(false);
        checkSaveButtonStatus(); // Memeriksa status tombol Simpan setelah tombol 'batal' diklik
    });

    // Panggil fungsi ini saat dokumen dimuat untuk mengatur status awal tombol Simpan
    checkSaveButtonStatus();

    });
</script>

{{-- Validasi Button Submit --}}
<script>
    function checkInputs() {
        var isPaketFilled = $('.card:first .form-check-input:checked').length > 0;
        var isVarianFilled = false;

        $('#data_restock_order .form-select, #data_restock_order .form-control').each(function() {
            if ($(this).val() && $(this).val() !== "0") {
                isVarianFilled = true;
                return false; // Keluar dari loop jika sudah menemukan input yang terisi
            }
        });
        $("#simpan").prop('disabled', !(isPaketFilled || isVarianFilled));
    }

    $(document).ready(function() {
        checkInputs();
        $('.card').on('change', '.form-check-input, .form-select, .form-control', checkInputs);
        $('#data_restock_order').on('change', '.form-select, .form-control', checkInputs);
    });
</script>

@endsection