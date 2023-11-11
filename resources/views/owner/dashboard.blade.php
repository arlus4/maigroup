@extends('owner/layout-owner/app')

@section('content')
    <div class="col-xxl-4 mb-5 mb-xl-10">
        <div class="card card-flush h-xl-100">
            <div class="card-header py-7">
                <div class="m-0">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">2,579</span>
                        <span class="badge badge-light-success fs-base">
                            <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                </svg>
                            </span>
                            2.2%
                        </span>
                    </div>
                    <span class="fs-6 fw-semibold text-gray-400">Domain External Links</span>
                </div>
                <div class="card-toolbar">
                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                            </svg>
                        </span>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                        </div>
                        <div class="separator mb-3 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">New Ticket</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">New Customer</a>
                        </div>
                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                            <a href="#" class="menu-link px-3">
                                <span class="menu-title">New Group</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Member Group</a>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">New Contact</a>
                        </div>
                        <div class="separator mt-3 opacity-75"></div>
                        <div class="menu-item px-3">
                            <div class="menu-content px-3 py-3">
                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                <div id="kt_charts_widget_28" class="h-300px w-100 min-h-auto"></div>
            </div>
        </div>
    </div>
@endsection