@extends('layout-master/app')
@section('content')

<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Invoice {{ $data->invoice_no }}</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- begin::Invoice 3-->
            <div class="card">
                <!-- begin::Body-->
                <div class="card-body py-20">
                    <!-- begin::Wrapper-->
                    <div class="mw-lg-950px mx-auto w-100">
                        <!-- begin::Header-->
                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                            <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                            <!--end::Logo-->
                            <div class="text-sm-end">
                                <!--begin::Logo-->
                                <a href="javascript:;" class="d-block mw-150px ms-sm-auto">
                                    <img alt="Logo" src="{{ asset('assets/images/ic_maitea.png') }}" class="h-80px" />
                                </a>
                                <!--end::Logo-->
                                <!--begin::Text-->
                                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                    <div>Alamat MaiGroup</div>
                                </div>
                                <!--end::Text-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="pb-12">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column gap-7 gap-md-10">
                                <!--begin::Message-->
                                <div class="fw-bold fs-2">Dear, {{ $data->nama_outlet }}
                                    <br />
                                    <span class="text-muted fs-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, earum!</span>
                                </div>
                                <!--begin::Message-->
                                <!--begin::Separator-->
                                <div class="separator"></div>
                                <!--begin::Separator-->
                                <!--begin::Order details-->
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Tanggal</span>
                                        <span class="fs-5">{{ \Carbon\Carbon::parse($data->date_created)->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Invoice ID</span>
                                        <span class="fs-5">{{ $data->invoice_no }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Alamat Outlet</span>
                                        <span class="fs-6">{{ $data->alamat_detail }}, {{ $data->nama_kelurahan }},
                                            <br />{{ $data->nama_kecamatan }}, {{ $data->nama_kotakab }},
                                            <br />{{ $data->nama_propinsi }}, {{ $data->kode_pos }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Order details-->
                                <!--begin:Order summary-->
                                <div class="d-flex justify-content-between flex-column">
                                    <!--begin::Table-->
                                    <div class="table-responsive border-bottom mb-9">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                                <tr class="border-bottom fs-6 fw-bold text-muted">
                                                    <th class="min-w-175px pb-2">Products</th>
                                                    <th class="min-w-70px text-end pb-2">SKU</th>
                                                    <th class="min-w-80px text-end pb-2">QTY</th>
                                                    <th class="min-w-100px text-end pb-2">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                <!--begin::Products-->
                                                @foreach ($details as $detail)
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="javascript:;" class="symbol symbol-50px">
                                                                    <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                    <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">{{ $detail->sku }}</td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{ $detail->qtyDetailSeller }}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Total-->
                                                        <td class="text-end">@rupiah($detail->total_amount)</td>
                                                        <!--end::Total-->
                                                    </tr>
                                                @endforeach
                                                <!--end::Products-->
                                                <!--begin::Subtotal-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Subtotal</td>
                                                    <td class="text-end">@rupiah($data->amount)</td>
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Ongkos Kirim</td>
                                                    <td class="text-end">@rupiah($data->ongkir)</td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Total-->
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                    <td class="text-dark fs-3 fw-bolder text-end">@rupiah($data->total)</td>
                                                </tr>
                                                <!--end::Total-->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end:Order summary-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                        <!-- begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            {{-- <button type="button" onclick="window.location.href='{{ route('admin.download.invoice', $data->invoice_no) }}'" class="btn btn-success my-1 me-12">Download</button> --}}
                            <button type="button" onclick="window.location.href='/admin/download-invoice/{{ $data->invoice_no }}'" class="btn btn-success my-1 me-12">Download</button>
                            <!-- end::Action-->
                        </div>
                        <!-- end::Footer-->
                    </div>
                    <!-- end::Wrapper-->
                </div>
                <!-- end::Body-->
            </div>
            <!-- end::Invoice 1-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->

@endsection