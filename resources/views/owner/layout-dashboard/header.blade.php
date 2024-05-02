
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
										<div class="menu-link">
											<button type="button" class="bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#modalOpsi">
												<span class="menu-title">Claim Bonus</span>
												<span class="menu-arrow d-lg-none"></span>
											</button>
										</div>
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
									<a href="https://keenthemes.com/" target="_blank" class="text-gray-800 text-hover-primary">Toko Seru Group</a>
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
					<div class="modal-body pt-0">
						<form action="#" id="formInputQrCode">
							@csrf
							<div class="form-group mt-3">
								<label>Masukkan Kode Voucher</label>
								<input type="text" name="voucher_code" id="inputQrCode" class="form-control" placholder="Contoh : 1538010999">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="css-ca2jq0s" style="line-height: 39px;height: 40px;width: 90px;" data-bs-dismiss="modal">Batalkan</button>
						<button id="simpan-button" class="css-kl2kd9a" style="height: 40px; width: 130px;background-color: #e2e2e2;color: #929292;cursor: not-allowed;">Lanjut</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Konfirmasi -->
		<div class="modal fade" id="modalKonfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">> 
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<form action="#">
							<div class="text-center">
								<h2>Konfirmasi</h2>
								<h4>Apakah Data Ini Sudah Valid?</h4>
							</div>
							<hr>
							<div class="css-nkvw90sn">
								<p id="pembeli_id"></p>
								<div class="css-k2nsdn0">
									<div class="css-fwkjgh2">
										<span>Nama</span>
										<p class="css-nmae2hsd" id="konf_name"></p>
									</div>
								</div>
								<div class="css-k2nsdn0">
									<div class="css-fwkjgh2">
										<span>Nomor Telpon</span>
										<p class="css-nmae2hsd" id="konf_noTelp"></p>
									</div>
								</div>
								<div class="css-k2nsdn0">
									<div class="css-fwkjgh2">
										<span>Kode Voucher</span>
										<p class="css-nmae2hsd" id="konf_voucherCode"></p>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="tutup_button" class="css-ca2jq0s" style="line-height: 39px;height: 40px;width: 90px;" data-bs-dismiss="modal">Batal</button>
						<button class="css-kl2kd9a" id="btnValid" style="height: 40px; width: 130px;">Ya, Valid</button>
					</div>
				</div>
			</div>
		</div>

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
						url: "{{ route('owner.owner_konfirmasi_claim') }}",
						data: formData,
						contentType: false,
						processData: false,
						beforeSend: function() {
							$('#modalOpsi').modal('hide');
						},
						success: function(data) {
							$('#modalKonfirmasi').modal('show');
							$("#pembeli_id").val(data.data.pembeli_id);
							$('#konf_name').text(data.data.name);
							$('#konf_noTelp').text(data.data.nomor_telfon);
							$('#konf_voucherCode').text(data.data.voucher_code);
							$('#btnValid').off('click').on('click', function() { // 'off' untuk menghindari pengikatan ganda
								$.ajax({
									type: 'POST',
									url: "{{ route('owner.owner_update_claim') }}",
									beforeSend: function() {
										$('#modalKonfirmasi').modal('hide');
									},
									data: {
										pembeli_id: $("#pembeli_id").val(),
										voucher_code: $('#konf_voucherCode').text(),
										_token: "{{ csrf_token() }}"
									},
									success: function(response) {
										toastr.success('Prosedur berhasil dijalankan');
										location.reload();
									},
									error: function(xhr, status, error) {
										toastr.error('Terjadi kesalahan: ' + error);
										location.reload();
									}
								});
							});
						},
						error: function(xhr, status, error) {
							var errorMessage = "Terjadi kesalahan. Silakan coba lagi.";

							if (xhr.responseJSON && xhr.responseJSON.message) {
								errorMessage = xhr.responseJSON.message;
							}

							toastr.error(errorMessage); // Menampilkan pesan error menggunakan toastr

							$('#modalKonfirmasi').modal('hide');
							location.reload();
						}
					});
				});

				$('#modalKonfirmasi').on('hide.bs.modal', function() {
					$('#konf_name, #konf_noTelp, #konf_voucherCode').text('');
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();
				});

				$('#modalOpsi').on('hide.bs.modal', function() {
					$('#inputQrCode').val('');
					$('#simpan-button').prop('disabled', true)
									.css({
										'cursor': 'not-allowed',
										'background-color': '#e2e2e2',
										'color': '#929292'
									});
				});

			});
		</script>