@extends('layout-master/app')
@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Detail Outlet</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Manajemen Outlet</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">List Outlet</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Detail Outlet</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/admin/outlets/outlet-active" class="btn btn-lg fw-bold btn-primary">Kembali</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
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

                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    @if ($outlet->image_name != NULL)
                                        <img src="https://apps.tokoseru.com/{{ $outlet->path }}" alt="{{ $outlet->image_name }}" />
                                        @if ($outlet->is_active == 1)
                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/avatar.png') }}" alt="image" />
                                        @if ($outlet->is_active == 1)
                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $outlet->outlet_name }}</a>
                                            @if ($outlet->is_verified == 1)
                                                <a href="javascript:;">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor" />
                                                            <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </a>
                                            @endif
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor" />
                                                        <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor" />
                                                        <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{ $outlet->brand_code }}
                                            </a>
                                            <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{ $outlet->no_hp }}
                                            </a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Register Date-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold">{{ \Carbon\Carbon::parse($outlet->created_at)->format('d F Y') }}</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-400">Register Date</div>
                                            </div>
                                            <!--end::Register Date-->
                                            <!--begin::Pendapatan-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold" data-kt-countup="true">@rupiah($pendapatan)</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-400">Total Pendapatan</div>
                                            </div>
                                            <!--end::Pendapatan-->
                                            <!--begin::Penjualan-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold">@rupiah($penjualan)</div>
                                                </div>
                                                <div class="fw-semibold fs-6 text-gray-400">Total Penjualan</div>
                                            </div>
                                            <!--end::Penjualan-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_product_tab">Product</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_penjualan_tab">Penjualan</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_pengeluaran_tab">Pengeluaran</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_setting_tab">Pengaturan</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->

                <!--begin::Content-->
                <div class="tab-content">
                    <!--begin::Overview-->
                    <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                        <!--end::Brand & Owner-->
                        <div class="row g-6 g-xl-9">
                            <!-- Info Brand -->
                            <div class="col-lg-7">
                                <div class="card mb-6 mb-xl-9">
                                    <div class="card-body pt-9 pb-0">
                                        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                            <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                                                <img class="mw-50px mw-lg-75px" src="{{ asset($brand->brand_image_path) }}" alt="{{ $brand->brand_image }}" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $brand->brand_name }}</a>
                                                        </div>
                                                        <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-400">Brand</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                            <tbody class="fw-semibold text-gray-600">
                                                                <tr>
                                                                    <td class="text-muted">
                                                                        <div class="d-flex align-items-center">Brand Code</div>
                                                                    </td>
                                                                    <td class="fw-bold text-end">
                                                                        <a href="javascript:;" class="text-gray-600 text-hover-primary">{{ $brand->brand_code }}</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">
                                                                        <div class="d-flex align-items-center">Brand Category</div>
                                                                    </td>
                                                                    <td class="fw-bold text-end">{{ $brand->category_name }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Owner Outlet -->
                            <div class="col-lg-5">
                                <!--begin::Owner-->
                                <div class="card card-flush flex-row-fluid">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                <div class="d-flex flex-column mt-3">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $owner->name }}</a>
                                                    </div>
                                                    <div class="d-flex flex-wrap fw-semibold mb-1 fs-5 text-gray-400">Owner</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                <tbody class="fw-semibold text-gray-600">
                                                    <tr>
                                                        <td class="text-muted">
                                                            <div class="d-flex align-items-center">
                                                                <span class="svg-icon svg-icon-2 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                Email
                                                            </div>
                                                        </td>
                                                        <td class="fw-bold text-end">
                                                            <a href="javascript:;" class="text-gray-600 text-hover-primary">{{ $owner->email }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">
                                                            <div class="d-flex align-items-center">
                                                                <span class="svg-icon svg-icon-2 me-2">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                                        <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                                Phone
                                                            </div>
                                                        </td>
                                                        <td class="fw-bold text-end">{{ $owner->no_hp }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Owner-->
                            </div>
                        </div>
                        <!--end::Brand & Owner-->

                        <!--begin::Pegawai & Transaksi-->
                        <div class="row g-6 g-xl-9">
                            <!--begin::Pegawai-->
                            <div class="col-lg-4">
                                <div class="card card-flush h-lg-100">
                                    <div class="card-header mt-6">
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bold mb-1">Pegawai</h3>
                                            <div class="fs-6 text-gray-400">Total {{ $pegawai->total() }} Pegawai</div>
                                        </div>
                                        @if ($pegawai->total() >= 5)
                                            <div class="card-toolbar">
                                                <a href="javascript:;" class="btn btn-bg-light btn-active-color-primary btn-sm" onclick="listPegawai()">View All</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                                        @if ($pegawai->isEmpty())
                                            <span class="badge badge-light-info fw-bold px-4 py-3">Belum Memiliki Pegawai</span>
                                        @else
                                            @foreach ($pegawai as $p)
                                                <div class="d-flex align-items-center mb-5">
                                                    <div class="fw-semibold">
                                                        <a href="javascript:;" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{ $p->name }}</a>
                                                        <div class="text-gray-400">{{ $p->email }}</div>
                                                    </div>
                                                    @if ($p->is_active == 1)
                                                        <div class="badge badge-success ms-auto">Active</div>
                                                    @else
                                                        <div class="badge badge-danger ms-auto">Non-Active</div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Pegawai-->
                            
                            <!--begin::Overview - Transaksi-->
                            <div class="col-lg-8">
                                <div class="card card-flush h-lg-100">
                                    <div class="card-header mt-6">
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bold mb-1">History Transaction</h3>
                                            <div class="fs-6 text-gray-400">Total {{ $transaksi->total() }} Transaction</div>
                                        </div>
                                        @if ($transaksi->total() >= 5)
                                            <div class="card-toolbar">
                                                <a href="javascript:;" data-bs-toggle="tab" data-kt-countup-tabs="true" class="btn btn-bg-light btn-active-color-primary btn-sm" id="view-penjualan">View All</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                                        @if ($transaksi->isEmpty())
                                            <span class="badge badge-light-info fw-bold px-4 py-3">Belum Memiliki Transaksi</span>
                                        @else
                                            @foreach ($transaksi as $trans)
                                                <div class="d-flex align-items-center position-relative mb-7">
                                                    <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                                    <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                                        <input class="form-check-input" type="checkbox" disabled/>
                                                    </div>
                                                    <div class="fw-semibold">
                                                        <a href="javascript:;" onclick="detailTransaksi('{{ $trans->invoice_no }}')" class="fs-6 fw-bold text-gray-900 text-hover-primary">{{ $trans->invoice_no }}</a>
                                                        <div class="text-gray-500">Transaction {{ \Carbon\Carbon::parse($trans->created_date)->format('d F Y') }}
                                                            <span class="text-gray-900">Total :
                                                                <a href="javascript:;">@rupiah($trans->amount)</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Overview - Transaksi-->
                        </div> <br> <br>
                        <!--end::Pegawai & Transaksi-->
                    </div>
                    <!--end::Overview-->
                    
                    <!--begin::Product-->
                    <div class="tab-pane fade" id="kt_user_view_product_tab" role="tabpanel">
                        <!--begin::Table Product-->
                        <div class="card card-flush mt-6 mt-xl-9">
                            <div class="card-header mt-5">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">Product {{ $outlet->outlet_name }}</h3>
                                </div>
                                <div class="card-toolbar my-1">
                                    <!--begin::Select-->
                                    <div class="me-6 my-1">
                                        <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All time</option>
                                            <option value="thisyear">This year</option>
                                            <option value="thismonth">This month</option>
                                            <option value="lastmonth">Last month</option>
                                            <option value="last90days">Last 90 days</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Select-->
                                    <div class="me-4 my-1">
                                        <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All Orders</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Declined">Declined</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="In Transit">In Transit</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table id="product_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                        <thead class="fs-7 text-gray-800 text-uppercase">
                                            <tr>
                                                <th class="min-w-250px">Product</th>
                                                <th class="min-w-150px">Category</th>
                                                <th class="min-w-90px">Price</th>
                                                <th class="min-w-90px">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end::Table Product-->
                    </div>
                    <!--end::Product-->

                    <!--begin::Penjualan-->
                    <div class="tab-pane fade" id="kt_user_view_penjualan_tab" role="tabpanel">
                        <!--begin::Table Penjualan-->
                        <div class="card card-flush mt-6 mt-xl-9">
                            <div class="card-header mt-5">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">Penjualan {{ $outlet->outlet_name }}</h3>
                                </div>
                                <div class="card-toolbar my-1">
                                    <!--begin::Select-->
                                    <div class="me-6 my-1">
                                        <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All time</option>
                                            <option value="thisyear">This year</option>
                                            <option value="thismonth">This month</option>
                                            <option value="lastmonth">Last month</option>
                                            <option value="last90days">Last 90 days</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Select-->
                                    <div class="me-4 my-1">
                                        <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All Orders</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Declined">Declined</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="In Transit">In Transit</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table id="penjualan_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                        <thead class="fs-7 text-gray-800 text-uppercase">
                                            <tr>
                                                <th class="min-w-100px">Tanggal</th>
                                                <th class="min-w-150px">Invoice</th>
                                                <th class="min-w-50px">Item</th>
                                                <th class="min-w-90px">Harga</th>
                                                <th class="min-w-90px">Pembeli</th>
                                                <th class="min-w-90px">Pegawai</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end::Table Penjualan-->
                    </div>
                    <!--end::Penjualan-->

                    <!--begin::Pengeluaran-->
                    <div class="tab-pane fade" id="kt_user_view_pengeluaran_tab" role="tabpanel">
                        <!--begin::Table Pengeluaran-->
                        <div class="card card-flush mt-6 mt-xl-9">
                            <div class="card-header mt-5">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold mb-1">Pengeluaran {{ $outlet->outlet_name }}</h3>
                                </div>
                                <div class="card-toolbar my-1">
                                    <!--begin::Select-->
                                    <div class="me-6 my-1">
                                        <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All time</option>
                                            <option value="thisyear">This year</option>
                                            <option value="thismonth">This month</option>
                                            <option value="lastmonth">Last month</option>
                                            <option value="last90days">Last 90 days</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Select-->
                                    <div class="me-4 my-1">
                                        <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                            <option value="All" selected="selected">All Orders</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Declined">Declined</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="In Transit">In Transit</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table id="pengeluaran_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                                        <thead class="fs-7 text-gray-800 text-uppercase">
                                            <tr>
                                                <th class="min-w-100px">Tanggal</th>
                                                <th class="min-w-150px">Kode</th>
                                                <th class="min-w-50px">Item</th>
                                                <th class="min-w-90px">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end::Table Pengeluaran-->
                    </div>
                    <!--end::Pengeluaran-->

                    <!--begin::Setting-->
                    <div class="tab-pane fade" id="kt_user_view_setting_tab" role="tabpanel">
                        <!--begin::Detail Outlet & Social Media -->
                        <div class="row g-6 g-xl-9">
                            <div class="col-lg-8">
                                <div class="card mb-6 mb-xl-9">
                                    <div class="card-header mt-6">
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bold mb-1">Outlet Detail</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="{{ route('admin.admin_outlet_edit', $outlet->slug) }}" class="btn btn-bg-light btn-active-color-warning btn-sm">Edit</a>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Kelurahan</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Kelurahan"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Kecamatan</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Kecamatan"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Kabupaten</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Kabupaten"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Provinsi</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Provinsi"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Kode Pos</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Kode_Pos"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Alamat"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Maps</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Gmaps"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-flush h-lg-100">
                                    <div class="card-header mt-6">
                                        <div class="card-title flex-column">
                                            <h3 class="fw-bold mb-1">Social Media</h3>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Website</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Website"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Whatsapp</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Whatsapp"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Facebook</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Facebook"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Instagram</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Instagram"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Tiktok</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Tiktok"></span>
                                            </div>
                                        </div>
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Youtube</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800" id="Youtube"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Detail Outlet & Social Media -->
                        @if ($outlet->is_active == 1)
                            <!--begin::Deactivate Outlet-->
                            <div class="card">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_deactivate" aria-expanded="true" aria-controls="kt_deactivate">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Deactivate Outlet</h3>
                                    </div>
                                </div>
                                <div class="collapse show">
                                    <form id="kt_deactivate_form" class="form" method="POST" action="/admin/update-status-outlet">
                                        @csrf
                                        <div class="card-body border-top p-9">
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Outlet</h4>
                                                        <div class="fs-6 text-gray-700">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus, consectetur.
                                                            <br />
                                                            <a class="fw-bold" href="#">Learn more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-solid fv-row">
                                                <input type="hidden" value="{{ $outlet->id }}" name="id" readonly/>
                                                <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate" />
                                                <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I Confirm this Outlet Deactivation</label>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button id="kt_deactivate_outlet_submit" type="submit" class="btn btn-danger fw-semibold" disabled>Deactivate Outlet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end::Deactivate Outlet-->
                        @else
                            <!--begin::Activate Outlet-->
                            <div class="card">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_activate" aria-expanded="true" aria-controls="kt_activate">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Activate Outlet</h3>
                                    </div>
                                </div>
                                <div class="collapse show">
                                    <form id="kt_activate_form" class="form" method="POST" action="/admin/update-status-outlet">
                                        @csrf
                                        <div class="card-body border-top p-9">
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Outlet</h4>
                                                        <div class="fs-6 text-gray-700">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus, consectetur.
                                                            <br />
                                                            <a class="fw-bold" href="#">Learn more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-solid fv-row">
                                                <input type="hidden" value="{{ $outlet->id }}" name="id" readonly/>
                                                <input name="activate" class="form-check-input" type="checkbox" value="" id="activate" />
                                                <label class="form-check-label fw-semibold ps-2 fs-6" for="activate">I Confirm Activation this Outlet</label>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button id="kt_activate_outlet_submit" type="submit" class="btn btn-success fw-semibold" disabled>Activate Outlet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end::Activate Outlet-->
                        @endif
                    </div>
                    <!--end::Setting-->
                </div>
                <!--begin::Content-->
                
                <!--Modal::Detail List Pegawai-->
                <div class="modal fade" id="modal_list">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableListPegawai">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-100px text-dark">Nama</th>
                                                <th class="min-w-100px text-dark">Email</th>
                                                <th class="min-w-100px text-dark">Nomor HP</th>
                                                <th class="min-w-100px text-dark">Register</th>
                                                <th class="min-w-100px text-dark">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Transaksi -->
                <div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content rounded">
                            <div class="modal-header" style="border-bottom: 2px solid #dee2e6;">
                                <h3 id="detailTransaksiModalLabel" class="modal-title" style="color: #212121; font-weight: 700; line-height: 26px; font-size: 1.42857rem;">Detail Invoice Transaksi</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-1">
                                <!-- Dynamic content will be loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-success" id="printInvoiceButton">Print</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Pengeluaran -->
                <div class="modal fade" id="detailPengeluaranModal" tabindex="-1" aria-labelledby="detailPengeluaranModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered mw-1000px">
                        <div class="modal-content rounded">
                            <div class="modal-header" style="border-bottom: 2px solid #dee2e6;">
                                <h3 id="detailPengeluaranModalLabel" class="modal-title" style="color: #212121; font-weight: 700; line-height: 26px; font-size: 1.42857rem;">Detail Pengeluaran</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-1">
                                <!-- Dynamic content will be loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <!-- Switch Tab Penjualan -->
    <script>
        document.getElementById('view-penjualan').addEventListener('click', function() {
            var penjualanTabLink = document.querySelector('a[href="#kt_user_view_penjualan_tab"]');
            var penjualanTab = new bootstrap.Tab(penjualanTabLink);
            penjualanTab.show();
        });
    </script>

    <!-- Deactive Outlet -->
    <script>
        $(document).ready(function() {
            $('#deactivate').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#kt_deactivate_outlet_submit').prop('disabled', false);
                } else {
                    $('#kt_deactivate_outlet_submit').prop('disabled', true);
                }
            });

            $('#kt_deactivate_form').on('submit', function(event) {
                if (!$('#deactivate').is(':checked')) {
                    event.preventDefault();
                    alert('Please confirm your outlet deactivation.');
                }
            });
        });

        $(document).ready(function() {
            $('#activate').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#kt_activate_outlet_submit').prop('disabled', false);
                } else {
                    $('#kt_activate_outlet_submit').prop('disabled', true);
                }
            });

            $('#kt_activate_form').on('submit', function(event) {
                if (!$('#activate').is(':checked')) {
                    event.preventDefault();
                    alert('Please confirm your outlet activation.');
                }
            });
        });
    </script>

    <!-- Detail Transaksi -->
    <script>
        function detailTransaksi(invoice_no) {
            $.ajax({
                type: 'GET',
                url: `/admin/getDetailTransaksi/${invoice_no}`,
                beforeSend: function() {
                    Swal.fire({
                        html: `Loading...`,
                        showConfirmButton: false,
                    });
                },
                success: function(data) {
                    Swal.close();
                    if (data.invoice) {
                        const invoice = data.invoice;
                        const details = data.detail;
                        let pembeliName = invoice.nama_pembeli ? invoice.nama_pembeli : 'Pembeli Belum Terdaftar';
                        let modalContent = `
                            <div class="pb-10">
                                <div>
                                    <h1 class="fw-bold text-gray-800 mb-8 fs-1">Invoice #${invoice.invoice_no}</h1>
                                    <div class="row g-5 mb-12">
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Tanggal Pembelian</div>
                                            <div class="fw-bold fs-6 text-gray-800">${formatTanggal(invoice.date_created)}</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Kasir</div>
                                            <div class="fw-bold fs-6 text-gray-800">${invoice.nama_pegawai}</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Pembeli</div>
                                            <div class="fw-bold fs-6 text-gray-800">${pembeliName}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive border-bottom mb-9">
                                <table class="table mb-3">
                                    <thead>
                                        <tr class="border-bottom fs-6 fw-bold text-muted">
                                            <th class="min-w-175px pb-2">Product</th>
                                            <th class="min-w-80px text-end pb-2">Kategori</th>
                                            <th class="min-w-70px text-end pb-2">Jumlah</th>
                                            <th class="min-w-80px text-end pb-2">Harga Satuan</th>
                                            <th class="min-w-100px text-end pb-2">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

                        details.forEach(item => {
                            modalContent += `
                                <tr class="fw-bold text-gray-700 fs-5 text-end">
                                    <td class="text-start">${item.product_name}</td>
                                    <td>${item.category_name}</td>
                                    <td>${item.qty}</td>
                                    <td>${formatRupiah(item.price)}</td>
                                    <td>${formatRupiah(item.amount)}</td>
                                </tr>`;
                        });

                        modalContent += `
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="mw-300px">
                                    <div class="d-flex flex-stack mb-3">
                                        <div class="fw-semibold pe-10 text-gray-600 fs-7">Total Pembayaran:</div>
                                        <div class="text-end fw-bold fs-6 text-gray-800">${formatRupiah(invoice.amount)}</div>
                                    </div>
                                </div>
                            </div>`;

                        $('#detailTransaksiModal').find('.modal-body').html(modalContent);
                        $('#detailTransaksiModal').modal('show');
                    } else {
                        toastr.error('Invoice data not found');
                    }
                },
                error: function(data) {
                    toastr.error('Error fetching data.');
                }
            });

            $(document).on('click', '#printInvoiceButton', function() {
                window.open(`/admin/print-invoice/${invoice_no}`, '_blank');
            });
        }

        function detailPengeluaran(invoice_no) {
            $.ajax({
                type: 'GET',
                url: `/admin/getDetailPengeluaran/${invoice_no}`,
                beforeSend: function() {
                    Swal.fire({
                        html: `Loading...`,
                        showConfirmButton: false,
                    });
                },
                success: function(data) {
                    Swal.close();
                    if (data.invoice) {
                        const invoicePengeluaran = data.invoice;
                        const detailsPengeluaran = data.detail;
                        console.log(detailsPengeluaran);
                        let modalContent = `
                            <div class="pb-10">
                                <div>
                                    <h1 class="fw-bold text-gray-800 mb-8 fs-1">#${invoicePengeluaran.invoice_no}</h1>
                                    <div class="row g-5 mb-12">
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Tanggal Transaksi</div>
                                            <div class="fw-bold fs-6 text-gray-800">${formatTanggal(invoicePengeluaran.created_at)}</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Total Item</div>
                                            <div class="fw-bold fs-6 text-gray-800">${invoicePengeluaran.qty}</div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Total Transaksi</div>
                                            <div class="fw-bold fs-6 text-gray-800">${formatRupiah(invoicePengeluaran.amount)}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        `;

                        detailsPengeluaran.forEach(item => {
                            const productOrBahan = item.product_name || item.nama_bahan;
                            modalContent += `
                                <tr>
                                    <td>${productOrBahan}</td>
                                    <td>${item.qty}</td>
                                    <td>${item.unit || '-'}</td>
                                    <td>${formatRupiah(item.price)}</td>
                                    <td>${formatRupiah(item.amount)}</td>
                                </tr>
                            `;
                        });

                        modalContent += `
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        `;

                        $('#detailPengeluaranModal').find('.modal-body').html(modalContent);
                        $('#detailPengeluaranModal').modal('show');
                    } else {
                        toastr.error('Invoice data not found');
                    }
                },
                error: function(data) {
                    toastr.error('Error fetching data.');
                }
            });
        }
    </script>

    <!-- Outlet Detail -->
    <script>
        $(document).ready(function() {
            var outletSlug = "{{ $outlet->slug }}";
            $.ajax({
                url: `/admin/getDataDetailOutlet/${outletSlug}`,
                type: 'GET',
                success: function(response) {
                    if (response.detail) {
                        const outlet = response.detail;
                        const Kelurahan = outlet.nama_kelurahan ? outlet.nama_kelurahan : '-';
                        const Kecamatan = outlet.nama_kecamatan ? outlet.nama_kecamatan : '-';
                        const Kabupaten = outlet.nama_kotakab ? outlet.nama_kotakab : '-';
                        const Provinsi = outlet.nama_propinsi ? outlet.nama_propinsi : '-';
                        const Kode_Pos = outlet.kode_pos ? outlet.kode_pos : '-';
                        const Alamat = outlet.alamat_detail ? outlet.alamat_detail : '-';
                        const Gmaps = outlet.link_google_maps ? outlet.link_google_maps : '-';

                        $('#Kelurahan').text(Kelurahan);
                        $('#Kecamatan').text(Kecamatan);
                        $('#Kabupaten').text(Kabupaten);
                        $('#Provinsi').text(Provinsi);
                        $('#Kode_Pos').text(Kode_Pos);
                        $('#Alamat').text(Alamat);
                        // Check if Gmaps link is available, if so, create button
                        if (outlet.link_google_maps) {
                            $('#Gmaps').html(`
                                <a href="${Gmaps}" target="_blank" class="btn btn-sm btn-primary">
                                    View on Google Maps
                                </a>
                            `);
                        } else {
                            $('#Gmaps').text('-');  // If no link, just show a dash
                        }
                    }

                    if (response.data) {
                        const dataOutlet = response.data;
                        const Website = dataOutlet.website ? dataOutlet.website : '-';
                        const Whatsapp = dataOutlet.whatsapp ? dataOutlet.whatsapp : '-';
                        const Facebook = dataOutlet.facebook ? dataOutlet.facebook : '-';
                        const Instagram = dataOutlet.instagram ? dataOutlet.instagram : '-';
                        const Tiktok = dataOutlet.tiktok ? dataOutlet.tiktok : '-';
                        const Youtube = dataOutlet.youtube ? dataOutlet.youtube : '-';

                        $('#Whatsapp').text(Whatsapp);
                        // Website
                        if (dataOutlet.website) {
                            $('#Website').html(`
                                <a href="${Website}" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            `);
                        } else {
                            $('#Website').text('-');
                        }
                        // Facebook
                        if (dataOutlet.facebook) {
                            $('#Facebook').html(`
                                <a href="${Facebook}" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            `);
                        } else {
                            $('#Facebook').text('-');
                        }
                        // Instagram
                        if (dataOutlet.instagram) {
                            $('#Instagram').html(`
                                <a href="${Instagram}" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            `);
                        } else {
                            $('#Instagram').text('-');
                        }
                        // Tiktok
                        if (dataOutlet.tiktok) {
                            $('#Tiktok').html(`
                                <a href="${Tiktok}" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            `);
                        } else {
                            $('#Tiktok').text('-');
                        }
                        // Youtube
                        if (dataOutlet.youtube) {
                            $('#Youtube').html(`
                                <a href="${Youtube}" target="_blank" class="btn btn-sm btn-primary">
                                    View
                                </a>
                            `);
                        } else {
                            $('#Youtube').text('-');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });
    </script>

    <!-- Table Product -->
    <script>
        // Datatable Product Outlet
        $(document).ready(function() {
            $('#product_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataProductOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: "Product",
                        render: function(data, type, row) {

                            var imagePath;
                            // Check for null or empty image path
                            if (!row.image || row.image.trim() === '') {
                                imagePath = '<span class="symbol-label bg-light-danger text-danger fw-semibold">P</span>';
                            } else {
                                imagePath = '{{ asset("' + row.image + '") }}';
                            }

                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-5">
                                            <div class="symbol-label">
                                                ${imagePath}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.product_name}</span>
                                            <span class="text-gray-500" >${row.slug}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    { data: 'category_name' },
                    {
                        data: 'price',
                        render: function (data, type, row) {
                            // Convert price to number
                            const price = parseFloat(data) || 0;

                            // Format price as Rupiah (without ".00")
                            const formattedPrice = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0, // Set minimum fraction digits to 0
                                maximumFractionDigits: 0 // Set maximum fraction digits to 0
                            }).format(price);

                            return formattedPrice;
                        }
                    },
                    { data: 'stock' },
                ],
            });
        });

        // Utilitas Format Mata Uang
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp. ' + ribuan;
        }

        // Utilitas Format Tanggal
        function formatTanggal(tanggal) {
            var date = new Date(tanggal);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }
    </script>

    <!-- Table Penjualan -->
    <script>
        // Datatable Penjualan Outlet
        $(document).ready(function() {
            $('#penjualan_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataPenjualanOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'date_created',
                        render: function (data, type, row) {
                            if (!data) return '-'; // Handle case where date is missing
                            
                            const date = new Date(data);
                            
                            const formattedDateCreated = new Intl.DateTimeFormat('en-GB', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            }).format(date);

                            return formattedDateCreated.replace(',', ''); // Remove comma
                        }
                    },
                    {
                        data: 'invoice_no',
                        render: function (data, type, row) {
                            return `<a href="javascript:void(0);" onclick="detailTransaksi('${data}')">${data}</a>`;
                        }
                    },
                    { data: 'qty' },
                    {
                        data: 'amount',
                        render: function (data, type, row) {
                            // Convert price to number
                            const price = parseFloat(data) || 0;

                            // Format price as Rupiah (without ".00")
                            const formattedAmount = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0, // Set minimum fraction digits to 0
                                maximumFractionDigits: 0 // Set maximum fraction digits to 0
                            }).format(price);

                            return formattedAmount;
                        }
                    },
                    {
                        data: 'pembeli',
                        render: function (data, type, row) {
                            return data ? data : 'Tidak Terdaftar';
                        }
                    },
                    { data: 'pegawai' },
                ],
            });
        });
    </script>

    <!-- Table Pengeluaran -->
    <script>
        // Datatable Pengeluaran Outlet
        $(document).ready(function() {
            $('#pengeluaran_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataPengeluaranOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            if (!data) return '-'; // Handle case where date is missing
                            
                            const date = new Date(data);
                            
                            const formattedDateCreated = new Intl.DateTimeFormat('en-GB', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            }).format(date);

                            return formattedDateCreated.replace(',', ''); // Remove comma
                        }
                    },
                    {
                        data: 'invoice_no',
                        render: function (data, type, row) {
                            return `<a href="javascript:void(0);" onclick="detailPengeluaran('${data}')">${data}</a>`;
                        }
                    },
                    { data: 'qty' },
                    {
                        data: 'amount',
                        render: function (data, type, row) {
                            // Convert price to number
                            const price = parseFloat(data) || 0;

                            // Format price as Rupiah (without ".00")
                            const formattedAmount = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0, // Set minimum fraction digits to 0
                                maximumFractionDigits: 0 // Set maximum fraction digits to 0
                            }).format(price);

                            return formattedAmount;
                        }
                    },
                ],
            });
        });
    </script>

    <!-- Data Pegawai -->
    <script>
        // Datatable List Pegawai
        $(document).ready(function() {
           $('#tableListPegawai').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/getDataPegawaiOutlet/{{ $outlet->slug }}",
                    dataType: "JSON"
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'no_hp' },
                    {
                        data: 'created_at',
                        render: function(data, type, row) {
                            // Ubah format tanggal dari YYYY-MM-DDTHH:mm:ss.sssZ menjadi dd-MM-YYYY
                            var date = new Date(data);
                            var day = date.getDate().toString().padStart(2, '0');
                            var month = (date.getMonth() + 1).toString().padStart(2, '0');
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year;
                        }
                    },
                    {
                        data: "Status",
                        render: function(data, type, row) {
                            if (row.is_active == 1) {
                                return '<span class="badge badge-light-success fw-bold px-4 py-3">Active</span>';
                            } else {
                                return '<span class="badge badge-light-danger fw-bold px-4 py-3">Non-Active</span>';
                            }
                        }
                    },
                ],
           });
        });

        function listPegawai() {
            $('#modal_list').modal('show');
            $('#modal-title').text('List Pegawai');
        }
    </script>

@endsection