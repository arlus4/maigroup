<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <div id="kt_app_header" class="app-header">
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a href="{{ route('owner.dashboard-owner') }}" class="d-lg-none">
                        <img alt="Logo" src="{{ asset('assets/images/logo_ts.png') }}" class="h-30px" />
                    </a>
                </div>
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                    <!-- <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}" style="">
                        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here menu-lg-down-accordion menu-here-bg me-0 me-lg-2">
                                <span class="menu-link">
                                    <span class="menu-title">Dasbor</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                            </div>
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                <span class="menu-link">
                                    <span class="menu-title">Menu Order</span>
                                    <span class="menu-arrow d-lg-none"></span>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <div class="app-navbar flex-shrink-0" style="margin-left: auto">
                        <div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                            <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                @if ($global_user->path_avatar != null)
                                    <img src="{{ asset($global_user->path_avatar) }}" alt="user" />
                                @else
                                    <img alt="Logo" src="{{ asset('assets/user-png-icon.png') }}" />
                                @endif
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5">
                                            @if ($global_user->path_avatar != null)
                                                <img src="{{ asset($global_user->path_avatar) }}" alt="user" />
                                            @else
                                                <img alt="Logo" src="{{ asset('assets/user-png-icon.png') }}" />
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5">{{ $global_user->name }}
                                        </div>
                                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5 my-1">
                                    <a href="{{ route('owner.owner_pengaturan_akun', ['username' => Auth::user()->username]) }}" class="menu-link px-5">Pengaturan Akun</a>
                                </div>

                                <div class="menu-item px-5">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="menu-link px-5 border-0 w-100" onMouseOver="this.style.backgroundColor='#F4F6FA'" onMouseOut="this.style.backgroundColor='#fff'" style="background-color: #fff;">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
                            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="currentColor" />
                                        <path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
                    <a href="{{ route('owner.dashboard-owner') }}">
                        <img alt="Logo" src="{{ asset('assets/images/logo_maitea.png') }}" class="app-sidebar-logo-default" style="height: 55px;" />
                        <img alt="Logo" src="{{ asset('assets/images/logo_ts.png') }}" class="app-sidebar-logo-minimize" style="height: 38px;"/>
                    </a>
                    <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                        <span class="svg-icon svg-icon-2 rotate-180">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::routeIs('owner.dashboard-owner') ? 'active' : '' }}" href="{{ route('owner.dashboard-owner') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Beranda</span>
                                </a>
                            </div>
                            <hr style="height: 8px;background-color: #fff;border-radius: 5px;">
                            <div class="menu-item">
                                <a class="menu-link {{ Request::routeIs('owner.owner_bonus') ? 'active' : '' }} || {{ Request::routeIs('owner.owner_bonus_gift') ? 'active' : '' }}" href="{{ route('owner.owner_bonus') }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M11.8 5.2L17.7 8.6V15.4L11.8 18.8L5.90001 15.4V8.6L11.8 5.2ZM11.8 2C11.5 2 11.2 2.1 11 2.2L3.8 6.4C3.3 6.7 3 7.3 3 7.9V16.2C3 16.8 3.3 17.4 3.8 17.7L11 21.9C11.3 22 11.5 22.1 11.8 22.1C12.1 22.1 12.4 22 12.6 21.9L19.8 17.7C20.3 17.4 20.6 16.8 20.6 16.2V7.9C20.6 7.3 20.3 6.7 19.8 6.4L12.6 2.2C12.4 2.1 12.1 2 11.8 2Z" fill="currentColor"></path>
                                                <path d="M11.8 8.69995L8.90001 10.3V13.7L11.8 15.3L14.7 13.7V10.3L11.8 8.69995Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Bonus</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Request::routeIs('owner.owner_menu_order') ? 'active' : '' }}" href="/owner/listOutlet">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 7H3C2.4 7 2 6.6 2 6V3C2 2.4 2.4 2 3 2H20C20.6 2 21 2.4 21 3V6C21 6.6 20.6 7 20 7ZM7 9H3C2.4 9 2 9.4 2 10V20C2 20.6 2.4 21 3 21H7C7.6 21 8 20.6 8 20V10C8 9.4 7.6 9 7 9Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M20 21H11C10.4 21 10 20.6 10 20V10C10 9.4 10.4 9 11 9H20C20.6 9 21 9.4 21 10V20C21 20.6 20.6 21 20 21Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Manajemen Outlet</span>
                                </a>
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                                <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                                <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Restock Order</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion {{ Request::routeIs('owner.owner_restock') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_status_restock') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_konf_pembayaran_order') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_detail_pembelian') ? 'show' : '' }}">
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::routeIs('owner.owner_restock') ? 'active' : '' }}" href="{{ route('owner.owner_restock') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Tambah Restock</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::routeIs('owner.owner_status_restock') ? 'active' : '' }} || {{ Request::routeIs('owner.owner_detail_pembelian') ? 'active' : '' }}" href="{{ route('owner.owner_status_restock') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Daftar Pembelian</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::routeIs('owner.owner_konf_pembayaran_order') ? 'active' : '' }}" href="{{ route('owner.owner_konf_pembayaran_order') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Konfirmasi Pembayaran</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Report</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion {{ Request::routeIs('owner.owner_report_invoice_pembelian') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_report_invoice_penjualan') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_detail_invoice_pembelian') ? 'show' : '' }} || {{ Request::routeIs('owner.owner_detail_invoice_penjualan') ? 'show' : '' }}">
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::routeIs('owner.owner_report_invoice_penjualan') ? 'active' : '' }} || {{ Request::routeIs('owner.owner_detail_invoice_penjualan') ? 'active' : '' }}" href="{{ route('owner.owner_report_invoice_penjualan') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Invoice Penjualan</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link {{ Request::routeIs('owner.owner_report_invoice_pembelian') ? 'active' : '' }} || {{ Request::routeIs('owner.owner_detail_invoice_pembelian') ? 'active' : '' }}" href="{{ route('owner.owner_report_invoice_pembelian') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Invoice Pembelian</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                @yield('content')

                <div id="kt_app_footer" class="app-footer">
                    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2023 &copy; </span>
                            <a class="text-gray-800 text-hover-primary">MAI GROUP</a>
                        </div>
                    </div>
                </div>
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