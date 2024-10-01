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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Brand {{ $brand->brand_name }}</h1>
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
                        <li class="breadcrumb-item text-muted">Management Brands</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Daftar Brands Active</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Detail Brand {{ $brand->brand_name }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/admin/owner/detail-user-owner/{{ $user->username }}" class="btn fw-bold btn-primary">Kembali</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Profil-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        @if ($brand->brand_image == NULL)
                                            <img src="{{ asset('assets/master/media/svg/files/blank-image.svg') }}" />
                                        @else
                                            <img src="{{ $brand->brand_image_path }}" alt="{{ $brand->brand_image }}" />
                                        @endif
                                    </div>
                                    <a href="javascript:;" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $brand->brand_name }}</a>
                                    <div class="mb-9">
                                        <div class="badge badge-lg badge-light-primary d-inline">{{ $categories->brand_category_name }}</div>
                                    </div>
                                    <div class="fw-bold mb-3">{{ $brand->brand_code }}
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Lorem ipsum dolor sit amet consectetur, adipisicing elit."></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_detail_users" role="button" aria-expanded="false" aria-controls="kt_user_view_detail_users">Details 
                                        <span class="ms-2 rotate-180">
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit Brands">
                                        <a href="/admin/brands/edit-user-brand/{{ $brand->slug }}" class="btn btn-light-warning">Edit</a>
                                    </span>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details User-->
                                <div id="kt_user_view_detail_users" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <div class="fw-bold mt-5">Owner</div>
                                        <div class="text-gray-600">{{ $user->name }}</div>
                                        <div class="fw-bold mt-5">Nomor HP</div>
                                        <div class="text-gray-600">{{ $brand->no_hp }}</div>
                                        <div class="fw-bold mt-5">Deskripsi</div>
                                        <div class="text-gray-600">{{ $brand->brand_description }}</div>
                                    </div>
                                </div>
                                <!--end::Details User-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Profil-->

                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Overview-->
                            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                                <div class="row row-cols-1 row-cols-md-2 mb-6 mb-xl-9">
                                    <!-- begin::Total Pendapatan -->
                                    <div class="col">
                                        <div class="card pt-4 h-md-100 mb-6 mb-md-0">
                                            <div class="card-header border-0">
                                                <div class="card-title">
                                                    <h2 class="fw-bold">Total Pendapatan</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="fw-bold fs-2">
                                                    <div class="d-flex">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                                        <span class="svg-icon svg-icon-info svg-icon-2x">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="ms-2">@rupiah($pendapatan)</div>
                                                    </div>
                                                    <div class="fs-7 fw-normal text-muted">Lorem ipsum dolor sit amet.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end::Total Pendapatan -->
                                    <div class="col">
                                        <!--begin::Reward Tier-->
                                        <a href="#" class="card bg-info hoverable h-md-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14 18V16H10V18L9 20H15L14 18Z" fill="currentColor" />
                                                        <path opacity="0.3" d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="text-white fw-bold fs-2 mt-5">Premium Member</div>
                                                <div class="fw-semibold text-white">Tier Milestone Reached</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Reward Tier-->
                                    </div>
                                </div>
                                <!--begin::Outlet-->
                                @if (count($outlets) != NULL)
                                    <div class="card card-flush mb-6 mb-xl-9">
                                        <div class="card-header mt-6">
                                            <div class="card-title flex-column">
                                                <h2 class="mb-1">Outlets Brands</h2>
                                                <div class="fs-6 fw-semibold text-muted">Total {{ count($outlets) }} Outlets</div>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            @foreach ($outlets as $outlet)
                                                <div class="d-flex align-items-center position-relative mb-7">
                                                    <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                                    <div class="fw-semibold ms-5">
                                                        <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">{{ $outlet->outlet_name }}</a>
                                                        <div class="fs-7 text-muted">{{ $outlet->outlet_code }}</div>
                                                    </div>
                                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                    <div class="dropdown">
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                                <a href="/admin/detail-outlet/{{ $outlet->slug }}" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                                    <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                                    Detail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="/admin/edit_New_Outlets/{{ $outlet->slug }}" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                @endif
                                <!--end::Outlet-->
                            </div>
                            <!--end:::Overview-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
    </div>
    <!--end::Content wrapper-->
@endsection