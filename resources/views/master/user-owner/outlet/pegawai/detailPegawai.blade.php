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
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Account Overview</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="#" class="text-muted text-hover-primary">Home</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Account</li>
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
                                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                    @else
                                        <img src="{{ asset('assets/images/avatar.png') }}" alt="image" />
                                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                    @endif
                                @else
                                    <img src="{{ asset('assets/images/avatar.png') }}" alt="image" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
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
										<a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $pegawai->name }}</a>
                                        @if ($pegawai->is_active == 1)
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
                                            {{ $pegawai->username }}
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
                                            {{ $pegawai->email }}
                                        </a>
									</div>
									<!--end::Info-->
								</div>
								<!--end::User-->
							</div>
							<!--end::Title-->
							<!--begin::Stats-->
							<div class="d-flex flex-wrap flex-stack">
								<!--begin::Wrapper-->
								<div class="d-flex flex-column flex-grow-1 pe-8">
									<!--begin::Stats-->
									<div class="d-flex flex-wrap">
										<!--begin::Stat-->
										<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
											<!--begin::Number-->
											<div class="d-flex align-items-center">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
												<span class="svg-icon svg-icon-3 svg-icon-success me-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
														<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>
											</div>
											<!--end::Number-->
											<!--begin::Label-->
											<div class="fw-semibold fs-6 text-gray-400">Earnings</div>
											<!--end::Label-->
										</div>
										<!--end::Stat-->
										<!--begin::Stat-->
										<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
											<!--begin::Number-->
											<div class="d-flex align-items-center">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
												<span class="svg-icon svg-icon-3 svg-icon-danger me-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
														<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="75">0</div>
											</div>
											<!--end::Number-->
											<!--begin::Label-->
											<div class="fw-semibold fs-6 text-gray-400">Projects</div>
											<!--end::Label-->
										</div>
										<!--end::Stat-->
										<!--begin::Stat-->
										<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
											<!--begin::Number-->
											<div class="d-flex align-items-center">
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
												<span class="svg-icon svg-icon-3 svg-icon-success me-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
														<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
											</div>
											<!--end::Number-->
											<!--begin::Label-->
											<div class="fw-semibold fs-6 text-gray-400">Success Rate</div>
											<!--end::Label-->
										</div>
										<!--end::Stat-->
									</div>
									<!--end::Stats-->
								</div>
								<!--end::Wrapper-->
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
							<a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_setting_tab">Settings</a>
						</li>
						<!--end::Nav item-->
						<!--begin::Nav item-->
						<li class="nav-item mt-2">
							<a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_history_tab">History</a>
						</li>
						<!--end::Nav item-->
						<!--begin::Nav item-->
						<li class="nav-item mt-2">
							<a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_user_view_log_tab">Logs</a>
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
                                    <span class="fw-bold fs-6 text-gray-800" id="name_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Username</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6" id="username_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                <div class="col-lg-8">
                                    <a href="javascript:;" class="fw-semibold fs-6 text-gray-800 text-hover-primary" id="email_pegawai"></a>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Contact Phone
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Lorem ipsum dolor sit."></i>
                                </label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2" id="no_hp_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Registered</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold text-gray-800 fs-6" id="created_at"></span>
                                </div>
                            </div>
                            <div class="row mb-10">
                                <span class="fw-bold fs-4 text-gray-800 me-2">Informasi Alamat Pegawai</span>
                            </div>
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
                            <div class="row mb-10">
                                <span class="fw-bold fs-4 text-gray-800 me-2">Informasi Outlet Pegawai</span>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Outlet Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800" id="outlet_name_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Outlet Code</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold text-gray-800 fs-6" id="outlet_code_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-10">
                                <span class="fw-bold fs-4 text-gray-800 me-2">Informasi Brand Pegawai</span>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Brand Name</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800" id="brand_name_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Brand Code</label>
                                <div class="col-lg-8">
                                    <span class="fw-semibold text-gray-800 fs-6" id="brand_code_pegawai"></span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Brand Category</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800" id="brand_category_pegawai"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Overview-->

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
                                <!--begin::Email Address-->
                                <div class="d-flex flex-wrap align-items-center">
                                    <div id="kt_email">
                                        <div class="fs-6 fw-bold mb-1">Email Address</div>
                                        <div class="fw-semibold text-gray-600">{{ $pegawai->email }}</div>
                                    </div>
                                    <div id="kt_email_edit" class="flex-row-fluid d-none">
                                        <form id="kt_change_email" action="/admin/update-email-user-pegawai" class="form" method="POST">
                                            @csrf
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-4 mb-lg-0">
                                                    <div class="fv-row mb-0">
                                                        <label for="currentemailaddress" class="form-label fs-6 fw-bold mb-3">Current Email Address</label>
                                                        <input type="hidden" value="{{ $pegawai->id }}" name="id" readonly/>
                                                        <input class="form-control form-control-lg form-control-solid" value="{{ $pegawai->email }}" readonly/>
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
                                        <form id="kt_signin_change_password" class="form" method="POST" action="/admin/update-password-user-pegawai">
                                            @csrf
                                            <input type="hidden" value="{{ $pegawai->id }}" name="id" readonly/>
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

                    @if ($pegawai->is_active == 1)
                        <!--begin::Deactivate Account-->
                        <div class="card">
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_deactivate" aria-expanded="true" aria-controls="kt_deactivate">
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">Deactivate Account</h3>
                                </div>
                            </div>
                            <div class="collapse show">
                                <form id="kt_deactivate_form" class="form" method="POST" action="/admin/update-status-user-pegawai">
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
                                            <input type="hidden" value="{{ $pegawai->id }}" name="id" readonly/>
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
                                <form id="kt_activate_form" class="form" method="POST" action="/admin/update-status-user-pegawai">
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
                                            <input type="hidden" value="{{ $pegawai->id }}" name="id" readonly/>
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

                <!--begin::History-->
                <div class="tab-pane fade" id="kt_user_view_history_tab" role="tabpanel">
                    <div class="card">
                        <!--begin::Header-->
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title">
                                <h3 class="m-0 text-gray-800">Statement</h3>
                            </div>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar m-0">
                                <!--begin::Tab nav-->
                                <ul class="nav nav-stretch fs-5 fw-semibold nav-line-tabs border-transparent" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="kt_referrals_year_tab" class="nav-link text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#kt_referrals_1">This Year</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="kt_referrals_2019_tab" class="nav-link text-active-gray-800 me-4" data-bs-toggle="tab" role="tab" href="#kt_referrals_2">2019</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="kt_referrals_2018_tab" class="nav-link text-active-gray-800 me-4" data-bs-toggle="tab" role="tab" href="#kt_referrals_3">2018</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="kt_referrals_2017_tab" class="nav-link text-active-gray-800 ms-8" data-bs-toggle="tab" role="tab" href="#kt_referrals_4">2017</a>
                                    </li>
                                </ul>
                                <!--end::Tab nav-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Tab Content-->
                        <div id="kt_referred_users_tab_content" class="tab-content">
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ps-9">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_2" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ps-9">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td class="ps-9">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_3" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ps-9">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td class="ps-9">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Sep 15, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Iphone 12 Pro Mockup Mega Bundle</td>
                                                <td class="text-success">$5.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">May 30, 2020</td>
                                                <td class="ps-0">523445943</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-1.30</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Apr 22, 2020</td>
                                                <td class="ps-0">231445943</td>
                                                <td>Parcel Shipping / Delivery Service App</td>
                                                <td class="text-success">$204.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_referrals_4" class="card-body p-0 tab-pane fade" role="tabpanel">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                            <tr>
                                                <th class="min-w-175px ps-9">Date</th>
                                                <th class="min-w-150px px-0">Order ID</th>
                                                <th class="min-w-350px">Details</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px text-center">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">102445788</td>
                                                <td>Darknight transparency 36 Icons Pack</td>
                                                <td class="text-success">$38.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 24, 2020</td>
                                                <td class="ps-0">423445721</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-2.60</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Feb 09, 2020</td>
                                                <td class="ps-0">426445943</td>
                                                <td>Visual Design Illustration</td>
                                                <td class="text-success">$31.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Nov 01, 2020</td>
                                                <td class="ps-0">984445943</td>
                                                <td>Abstract Vusial Pack</td>
                                                <td class="text-success">$52.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Jan 04, 2020</td>
                                                <td class="ps-0">324442313</td>
                                                <td>Seller Fee</td>
                                                <td class="text-danger">$-0.80</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-9">Oct 08, 2020</td>
                                                <td class="ps-0">312445984</td>
                                                <td>Cartoon Mobile Emoji Phone Pack</td>
                                                <td class="text-success">$76.00</td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
                <!--end::History-->

                <!--begin::Logs-->
                <div class="tab-pane fade" id="kt_user_view_log_tab" role="tabpanel">
                    <div class="card mb-5 mb-lg-10">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Heading-->
                            <div class="card-title">
                                <h3>Login Sessions</h3>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <div class="my-1 me-4">
                                    <!--begin::Select-->
                                    <select class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="Select Hours" data-hide-search="true">
                                        <option value="1" selected="selected">1 Hours</option>
                                        <option value="2">6 Hours</option>
                                        <option value="3">12 Hours</option>
                                        <option value="4">24 Hours</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <a href="#" class="btn btn-sm btn-primary my-1">View All</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                    <!--begin::Thead-->
                                    <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                        <tr>
                                            <th class="min-w-250px">Location</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-150px">Device</th>
                                            <th class="min-w-150px">IP Address</th>
                                            <th class="min-w-150px">Time</th>
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fw-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">USA(5)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bold">OK</span>
                                            </td>
                                            <td>Chrome - Windows</td>
                                            <td>236.125.56.78</td>
                                            <td>2 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">United Kingdom(10)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bold">OK</span>
                                            </td>
                                            <td>Safari - Mac OS</td>
                                            <td>236.125.56.78</td>
                                            <td>10 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Norway(-)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-danger fs-7 fw-bold">ERR</span>
                                            </td>
                                            <td>Firefox - Windows</td>
                                            <td>236.125.56.10</td>
                                            <td>20 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Japan(112)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bold">OK</span>
                                            </td>
                                            <td>iOS - iPhone Pro</td>
                                            <td>236.125.56.54</td>
                                            <td>30 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Italy(5)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-warning fs-7 fw-bold">WRN</span>
                                            </td>
                                            <td>Samsung Noted 5- Android</td>
                                            <td>236.100.56.50</td>
                                            <td>40 mins ago</td>
                                        </tr>
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Logs-->
            </div>
			<!--end::details View-->
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
</div>
<!--end::Content wrapper-->

@endsection

@section('script')

<!-- Profile Details -->
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/admin/get_data_detail_profile_pegawai/{{ $pegawai->id }}',
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                        const profile = response.data[0];
                        const name = profile.name_pegawai ? profile.name_pegawai : '-';
                        const username = profile.username ? profile.username : '-';
                        const email = profile.email ? profile.email : '-';
                        const no_hp = profile.no_hp ? profile.no_hp : '-';
                        const created_at = profile.created_at ? profile.created_at : '-';
                        const nama_kelurahan = profile.nama_kelurahan ? profile.nama_kelurahan : '-';
                        const nama_kecamatan = profile.nama_kecamatan ? profile.nama_kecamatan : '-';
                        const nama_kotakab = profile.nama_kotakab ? profile.nama_kotakab : '-';
                        const nama_propinsi = profile.nama_propinsi ? profile.nama_propinsi : '-';
                        const kode_pos = profile.kode_pos ? profile.kode_pos : '-';
                        const alamat_detail = profile.alamat_detail ? profile.alamat_detail : '-';
                        const outlet_name = profile.outlet_name ? profile.outlet_name : '-';
                        const outlet_code = profile.outlet_code ? profile.outlet_code : '-';
                        const brand_name = profile.brand_name ? profile.brand_name : '-';
                        const brand_code = profile.brand_code ? profile.brand_code : '-';
                        const brand_category_name = profile.brand_category_name ? profile.brand_category_name : '-';
                        $('#name_pegawai').text(name);
                        $('#email_pegawai').text(email);
                        $('#username_pegawai').text(username);
                        $('#no_hp_pegawai').text(no_hp);
                        $('#created_at').text(created_at);
                        $('#nama_kelurahan').text(nama_kelurahan);
                        $('#nama_kecamatan').text(nama_kecamatan);
                        $('#nama_kotakab').text(nama_kotakab);
                        $('#nama_propinsi').text(nama_propinsi);
                        $('#kode_pos').text(kode_pos);
                        $('#alamat_detail').text(alamat_detail);
                        $('#outlet_name_pegawai').text(outlet_name);
                        $('#outlet_code_pegawai').text(outlet_code);
                        $('#brand_code_pegawai').text(brand_code);
                        $('#brand_name_pegawai').text(brand_name);
                        $('#brand_category_pegawai').text(brand_category_name);
                    } else {
                        $('#name_pegawai').text('-');
                        $('#email_pegawai').text('-');
                        $('#username_pegawai').text('-');
                        $('#no_hp_pegawai').text('-');
                        $('#created_at').text('-');
                        $('#nama_kelurahan').text('-');
                        $('#nama_kecamatan').text('-');
                        $('#nama_kotakab').text('-');
                        $('#nama_propinsi').text('-');
                        $('#kode_pos').text('-');
                        $('#alamat_detail').text('-');
                        $('#outlet_name_pegawai').text('-');
                        $('#outlet_code_pegawai').text('-');
                        $('#brand_code_pegawai').text('-');
                        $('#brand_name_pegawai').text('-');
                        $('#brand_category_pegawai').text('-');
                    }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
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
                    url: "/admin/validateEmailPegawai",
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
            e.preventDefault();
            var newPassword = $('#newpassword').val();
            var confirmPassword = $('#confirmpassword').val();
            var passwordError = $('#passwordError');

            if (newPassword.length >= 8 && /[!@#$%^&*(),.?":{}|<>]/g.test(newPassword) && newPassword === confirmPassword) {
                passwordError.addClass('d-none').hide();
                // Submit the form
                this.submit();
            } else {
                passwordError.removeClass('d-none').show();
            }
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