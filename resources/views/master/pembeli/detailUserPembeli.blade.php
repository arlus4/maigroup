@extends('layout-master/app')
@section('content')

<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">View Detail Pembeli</h1>
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
                    <li class="breadcrumb-item text-muted">Manajemen Pembeli</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Daftar Pembeli</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Detail Pembeli</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
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

			<!--begin::Navbar-->
			<div class="card mb-5 mb-xl-10">
				<div class="card-body pt-9 pb-0">
					<!--begin::Details-->
					<div class="d-flex flex-wrap flex-sm-nowrap mb-3">
						<!--begin: Pic-->
						<div class="me-7 mb-4">
							<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                @if ($detail != null)
                                    @if ($detail->avatar != NULL)
                                        <img src="{{ asset($detail->path_avatar) }}" alt="image" />
                                        @if ($pelanggan->is_active == 1)
                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/avatar.png') }}" alt="image" />
                                        @if ($pelanggan->is_active == 1)
                                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                        @endif
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/avatar.png') }}" alt="image" />
                                    @if ($pelanggan->is_active == 1)
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
										<a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $pelanggan->name }}</a>
                                        @if ($pelanggan->is_active == 1)
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
                                            {{ $pelanggan->username }}
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
                                            {{ $pelanggan->email }}
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
										<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
											<div class="d-flex align-items-center">
												<div class="fs-2 fw-bold">{{ \Carbon\Carbon::parse($pelanggan->created_at)->format('d F Y') }}</div>
											</div>
											<div class="fw-semibold fs-6 text-gray-400">Register</div>
										</div>
										<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
											<div class="d-flex align-items-center">
												<div class="fs-2 fw-bold">@rupiah($penjualan)</div>
											</div>
											<div class="fw-semibold fs-6 text-gray-400">Total Pembelian</div>
										</div>
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
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_trans_tab">Transaction</a>
						</li>
						<!--end::Nav item-->
						<!--begin::Nav item-->
						<li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_log_tab">Logs</a>
						</li>
						<!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_setting_tab">Settings</a>
                        </li>
                        <!--end::Nav item-->
					</ul>
					<!--begin::Navs-->
				</div>
			</div>
			<!--end::Navbar-->

			<!--begin::details View-->
            <div class="tab-content">
                <!--begin::Overview-->
                <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pelanggan->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Username</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{ $pelanggan->username }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                <div class="col-lg-8">
                                    <a href="javascript:;" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $pelanggan->email }}</a>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Contact Phone
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Lorem ipsum dolor sit."></i>
                                </label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{ $pelanggan->no_hp }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Registered</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold text-gray-800 fs-6">{{ $pelanggan->created_at }}</span>
                                </div>
                            </div>
                            <div class="row mb-10">
                                <span class="fw-bold fs-4 text-gray-800 me-2">Informasi Alamat Pelanggan</span>
                            </div>
                            @if ($detail != null)
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Kelurahan</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="nama_kelurahan"></span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Kecamatan</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="nama_kecamatan"></span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Kabupaten / Kota</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="nama_kotakab"></span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Provinsi</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="nama_propinsi"></span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Alamat Detail</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="alamat_detail"></span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Kode Pos</label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold text-gray-800 fs-6" id="kode_pos"></span>
                                    </div>
                                </div>
                            @else
                                <h3 class="fw-bold m-0">Pelanggan Belum Memiliki Alamat Detail</h3>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end::Overview-->

                <!--begin::Transaction-->
                <div class="tab-pane fade" id="kt_user_view_trans_tab" role="tabpanel">
                    <div class="card mb-5 mb-lg-10">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Transaction</h3>
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table id="table_transaction" class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                    <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px text-dark">Tanggal</th>
                                            <th class="min-w-100px text-dark">Invoice</th>
                                            <th class="min-w-100px text-dark">Outlet</th>
                                            <th class="min-w-50px text-dark">Item</th>
                                            <th class="min-w-100px text-dark">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-6 fw-semibold text-gray-600">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Transaction-->
    
                <!--begin::Setting-->
                <div class="tab-pane fade" id="kt_user_view_setting_tab" role="tabpanel">
                    <!--begin::Sign-in Method-->
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Sign-in Method</h3>
                            </div>
                        </div>
                        <div id="kt_account_settings_signin_method" class="collapse show">
                            <div class="card-body border-top p-9">
                                <!--begin::Phone Number-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <div id="kt_NoHP">
                                        <div class="fs-6 fw-bold mb-1">Phone Number</div>
                                        <div class="fw-semibold text-gray-600">{{ $pelanggan->no_hp }}</div>
                                    </div>
                                    <div id="kt_NoHP_edit" class="flex-row-fluid d-none">
                                        <form id="kt_change_NoHP" action="/admin/update-no_hp-user-pembeli" class="form" method="POST">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentNoHP" class="form-label fs-6 fw-bold mb-3">Current Phone Number</label>
                                                        <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                                        <input class="form-control form-control-lg form-control-solid" value="{{ $pelanggan->no_hp }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="NoHP" class="form-label fs-6 fw-bold mb-3">New Phone Number</label>
                                                        <input type="NoHP" class="form-control form-control-lg" name="no_hp" id="NoHP" placeholder="Enter Phone Number" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-success me-2 px-6" id="updatePhone Number">Update Phone Number</button>
                                                <button type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6" id="cancel_button_NoHP">Cancel</button>
                                            </div>
                                            <div id="NoHPUsedMsg" class="text-danger d-none">Phone Number Already in use.</div>
                                            <div id="textAlertNoHP" class="text-success d-none">Phone Number Available.</div>
                                        </form>
                                    </div>
                                    <div id="kt_NoHP_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-warning">Change Phone Number</button>
                                    </div>
                                </div>
                                <!--end::Phone Number-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-6"></div>
                                <!--end::Separator-->

                                <!--begin::Username-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <div id="kt_username">
                                        <div class="fs-6 fw-bold mb-1">Username</div>
                                        <div class="fw-semibold text-gray-600">{{ $pelanggan->username }}</div>
                                    </div>
                                    <div id="kt_username_edit" class="flex-row-fluid d-none">
                                        <form id="kt_change_username" action="/admin/update-username-user-pembeli" class="form" method="POST">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentusername" class="form-label fs-6 fw-bold mb-3">Current Username</label>
                                                        <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                                        <input class="form-control form-control-lg form-control-solid" value="{{ $pelanggan->username }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="username" class="form-label fs-6 fw-bold mb-3">New Username</label>
                                                        <input type="username" class="form-control form-control-lg" name="username" id="username" placeholder="Enter Username" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-success me-2 px-6" id="updateUsername">Update Username</button>
                                                <button type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6" id="cancel_button_username">Cancel</button>
                                            </div>
                                            <div id="usernameUsedMsg" class="text-danger d-none">Username Already in use.</div>
                                            <div id="textAlertUsername" class="text-success d-none">Username Available.</div>
                                        </form>
                                    </div>
                                    <div id="kt_username_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-warning">Change Username</button>
                                    </div>
                                </div>
                                <!--end::Username-->

                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-6"></div>
                                <!--end::Separator-->

                                <!--begin::Email Address-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <div id="kt_email">
                                        <div class="fs-6 fw-bold mb-1">Email Address</div>
                                        <div class="fw-semibold text-gray-600">{{ $pelanggan->email }}</div>
                                    </div>
                                    <div id="kt_email_edit" class="flex-row-fluid d-none">
                                        <form id="kt_change_email" action="/admin/update-email-user-pembeli" class="form" method="POST">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentemailaddress" class="form-label fs-6 fw-bold mb-3">Current Email Address</label>
                                                        <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                                        <input class="form-control form-control-lg form-control-solid" value="{{ $pelanggan->email }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">New Email Address</label>
                                                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Email Address" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-success me-2 px-6" id="updateEmail">Update Email</button>
                                                <button type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6" id="cancel_button_email">Cancel</button>
                                            </div>
                                            <div id="emailUsedMsg" class="text-danger d-none">Email Already in use.</div>
                                            <div id="textAlertEmail" class="text-success d-none">Email Available.</div>
                                        </form>
                                    </div>
                                    <div id="kt_email_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-warning">Change Email</button>
                                    </div>
                                </div>
                                <!--end::Email Address-->
    
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-6"></div>
                                <!--end::Separator-->
    
                                <!--begin::Password-->
                                <div class="d-flex flex-wrap align-items-center mb-10">
                                    <div id="kt_password">
                                        <div class="fs-6 fw-bold mb-1">Password</div>
                                        <div class="fw-semibold text-gray-600">************</div>
                                    </div>
                                    <div id="kt_password_edit" class="flex-row-fluid d-none">
                                        <form id="kt_signin_change_password" class="form" method="POST" action="/admin/update-password-user-pembeli">
                                            @csrf
                                            <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                            <div class="row mb-1">
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0" data-kt-password-meter="true">
                                                        <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                                        <div class="position-relative mb-3">
                                                            <input id="newpassword" class="form-control form-control-lg" type="password" placeholder="" name="newpassword" autocomplete="off" required/>
                                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                                <i class="bi bi-eye-slash fs-2"></i>
                                                                <i class="bi bi-eye fs-2 d-none"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="fv-row mb-0">
                                                        <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                                        <input type="password" class="form-control form-control-lg" name="confirmpassword" id="confirmpassword" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-primary me-2 px-6" id="updatePassword">Update Password</button>
                                                <button type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6" id="cancel_button_password">Cancel</button>
                                            </div>
                                            <div id="passwordError" class="text-danger d-none">Passwords do not match or do not meet criteria.</div>
                                        </form>
                                    </div>
                                    <div id="kt_password_button" class="ms-auto">
                                        <button class="btn btn-light btn-active-light-danger">Reset Password</button>
                                    </div>
                                </div>
                                <!--end::Password-->
                            </div>
                        </div>
                    </div>
                    <!--end::Sign-in Method-->
    
                    @if ($pelanggan->is_active == 1)
                        <!--begin::Deactivate Account-->
                        <div class="card">
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_deactivate" aria-expanded="true" aria-controls="kt_deactivate">
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Deactivate Account</h3>
                                </div>
                            </div>
                            <div class="collapse show">
                                <form id="kt_deactivate_form" class="form" method="POST" action="/admin/update-status-user-pembeli">
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
                                                    <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                                    <div class="fs-6 text-gray-700">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus, consectetur.
                                                        <br />
                                                        <a class="fw-bold" href="#">Learn more</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-solid fv-row">
                                            <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                            <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate" />
                                            <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I Confirm this Account Deactivation</label>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button id="kt_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold" disabled>Deactivate Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end::Deactivate Account-->
                    @else
                        <!--begin::Activate Account-->
                        <div class="card">
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_activate" aria-expanded="true" aria-controls="kt_activate">
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Activate Account</h3>
                                </div>
                            </div>
                            <div class="collapse show">
                                <form id="kt_activate_form" class="form" method="POST" action="/admin/update-status-user-pembeli">
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
                                                    <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                                    <div class="fs-6 text-gray-700">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus, consectetur.
                                                        <br />
                                                        <a class="fw-bold" href="#">Learn more</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-solid fv-row">
                                            <input type="hidden" value="{{ $pelanggan->id }}" name="id" readonly/>
                                            <input name="activate" class="form-check-input" type="checkbox" value="" id="activate" />
                                            <label class="form-check-label fw-semibold ps-2 fs-6" for="activate">I Confirm Activation this Account</label>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <button id="kt_activate_account_submit" type="submit" class="btn btn-success fw-semibold" disabled>Activate Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end::Activate Account-->
                    @endif
                </div>
                <!--end::Setting-->
            </div>
            <!--end::details View-->

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
        </div>
		<!--end::Content container-->
    </div>
	<!--end::Content-->
</div>
<!--end::Content wrapper-->

@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<!-- Datatable Transaksi -->
<script>
    $(document).ready(function() {
        $('#table_transaction').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "/admin/getDataTransactionPembeli/{{ $pelanggan->id }}",
                dataType: "JSON",
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
                { data: 'outlet_name' },
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

<!-- Update Phone Number -->
<script>
    $(document).ready(function() {
        // Show the phone number edit form when the button is clicked
        $('#kt_NoHP_button').on('click', function() {
            $('#kt_NoHP').hide();
            $('#kt_NoHP_edit').removeClass('d-none').show();
            $('#kt_NoHP_button').hide();
        });

        // Hide the phone number edit form and show the phone number details when the cancel button is clicked
        $('#cancel_button_NoHP').on('click', function() {
            $('#kt_NoHP_edit').hide();
            $('#kt_NoHP').show();
            $('#kt_NoHP_button').show();
        });

        // Debounce function to limit the rate at which a function can fire
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        var handleSearchNoHP = debounce(function() {
            var NoHP = $('#NoHP').val();
            var NoHPUsedMsg = $('#NoHPUsedMsg');
            var textAlertNoHP = $('#textAlertNoHP');
            var updateNoHP = $('#updateNoHP');

            if (NoHP.length >= 3) {
                $.ajax({
                    url: "/admin/validateNoHPPembeli",
                    type: "GET",
                    data: { 'no_hp': NoHP },
                    success: function(data) {
                        let used = data && data.used;

                        if (used) {
                            NoHPUsedMsg.removeClass('d-none').show();
                            textAlertNoHP.addClass('d-none').hide();
                        } else {
                            NoHPUsedMsg.addClass('d-none').hide();
                            textAlertNoHP.removeClass('d-none').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error saat pencarian:", error);
                    }
                });
            } else {
                NoHPUsedMsg.addClass('d-none').hide();
                textAlertNoHP.removeClass('d-none').show();
            }
        }, 300);

        $('#NoHP').on('input', handleSearchNoHP);
    });
</script>

<!-- Update Username -->
<script>
    $(document).ready(function() {
        // Show the username edit form when the button is clicked
        $('#kt_username_button').on('click', function() {
            $('#kt_username').hide();
            $('#kt_username_edit').removeClass('d-none').show();
            $('#kt_username_button').hide();
        });

        // Hide the username edit form and show the username details when the cancel button is clicked
        $('#cancel_button_username').on('click', function() {
            $('#kt_username_edit').hide();
            $('#kt_username').show();
            $('#kt_username_button').show();
        });

        // Debounce function to limit the rate at which a function can fire
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        var handleSearchUsername = debounce(function() {
            var username = $('#username').val();
            var usernameUsedMsg = $('#usernameUsedMsg');
            var textAlertUsername = $('#textAlertUsername');
            var updateUsername = $('#updateUsername');

            if (username.length >= 3) {
                $.ajax({
                    url: "/admin/validateUsernamePembeli",
                    type: "GET",
                    data: { 'username': username },
                    success: function(data) {
                        let used = data && data.used;

                        if (used) {
                            usernameUsedMsg.removeClass('d-none').show();
                            textAlertUsername.addClass('d-none').hide();
                        } else {
                            usernameUsedMsg.addClass('d-none').hide();
                            textAlertUsername.removeClass('d-none').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error saat pencarian:", error);
                    }
                });
            } else {
                usernameUsedMsg.addClass('d-none').hide();
                textAlertUsername.removeClass('d-none').show();
            }
        }, 300);

        $('#username').on('input', handleSearchUsername);
    });
</script>

<!-- Update Email -->
<script>
    $(document).ready(function() {
        // Show the email edit form when the button is clicked
        $('#kt_email_button').on('click', function() {
            $('#kt_email').hide();
            $('#kt_email_edit').removeClass('d-none').show();
            $('#kt_email_button').hide();
        });

        // Hide the email edit form and show the email details when the cancel button is clicked
        $('#cancel_button_email').on('click', function() {
            $('#kt_email_edit').hide();
            $('#kt_email').show();
            $('#kt_email_button').show();
        });

        // Debounce function to limit the rate at which a function can fire
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        var handleSearchEmail = debounce(function() {
            var email = $('#email').val();
            var emailUsedMsg = $('#emailUsedMsg');
            var textAlertEmail = $('#textAlertEmail');
            var updateEmail = $('#updateEmail');

            if (email.length >= 3) {
                $.ajax({
                    url: "/admin/validateEmailPembeli",
                    type: "GET",
                    data: { 'email': email },
                    success: function(data) {
                        let used = data && data.used;

                        if (used) {
                            emailUsedMsg.removeClass('d-none').show();
                            textAlertEmail.addClass('d-none').hide();
                        } else {
                            emailUsedMsg.addClass('d-none').hide();
                            textAlertEmail.removeClass('d-none').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error saat pencarian:", error);
                    }
                });
            } else {
                emailUsedMsg.addClass('d-none').hide();
                textAlertEmail.removeClass('d-none').show();
            }
        }, 300);

        $('#email').on('input', handleSearchEmail);
    });
</script>

<!-- Update Password -->
<script>
    $(document).ready(function() {
        // Show the password edit form when the button is clicked
        $('#kt_password_button').on('click', function() {
            $('#kt_password').hide();
            $('#kt_password_edit').removeClass('d-none').show();
            $('#kt_password_button').hide();
        });

        // Hide the password edit form and show the password details when the cancel button is clicked
        $('#cancel_button_password').on('click', function() {
            $('#kt_password_edit').hide();
            $('#kt_password').show();
            $('#kt_password_button').show();
        });

        // Validate password before submitting
        $('#kt_signin_change_password').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var newPassword = $('#newpassword').val();
            var confirmPassword = $('#confirmpassword').val();
            var passwordError = $('#passwordError');

            // Clear any previous error messages
            passwordError.addClass('d-none').hide();

            // Regex for password validation (same as backend)
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            // (?=.*[a-z]) = At least one lowercase letter
            // (?=.*[A-Z]) = At least one uppercase letter
            // (?=.*\d) = At least one digit
            // (?=.*[\W_]) = At least one special character
            // {8,} = Minimum length of 8 characters

            // Validate the password
            if (newPassword.length < 8) {
                passwordError.text('Password must be at least 8 characters long.').removeClass('d-none').show();
                return;
            }

            if (!passwordRegex.test(newPassword)) {
                passwordError.text('Password must contain at least one special character.').removeClass('d-none').show();
                return;
            }

            if (newPassword !== confirmPassword) {
                passwordError.text('Passwords do not match.').removeClass('d-none').show();
                return;
            }

            // If all validations pass, submit the form
            this.submit();
        });
    });
</script>

<!-- Deactive Account -->
<script>
    $(document).ready(function() {
        $('#deactivate').on('change', function() {
            if ($(this).is(':checked')) {
                $('#kt_deactivate_account_submit').prop('disabled', false);
            } else {
                $('#kt_deactivate_account_submit').prop('disabled', true);
            }
        });

        $('#kt_deactivate_form').on('submit', function(event) {
            if (!$('#deactivate').is(':checked')) {
                event.preventDefault();
                alert('Please confirm your account deactivation.');
            }
        });
    });
</script>

<!-- Activete Account -->
<script>
    $(document).ready(function() {
        $('#activate').on('change', function() {
            if ($(this).is(':checked')) {
                $('#kt_activate_account_submit').prop('disabled', false);
            } else {
                $('#kt_activate_account_submit').prop('disabled', true);
            }
        });

        $('#kt_activate_form').on('submit', function(event) {
            if (!$('#activate').is(':checked')) {
                event.preventDefault();
                alert('Please confirm your account activation.');
            }
        });
    });
</script>
@endsection