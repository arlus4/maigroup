@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Edit {{ $title }}</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('admin.admin_update_banner', $banner->id) }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
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
                                                    <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url('{{ asset($banner->path) }}')">
                                                        <!-- start:Ukuran Card Image -->
                                                        <div class="image-input-wrapper w-500px h-200px"></div>
                                                        <!-- end:Ukuran Card Image -->
                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                                            <i class="fas fa-pencil fs-7"></i>
                                                            <!--begin::Inputs-->
                                                            <input type="file" name="image_name" accept=".png, .jpg, .jpeg" />
                                                            <input type="hidden" name="image_remove" />
                                                            <input type="hidden" name="path" value="{{ $banner->path }}">
                                                            <!--end::Inputs-->
                                                        </label>

                                                        <!--begin::Cancel-->
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Hapus Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                        <!--end::Cancel-->

                                                        <!--begin::Remove-->
                                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                                            <i class="fas fa-close fs-2"></i>
                                                        </span>
                                                        <!--end::Remove-->
                                                    </div>
                                                    <div class="text-muted fs-7" style="color: #31353B!important;">Format gambar <strong style="font-size: 11px;">Wajib .jpg .jpeg .png</strong></div>
                                                </div>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode Banner</label>
                                                        <input type="text" name="banner_code" class="form-control mb-2" value="{{ $banner->banner_code }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Banner</label>
                                                        <input type="text" name="banner_name" class="form-control mb-2" value="{{ $banner->banner_name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Start Date</label>
                                                        <input type="date" name="start_date" class="form-control mb-2" id="start_date" value="{{ \Carbon\Carbon::parse($banner->start_date)->format('Y-m-d') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">End Date</label>
                                                        <input type="date" name="end_date" class="form-control mb-2" id="end_date" value="{{ \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check form-check-custom form-check-transparent form-check-lg">
                                                <input class="form-check-input" type="checkbox" value="national" name="national" id="national" @if (!$banner->outlet_code) checked @endif/>
                                                <label class="form-check-label fw-semibold mb-2" for="national" style="color: black"> <strong>National</strong> </label>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Brand</label>
                                                        <select class="form-select mb-2" name="brand_code" id="brnd_code" data-control="select2" data-placeholder="Pilih Brand" data-allow-clear="true" required>
                                                            <option></option>
                                                            <option value="{{ $banner->brand_code }}" selected>{{ $banner->brand_name }}</option>
                                                            @foreach($getBrands as $brand)
                                                                @if ($banner->brand_code != $brand->brand_code)
                                                                    <option value="{{ $brand->brand_code }}">{{ $brand->brand_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kota / Kabupaten</label>
                                                        <select class="form-select mb-2" name="kotkab" id="outletCode" data-control="select2" data-placeholder="Pilih Kota / Kabupaten" data-allow-clear="true" required>
                                                            @if ($banner->outlet_code)
                                                                <option value="{{ $banner->outlet_code }}" selected>{{ $banner->outlet_name }}</option>
                                                                @foreach ($getOutlet as $outlet)
                                                                    @if ($banner->outlet_code != $outlet->outlet_code)
                                                                        <option value="{{ $outlet->outlet_code }}">{{ $outlet->outlet_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <option></option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Deskripsi</label>
												{{-- <textarea name="description" class="form-control mb-2" rows="4" required>{{ $banner->description }}</textarea> --}}
                                                <textarea name="description" id="description" required>{{ $banner->description }}</textarea> 
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
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <!-- Ajax -->
    <script>
        $(document).ready(function() {
            function updateSelectState() {
                var isChecked = $('#national').is(':checked');
                $('#brnd_code').prop('disabled', isChecked).attr('required', !isChecked).val(isChecked ? '' : $('#brnd_code').val());
                $('#outletCode').prop('disabled', isChecked).attr('required', !isChecked).val(isChecked ? '' : $('#outletCode').val());
            }

            // Atur keadaan awal saat halaman dimuat
            updateSelectState();

            // Event handler ketika checkbox berubah
            $('#national').change(updateSelectState);

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
                        var outlet_id = $("#outletCode");
                        outlet_id.empty();
                        outlet_id.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.outlet_code).text(element.outlet_name);

                            if (element.outlet_code == '{{ old('outlet_id') }}') {
                                option.attr('selected', 'selected');
                            }

                            outlet_id.append(option);
                        });
                    }
                });
            });
        });
    </script>

@endsection