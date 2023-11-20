<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
		<title>Dashboard MaiTea</title>
		<link rel="shortcut icon" href="{{ asset('assets/images/ic_maitea.png') }}" />
		<link rel="stylesheet" href="fonts.googleapis.com/css7b91.css?family=Inter:300,400,500,600,700" />
		<link href="{{ asset('assets/master/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/master/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
        <style>
            @media print {
                .print-hide {
                    display: none !important;
                }
            }
        </style>
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
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
                                                                                    @if ($detail->sku_id == "PA1")
                                                                                        <div class="ms-5">
                                                                                            <div class="fw-bold">Paket Startup</div>
                                                                                        </div>
                                                                                    @elseif ($detail->sku_id == "PA2")
                                                                                        <div class="ms-5">
                                                                                            <div class="fw-bold">Paket Advanced</div>
                                                                                        </div>
                                                                                    @elseif ($detail->sku_id == "PA3")
                                                                                        <div class="ms-5">
                                                                                            <div class="fw-bold">Paket Custom</div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="d-flex align-items-center">
                                                                                            <!--begin::Thumbnail-->
                                                                                            <a href="javascript:;" class="symbol symbol-50px">
                                                                                                <!-- <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span> -->
                                                                                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($detail->path_thumbnail)) }}" alt="{{ $detail->nama_produk }}">
                                                                                            </a>
                                                                                            <!--end::Thumbnail-->
                                                                                            <!--begin::Title-->
                                                                                            <div class="ms-5">
                                                                                                <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                                                <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                                            </div>
                                                                                            <!--end::Title-->
                                                                                        </div>
                                                                                    @endif
                                                                                </td>
                                                                                <!--end::Product-->
                                                                                <!--begin::SKU-->
                                                                                @if ($detail->sku_id == "PA1")
                                                                                    <td class="text-end">{{ $detail->sku_id }}</td>
                                                                                @elseif ($detail->sku_id == "PA2")
                                                                                    <td class="text-end">{{ $detail->sku_id }}</td>
                                                                                @elseif ($detail->sku_id == "PA3")
                                                                                    <td class="text-end">{{ $detail->sku_id }}</td>
                                                                                @else
                                                                                    <td class="text-end">{{ $detail->sku }}</td>
                                                                                @endif
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
                                                                        <!--begin::Unique Code-->
                                                                        <tr>
                                                                            <td colspan="3" class="text-end">Kode Unik</td>
                                                                            <td class="text-end">@rupiah($data->kode_unik)</td>
                                                                        </tr>
                                                                        <!--end::Unique Code-->
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
                                                    <a href="{{ url()->previous() }}" class="btn btn-md hover-scale fw-bold btn-primary print-hide">Kembali</a>
                                                    <button type="button" class="btn btn-success my-1 me-12 print-hide" onclick="window.print();">Print Invoice</button>
                                                </div>
                                                <!--end::Body-->
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
                    </div>
                </div>
            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                </svg>
            </span>
        </div>
    </body>
</html>
