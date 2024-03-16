@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Tambah {{ $title }}</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('admin.admin_store_banner') }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 18px;">Informasi {{ $title }}</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div class="row fv-row">
									            <h2 style="font-size: 1rem;">Foto Banner Promo</h2>
                                                <div class="col-md-8">
                                                    <style>
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image.svg');
                                                        } [data-theme="dark"]
                                                        .image-input-placeholder {
                                                            background-image: url('../../../assets/master/media/svg/files/blank-image-dark.svg');
                                                        }
                                                    </style>
                                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                        <!-- start:Ukuran Card Image -->
                                                        <div class="image-input-wrapper w-500px h-200px"></div>
                                                        <!-- end:Ukuran Card Image -->
                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                                            <i class="fas fa-pencil fs-7"></i>
                                                            <input type="file" name="image_name" accept=".png, .jpg, .jpeg" required/>
                                                            <input type="hidden" name="image_remove" />
                                                        </label>
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Hapus Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                    </div>
                                                    <div class="text-muted fs-7" style="color: #31353B!important;">Format gambar <strong style="font-size: 11px;">Wajib .jpg .jpeg .png</strong></div>
                                                </div>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode Banner</label>
                                                        <input type="text" name="banner_code" id="banner_code" class="form-control mb-2" required>
                                                        <div id="textAlerBannerCode" class="text-muted fs-7" style="color: #31353B!important;">Kode Banner <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                        <div id="BannerCodeMsg" class="text-muted fs-7" style="color: #d90429!important; display: none;">Kode Banner Sudah digunakan</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Banner</label>
                                                        <input type="text" name="banner_name" class="form-control mb-2" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Start Date</label>
                                                        <input type="date" name="start_date" class="form-control mb-2" id="start_date" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">End Date</label>
                                                        <input type="date" name="end_date" class="form-control mb-2" id="end_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-custom form-check-transparent form-check-lg">
                                                <input class="form-check-input" type="checkbox" value="national" name="national" id="national"/>
                                                <label class="form-check-label fw-semibold mb-2" for="national" style="color: black"> National </label>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Brand</label>
                                                        <select class="form-select mb-2" name="brand_code" id="brnd_code" data-control="select2" data-placeholder="Pilih Brand" data-allow-clear="true" required>
                                                            <option></option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand->brand_code }}">{{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Outlet</label>
                                                        <select class="form-select mb-2" name="outlet_code" id="outletCode" data-control="select2" data-placeholder="Pilih Outlet" data-allow-clear="true" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Deskripsi</label>
												{{-- <textarea name="description" class="form-control mb-2" rows="4" required></textarea> --}}
                                                <textarea name="description" id="description"></textarea>
												<div class="text-muted fs-7" style="color: #31353B!important;">Pastikan deskripsi memuat penjelasan detail yang jelas.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a href="{{ route('admin.admin_banner') }}" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" class="css-kl2kd9a">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <!-- Ajax -->
    <script>
        $(document).ready(function() {
            $('#national').change(function() {
                if ($(this).is(':checked')) {
                    // Checkbox dicentang, reset, disable kedua select dan hilangkan required
                    $('#brnd_code').val('').prop('disabled', true).removeAttr('required');
                    $('#outletCode').val('').prop('disabled', true).removeAttr('required');
                } else {
                    // Checkbox tidak dicentang, enable kedua select dan tambahkan required
                    $('#brnd_code').prop('disabled', false).attr('required', 'required');
                    $('#outletCode').prop('disabled', false).attr('required', 'required');
                }
            });

            $("#brnd_code").change(function() {
                var brand_code = $(this).val();
                $.ajax({
                    url: '/get_data_outlet/' + brand_code ,
                    type: "GET",
                    data: {
                        brand_code: brand_code
                    },
                    dataType: "json",
                    success: function(data) {
                        var outletCode = $("#outletCode");
                        outletCode.empty();
                        outletCode.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.outlet_code).text(element.outlet_name);

                            if (element.outlet_code == '{{ old('outletCode') }}') {
                                option.attr('selected', 'selected');
                            }

                            outletCode.append(option);
                        });
                    }
                });
            });

            var handleSearchBannerCode = _.debounce(function() {
                var codeBanner = $('#banner_code').val();
                var BannerCodeMsg = $('#BannerCodeMsg');
                var textAlerBannerCode = $('#textAlerBannerCode');

                if (codeBanner.length >= 3) {
                    $.ajax({
                        url: "/validate_bannerCode",
                        type: "GET",
                        data: { banner_code: codeBanner },
                        success: function(data) {
                            if (data.isUsed) {
                                BannerCodeMsg.show();
                                textAlerBannerCode.hide();
                            } else {
                                BannerCodeMsg.hide();
                                textAlerBannerCode.show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    BannerCodeMsg.hide();
                    textAlerBannerCode.show();
                }
            }, 300);

            $('#banner_code').on('input', handleSearchBannerCode);
        });
    </script>

@endsection