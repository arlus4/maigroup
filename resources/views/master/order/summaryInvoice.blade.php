@extends('layout-master/app')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">Summary Invoice {{ $data->invoice_no }}</h1>
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    @if ($data->progress == '2')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#terimaPembayaran"> Terima Pembayaran </button>
                    @elseif ($data->progress == '3')
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#kirimPesanan"> Kirim Pesanan </button>
                    @else
                        <a href="/admin/order" class="btn btn-md fw-bold btn-primary">Kembali</a>
                    @endif
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
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
                <!--begin::Order details page-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <!--begin::Order summary-->
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <!--begin::Order details-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Order Details</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor" />
                                                                <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Order Date
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ \Carbon\Carbon::parse($data->date_created)->format('d F Y') }}</td>
                                            </tr>
                                            <!--end::Date-->
                                            <!--begin::Payment method-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor" />
                                                                <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Payment Method
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $konfirmasi->nama_bank }}
                                                    <img src="{{ asset($konfirmasi->path_icon_bank) }}" class="w-50px ms-2" /> 
                                                </td>
                                            </tr>
                                            <!--end::Payment method-->
                                            <!--begin::Date-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
                                                                <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"/>
                                                                <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Payment Date
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ \Carbon\Carbon::parse($konfirmasi->date_created)->format('d F Y') }}</td>
                                            </tr>
                                            <!--end::Date-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Order details-->

                        <!--begin::Customer details-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Customer Details</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Customer name-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                                                <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor" />
                                                                <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Outlet Name
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $data->nama_outlet }}</td>
                                            </tr>
                                            <!--end::Customer name-->
                                            <!--begin::Customer email-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z" fill="currentColor"/>
                                                                <path d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Outlet ID
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $data->outlet_id }}</td>
                                            </tr>
                                            <!--end::Payment method-->
                                            <!--begin::Date-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Phone
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $data->nomor_telfon }}</td>
                                            </tr>
                                            <!--end::Date-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Customer details-->
                        
                        <!--begin::Documents-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Documents</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Invoice-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor" />
                                                                <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor" />
                                                                <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Invoice
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $data->invoice_no }}</td>
                                            </tr>
                                            <!--end::Invoice-->
                                            <!--begin::Shipping-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->Shipping ID
                                                    </div>
                                                </td>
                                                @if ($shipping != null)
                                                    <td class="fw-bold text-end">#{{ $shipping->no_resi }}</td>
                                                @else
                                                    <td class="fw-bold text-end">Data Belum Tersedia</td>
                                                @endif
                                            </tr>
                                            <!--end::Shipping-->
                                            <!--begin::Rewards-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="25" height="28" viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M24.0259 11.4401H1.97259C1.69436 11.4505 1.43123 11.5693 1.2394 11.7711C1.04757 11.9729 0.942247 12.2417 0.945922 12.5201V20.0801C0.933592 21.0248 1.10836 21.9627 1.46016 22.8395C1.81196 23.7164 2.33382 24.515 2.99568 25.1892C3.65754 25.8635 4.4463 26.4001 5.3165 26.7681C6.1867 27.1361 7.12112 27.3282 8.06592 27.3334H17.9993C19.8855 27.288 21.6778 26.5012 22.988 25.1436C24.2983 23.7859 25.0208 21.9667 24.9993 20.0801V12.5201C25.0037 12.2504 24.9057 11.989 24.7251 11.7886C24.5445 11.5882 24.2947 11.4637 24.0259 11.4401ZM8.73259 21.8401C8.51017 21.84 8.29271 21.7744 8.1073 21.6515C7.92189 21.5287 7.77672 21.354 7.68989 21.1492C7.60306 20.9444 7.5784 20.7186 7.61899 20.5C7.65957 20.2813 7.76361 20.0794 7.91813 19.9194C8.07266 19.7594 8.27084 19.6484 8.48798 19.6003C8.70513 19.5522 8.93164 19.569 9.1393 19.6487C9.34695 19.7283 9.52658 19.8673 9.65578 20.0484C9.78499 20.2294 9.85807 20.4445 9.86592 20.6668C9.86241 20.965 9.74146 21.2499 9.5293 21.4595C9.31714 21.6692 9.03087 21.7868 8.73259 21.7868V21.8401ZM8.73259 17.5868C8.50844 17.5868 8.28932 17.5203 8.10294 17.3958C7.91657 17.2712 7.77131 17.0942 7.68553 16.8871C7.59975 16.6801 7.5773 16.4522 7.62103 16.2323C7.66476 16.0125 7.7727 15.8105 7.9312 15.652C8.0897 15.4935 8.29164 15.3856 8.51149 15.3419C8.73133 15.2981 8.95921 15.3206 9.1663 15.4064C9.37339 15.4921 9.55039 15.6374 9.67492 15.8238C9.79945 16.0102 9.86592 16.2293 9.86592 16.4534C9.86771 16.6028 9.83962 16.7509 9.7833 16.8892C9.72697 17.0276 9.64356 17.1532 9.53796 17.2588C9.43236 17.3644 9.30672 17.4478 9.1684 17.5041C9.03009 17.5605 8.88192 17.5886 8.73259 17.5868ZM12.9993 21.8401C12.701 21.8331 12.4175 21.7088 12.2104 21.4941C12.0032 21.2794 11.889 20.9917 11.8926 20.6934C11.8926 20.3964 12.0106 20.1115 12.2206 19.9015C12.4307 19.6914 12.7155 19.5734 13.0126 19.5734C13.3096 19.5734 13.5945 19.6914 13.8045 19.9015C14.0146 20.1115 14.1326 20.3964 14.1326 20.6934C14.1291 20.9917 14.0081 21.2765 13.796 21.4862C13.5838 21.6959 13.2975 21.8135 12.9993 21.8134V21.8401ZM12.9993 17.5868C12.701 17.5798 12.4175 17.4555 12.2104 17.2408C12.0032 17.0261 11.889 16.7384 11.8926 16.4401C11.8926 16.1431 12.0106 15.8582 12.2206 15.6481C12.4307 15.4381 12.7155 15.3201 13.0126 15.3201C13.3096 15.3201 13.5945 15.4381 13.8045 15.6481C14.0146 15.8582 14.1326 16.1431 14.1326 16.4401C14.1326 16.7384 14.015 17.0246 13.8054 17.2368C13.5957 17.449 13.3109 17.5699 13.0126 17.5734L12.9993 17.5868ZM17.2393 21.8401C16.9387 21.8401 16.6504 21.7207 16.4379 21.5082C16.2253 21.2956 16.1059 21.0073 16.1059 20.7068C16.1059 20.4062 16.2253 20.1179 16.4379 19.9054C16.6504 19.6928 16.9387 19.5734 17.2393 19.5734C17.5398 19.5734 17.8281 19.6928 18.0406 19.9054C18.2532 20.1179 18.3726 20.4062 18.3726 20.7068C18.3726 21.0073 18.2532 21.2956 18.0406 21.5082C17.8281 21.7207 17.5398 21.8401 17.2393 21.8401ZM17.2393 17.5868C16.9387 17.5868 16.6504 17.4674 16.4379 17.2548C16.2253 17.0423 16.1059 16.754 16.1059 16.4534C16.1059 16.1529 16.2253 15.8646 16.4379 15.652C16.6504 15.4395 16.9387 15.3201 17.2393 15.3201C17.5398 15.3201 17.8281 15.4395 18.0406 15.652C18.2532 15.8646 18.3726 16.1529 18.3726 16.4534C18.3726 16.754 18.2532 17.0423 18.0406 17.2548C17.8281 17.4674 17.5398 17.5868 17.2393 17.5868ZM24.6393 8.13343C24.7349 8.40774 24.7203 8.7085 24.5984 8.9722C24.4765 9.2359 24.2569 9.44192 23.9859 9.54677C23.8703 9.58813 23.7487 9.61063 23.6259 9.61343H2.62592C2.2723 9.61343 1.93316 9.47296 1.68311 9.22291C1.43306 8.97286 1.29259 8.63372 1.29259 8.2801C1.28883 8.11525 1.32066 7.95153 1.38592 7.8001C1.77683 6.84295 2.37003 5.98161 3.12487 5.27509C3.87972 4.56858 4.77837 4.03358 5.75926 3.70677V1.62677C5.75926 1.3863 5.85478 1.15569 6.02481 0.985655C6.19485 0.815622 6.42546 0.720099 6.66592 0.720099C6.90639 0.720099 7.137 0.815622 7.30703 0.985655C7.47707 1.15569 7.57259 1.3863 7.57259 1.62677V3.33343H12.3059V1.62677C12.2904 1.49938 12.3021 1.37015 12.3402 1.24761C12.3783 1.12508 12.442 1.01204 12.5271 0.915961C12.6122 0.819883 12.7167 0.74296 12.8337 0.690277C12.9507 0.637594 13.0776 0.610352 13.2059 0.610352C13.3343 0.610352 13.4611 0.637594 13.5781 0.690277C13.6952 0.74296 13.7997 0.819883 13.8847 0.915961C13.9698 1.01204 14.0335 1.12508 14.0716 1.24761C14.1098 1.37015 14.1215 1.49938 14.1059 1.62677V3.33343H18.3326V1.62677C18.3171 1.49938 18.3287 1.37015 18.3669 1.24761C18.405 1.12508 18.4687 1.01204 18.5538 0.915961C18.6389 0.819883 18.7434 0.74296 18.8604 0.690277C18.9774 0.637594 19.1043 0.610352 19.2326 0.610352C19.3609 0.610352 19.4878 0.637594 19.6048 0.690277C19.7218 0.74296 19.8263 0.819883 19.9114 0.915961C19.9965 1.01204 20.0602 1.12508 20.0983 1.24761C20.1364 1.37015 20.1481 1.49938 20.1326 1.62677V3.70677C21.1713 4.05261 22.1173 4.63121 22.8984 5.39839C23.6794 6.16557 24.2749 7.10105 24.6393 8.13343Z" fill="currentColor"/>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        Shipping Date
                                                    </div>
                                                </td>
                                                @if ($shipping != null)
                                                    <td class="fw-bold text-end">{{ \Carbon\Carbon::parse($shipping->tanggal_pengiriman)->format('d F Y') }}</td>
                                                @else
                                                    <td class="fw-bold text-end">Data Belum Tersedia</td>
                                                @endif
                                            </tr>
                                            <!--end::Rewards-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Documents-->
                    </div>
                    <!--end::Order summary-->

                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" role="tab-panel">
                            <!--begin::Orders-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                    <!--begin::Overlay-->
                                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ asset($konfirmasi->path_bukti_pembayaran) }}">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                style="background-image:url('{{ asset($konfirmasi->path_bukti_pembayaran) }}')">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                    </div>
                                    <!--end::Overlay-->

                                    <!--begin::Shipping address-->
                                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                        <!--begin::Background-->
                                        <div class="position-absolute top-0 end-0 opacity-25 pe-none text-end">
                                            <svg width="175" height="175" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"/>
                                                <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"/>
                                            </svg>
                                        </div>
                                        <!--end::Background-->
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Shipping Address</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">{{ $data->alamat_detail }}, {{ $data->nama_kelurahan }},
                                            <br />{{ $data->nama_kecamatan }}, {{ $data->nama_kotakab }},
                                            <br />{{ $data->nama_propinsi }}, {{ $data->kode_pos }}
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Shipping address-->
                                </div>
                                <!--begin::Product List-->
                                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Product List</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-175px">Product</th>
                                                        <th class="min-w-100px text-end">SKU</th>
                                                        <th class="min-w-100px text-end">Qty</th>
                                                        <th class="min-w-100px text-end">Total</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-semibold text-gray-600">
                                                    <!--begin::Products-->
                                                    @foreach ($details as $detail)
                                                        <tr>
                                                            <!--begin::Product-->
                                                            <td>
                                                                <div class="d-flex align-items-center">
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
                                                                        <a href="javascript:;" class="symbol symbol-50px">
                                                                            <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span>
                                                                        </a>
                                                                        <div class="ms-5">
                                                                            <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                            <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                        </div>
                                                                    @endif
                                                                </div>
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
                                                            @if ($detail->total_amount == null)
                                                                <td class="text-end">
                                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#inputHarga" data-bs-sku="{{ $detail->sku_id }}">Input Harga</button>
                                                                </td>
                                                            @else
                                                                <td class="text-end">@rupiah($detail->total_amount)</td>
                                                            @endif
                                                            <!--end::Total-->
                                                        </tr>
                                                    @endforeach
                                                    <!--end::Products-->
                                                    <!--begin::Subtotal-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Subtotal</td>
                                                        @php
                                                            $isConfirmationNeeded = false;
                                                            foreach ($details as $detail) {
                                                                if ($detail->total_amount == null) {
                                                                    $isConfirmationNeeded = true;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp

                                                        @if ($isConfirmationNeeded)
                                                            <td class="text-end">Data Belum Lengkap</td>
                                                        @else
                                                            <td class="text-end">@rupiah($data->amount)</td>
                                                        @endif
                                                    </tr>
                                                    <!--end::Subtotal-->
                                                    <!--begin::Shipping-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Ongkos Kirim</td>
                                                        @if ($data->ongkir == null)
                                                            <td class="text-end">
                                                                <button type="button" onclick="modalUpdateOngkir('{{ $data->invoice_no }}')" class="btn btn-primary btn-sm cursor-pointer">Input Ongkir</button>
                                                            </td>
                                                        @else
                                                            <td class="text-end">@rupiah($data->ongkir)</td>
                                                        @endif
                                                    </tr>
                                                    <!--end::Shipping-->
                                                    <!--begin::Unique Code-->
                                                    <tr>
                                                        <td colspan="3" class="text-end">Kode Unik</td>
                                                        @if ($data->kode_unik == null)
                                                            <td class="text-end">Data Belum Lengkap</td>
                                                        @else
                                                            <td class="text-end">@rupiah($data->kode_unik)</td>
                                                        @endif
                                                    </tr>
                                                    <!--end::Unique Code-->
                                                    <!--begin::Total-->
                                                    <tr>
                                                        <td colspan="3" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                        @if ($data->total == null)
                                                            <td class="text-end">Data Belum Lengkap</td>
                                                        @else
                                                            <td class="text-dark fs-3 fw-bolder text-end">@rupiah($data->total)</td>
                                                        @endif
                                                    </tr>
                                                    <!--end::Total-->
                                                </tbody>
                                                <!--end::Table head-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-5">
                                            <button type="button" onclick="window.location.href='/admin/download-invoice/{{ $data->invoice_no }}'" class="btn btn-success my-1 me-12">Download</button>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Product List-->
                            </div>
                            <!--end::Orders-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Order details page-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

        <!-- Modal Approve Order -->
        <div class="modal fade" tabindex="-1" id="terimaPembayaran">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formTerimaPembayaran">
                        @csrf
                        <div class="modal-header">
                            <h4 class="css-lk3jsp" style="text-align: center;">Terima Pembayaran</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="col-md-12 fv-row" >
                                <span style="font-size: 15px">
                                    Apakah Anda yakin untuk Menerima Pembayaran dengan nomor invoice <span class="badge badge-dark badge-lg">{{ $data->invoice_no }}</span> ?
                                </span>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Ya, Terima Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Deliver Order -->
        <div class="modal fade" tabindex="-1" id="kirimPesanan">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formKirimPesanan">
                        @csrf
                        <div class="modal-header">
                            <h4 class="css-lk3jsp" style="text-align: center;">Kirim Pesanan</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <div class="col-md-12 fv-row" >
                                <div class="col-md-12 fv-row" >
                                    <strong><p style="text-align: center;">Mohon Periksa Kembali Pesanan yang dibuat</p></strong> 
                                    <span style="font-size: 15px">
                                        <p style="text-align: center;">Apakah Anda yakin untuk Mengirim Pesanan dengan nomor invoice <span class="badge badge-dark badge-lg">{{ $data->invoice_no }}</span> ?</p>
                                    </span>
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nomor Resi</label>
                                        <input type="text" name="no_resi" class="form-control mb-2" required>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Ekspedisi</label>
                                        <input type="text" name="nama_ekspedisi" class="form-control mb-2" required>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tanggal Pengiriman</label>
                                        <input type="date" name="tanggal_pengiriman" class="form-control mb-2" id="tanggal_pengiriman" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Kirim Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->

@endsection

@section('script')
<script src="{{ asset('assets/master/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

<script>
    $('#formTerimaPembayaran').submit(function(e) {
        e.preventDefault();
        var invoiceNo = '{{ $data->invoice_no }}';
        var actionUrl = "/admin/store_payment_received_order/" + invoiceNo;

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Tangani respons sukses
                $('#terimaPembayaran').modal('hide');

                if(response.status === 'success') {
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                         if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: response.responseJSON.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });
</script>

<script>
    $('#formKirimPesanan').submit(function(e) {
        e.preventDefault();
        var invoiceNo = '{{ $data->invoice_no }}';
        var actionUrl = "/admin/store_approve_order/" + invoiceNo;

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Tangani respons sukses
                $('#kirimPesanan').modal('hide');

                if(response.status === 'success') {
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                         if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: response.responseJSON.message,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });
</script>
@endsection