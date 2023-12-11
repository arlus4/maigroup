
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<div id="kt_app_header" class="app-header">
					<div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
							<a href="{{ route('owner.dashboard-owner') }}">
								<img alt="Logo" src="{{ asset('assets/images/logo_maitea.png') }}" class="h-20px h-lg-30px app-sidebar-logo-default" />
							</a>
						</div>
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
							<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
								<div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
									<div class="menu-item {{ Request::routeIs('owner.dashboard-owner') ? 'here show' : '' }}">
										<span class="menu-link">
											<a href="{{ route('owner.dashboard-owner') }}">
												<span class="menu-title">Dasbor</span>
											</a>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</div>
									<div class="menu-item {{ Request::routeIs('owner.owner_menu_order') ? 'here show' : '' }}">
										<span class="menu-link">
											<a href="{{ route('owner.owner_menu_order') }}">
												<span class="menu-title">Menu Order</span>
											</a>
											<span class="menu-arrow d-lg-none"></span>
										</span>
									</div>
									<div class="menu-item {{ Request::routeIs('owner.owner_claim_bonus') ? 'here show' : '' }}">
										<span class="menu-link">
											<button type="button" style="border: 0px;background: transparent;" data-bs-toggle="modal" data-bs-target="#modalOpsi">
												<span class="menu-title">Claim Bonus</span>
												<span class="menu-arrow d-lg-none"></span>
											</button>
										</span>
									</div>
								</div>
							</div>
							<div class="app-navbar flex-shrink-0">
								<div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
									<div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<img src="{{ asset($global_user->path_avatar) ?: asset('assets/images/avatar.png') }}" />
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="{{ asset($global_user->path_avatar) ?: asset('assets/images/avatar.png') }}" />
												</div>
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
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
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<div class="d-flex flex-column flex-column-fluid">
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
								<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
									<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
										<h1 class="page-heading d-flex text-dark fw-bold fs-1 flex-column justify-content-center my-0">{{ $title ?? 'Dasbor' }}</h1>
									</div>
								</div>
							</div>
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<div id="kt_app_content_container" class="app-container container-xxl">
									@yield('content')
								</div>
							</div>
						</div>
						<div id="kt_app_footer" class="app-footer">
							<div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2023&copy;</span>
									<a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary">MaiTea Group</a>
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

		<div class="modal fade" id="modalOpsi"> 
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Claim Bonus</h3>
						<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
						</div>
					</div>
					<div class="modal-body">
						<form action="#" id="formInputQrCode">
							@csrf
							<div class="form-group mt-3">
								<label>Masukkan Kode Voucher</label>
								<input type="text" name="voucher_code" id="inputQrCode" class="form-control" placholder="Contoh : 1538010999">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="close-button" class="css-ca2jq0s" style="line-height: 39px;height: 40px;width: 90px;" data-bs-dismiss="modal">Batalkan</button>
						<button id="simpan-button" class="css-kl2kd9a" style="height: 40px; width: 130px;background-color: #e2e2e2;color: #929292;cursor: not-allowed;">Lanjut</button>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="modal fade" tabindex="-1" id="modalOpsi">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Opsi Claim Bonus</h3>
						<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
						</div>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<input type="radio" class="btn-check" name="account_type" id="gunakanScan">
								<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="gunakanScan">
									<span class="svg-icon svg-icon-muted svg-icon-2hx">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z" fill="currentColor"/>
											<path d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z" fill="currentColor"/>
										</svg>
									</span>
									<span class="d-block fw-semibold text-start">
										<span class="text-dark fw-bold d-block fs-6 mb-2">Gunakan Scan Barcode</span>
									</span>
								</label>
							</div>
							<div class="col-md-6">
								<input type="radio" class="btn-check" name="account_type" id="inputCode">
								<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="inputCode">
									<span class="svg-icon svg-icon-muted svg-icon-2hx">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
											<path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
											<path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
										</svg>
									</span>
									<span class="d-block fw-semibold text-start">
										<span class="text-dark fw-bold d-block fs-6 mb-2">Input Nomor QR Code</span>
									</span>
								</label>
							</div>
						</div>
						<form action="#" id="formQrCode">
							@csrf
							<div class="form-group mt-3">
								<label>Masukkan Nomor QR Code</label>
								<input type="text" name="qrcode" id="inputQrCode" class="form-control" placholder="Contoh : ">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="close-button" class="css-ca2jq0s" style="line-height: 39px;height: 40px;width: 90px;" data-bs-dismiss="modal">Batalkan</button>
						<button id="simpan-button" class="css-kl2kd9a" style="height: 40px; width: 130px;background-color: #e2e2e2;color: #929292;cursor: not-allowed;">Lanjut</button>
					</div>
				</div>
			</div>
		</div> -->


		<script src="{{ asset('assets/owner/js/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/owner/js/scripts.bundle.js') }}"></script>
		<script>
			$(document).ready(function() {
				$("#inputQrCode").on('input', function () {
					// Ubah teks menjadi huruf kapital
					var value = $(this).val().toUpperCase();
					$(this).val(value);
				}).keydown(function (e) {
					// Izinkan kontrol khusus seperti backspace, delete, dll.
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
						(e.keyCode == 65 && e.ctrlKey === true) ||
						(e.keyCode >= 35 && e.keyCode <= 39)) {
						return;
					}

					// Jika bukan angka atau huruf, mencegah input.
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && 
						(e.keyCode < 65 || e.keyCode > 90) &&
						(e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});

				$("#inputQrCode").on("input", function() {
					var isInputEmpty = $(this).val().trim() === "";
					
					$("#simpan-button").prop("disabled", isInputEmpty);

					var buttonStyles = {
						'cursor': isInputEmpty ? 'not-allowed' : 'pointer',
						'background-color': isInputEmpty ? '#e2e2e2' : '#039344',
						'color': isInputEmpty ? '#929292' : '#ffffff'
					};

					$("#simpan-button").css(buttonStyles);
				});

				$('#simpan-button').click(function() {
					$('#formInputQrCode').submit(); 
				});

				$('#formInputQrCode').submit(function(e) {
					e.preventDefault();
					
					let formData = new FormData(this);
					$.ajax({
						type: 'POST',
						url: "{{ route('owner.owner_store_qr_code') }}",
						data: formData,
						contentType: false,
						processData: false,
						success: function(data) {
							toastr.success("Berhasil");
							$('#modalOpsi').modal('hide');
                            // location.reload();
						},
						error: function(data) {
							toastr.error("Terjadi kesalahan. Silakan coba lagi.");
							$('#modalOpsi').modal('hide');
                            // location.reload();
						}
					});
				});


				// $('#formQrCode').hide();
				// updateButtonType();
    			// updateSimpanButtonStatus();

				// function updateButtonType() {
				// 	var gunakanScanSelected = $('#gunakanScan').is(':checked');
				// 	var inputCodeSelected = $('#inputCode').is(':checked');
					
				// 	// Jika "gunakanScan" dipilih, ubah tombol menjadi type="button"
				// 	if (gunakanScanSelected) {
				// 		$('#simpan-button').attr('type', 'button').text('Lanjut');
				// 		$('#formQrCode').hide();
				// 		$('#inputQrCode').val('');
				// 	} 
				// 	// Jika "inputCode" dipilih, ubah tombol menjadi type="submit"
				// 	else if (inputCodeSelected) {
				// 		$('#simpan-button').attr('type', 'submit').text('Kirim');
				// 		$('#formQrCode').show();
				// 	}
				// }

				// function updateSimpanButtonStatus() {
				// 	var isOptionSelected = $('#gunakanScan').is(':checked') || $('#inputCode').is(':checked');
				// 	$('#simpan-button').prop('disabled', !isOptionSelected);
				// 	$('#simpan-button').css({
				// 		'cursor': isOptionSelected ? 'pointer' : 'not-allowed',
				// 		'background-color': isOptionSelected ? '#039344' : '#e2e2e2',
				// 		'color': isOptionSelected ? '#ffffff' : '#929292'
				// 	});
				// }

				// $('input[name="account_type"]').change(function() {
				// 	updateButtonType();
				// 	updateSimpanButtonStatus(); 
				// });

				// // Event listener untuk tombol "Kirim"
				// $('#simpan-button').click(function() {
				// 	var type = $(this).attr('type');
				// 	if (type === 'submit') {
				// 		$('#formQrCode').submit(); 
				// 	} else {
				// 		window.location.href = "{{ route('owner.owner_claim_bonus') }}";
				// 	}
				// });

				// $('#formQrCode').submit(function(e) {
				// 	e.preventDefault();
					
				// 	let formData = new FormData(this);
				// 	$.ajax({
				// 		type: 'POST',
				// 		url: "{{ route('owner.owner_store_qr_code') }}",
				// 		data: formData,
				// 		contentType: false,
				// 		processData: false,
				// 		success: function(data) {
				// 			toastr.success("Berhasil");
				// 			$('#modalOpsi').modal('hide');
                //             location.reload();
				// 		},
				// 		error: function(data) {
				// 			toastr.error("Terjadi kesalahan. Silakan coba lagi.");
				// 			$('#modalOpsi').modal('hide');
                //             location.reload();
				// 		}
				// 	});
				// });

				// $('#modalOpsi').on('show.bs.modal', function() {
				// 	updateButtonType();
				// 	updateSimpanButtonStatus();
				// });
			});
		</script>