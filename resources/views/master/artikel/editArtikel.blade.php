@extends('layout-master/app')

@section('content')
    <style>
        .img-preview {
            width: 150px;
            height: 150px;
            object-fit: contain; /* Menjaga proporsi gambar */
            object-position: center; /* Pusatkan gambar */
            border: 1px solid #ddd; /* Border opsional */
            border-radius: 4px; /* Rounded corners */
            box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.1); /* Shadow opsional */
        }
    </style>

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
				<form action="{{ route('admin.admin_update_artikel', $artikel->id) }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
						<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
							<div class="card-header">
								<div class="card-title">
									<h2 style="font-size: 16px;">Cover Thumbnail {{ $artikel->news_code }}</h2>
								</div>
							</div>
							<div class="card-body text-center pt-0">
								<div class="image-input image-input-outline image-input-empty" data-kt-image-input="true" style="background-image: url('{{ asset($artikel->path_thumbnail) }}')">
									<!-- start:Ukuran Card Image -->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!-- end:Ukuran Card Image -->
									<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
										<i class="fas fa-pencil fs-7"></i>
                                        <!--begin::Inputs-->
										<input type="file" name="thumbnail" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="avatar_remove" />
                                        <input type="hidden" name="path_thumbnail" value="{{ $artikel->path_thumbnail }}">
                                        <!--end::Inputs-->
									</label>

                                    <!--begin::Cancel-->
									<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal Gambar">
										<i class="fas fa-close fs-2"></i>
									</span>
                                    <!--end::Cancel-->

                                    <!--begin::Remove-->
									<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
										<i class="fas fa-close fs-2"></i>
									</span>
                                    <!--end::Remove-->
								</div>
								<div class="text-muted fs-7" style="color: #31353B!important;">
                                    Format gambar <strong>Wajib .jpg .jpeg .png</strong>
                                </div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::Article Information-->
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Informasi {{ $title }}</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div class="mb-5 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">News Code</label>
												<input type="text" name="news_code" class="form-control mb-2" id="news_code" value="{{ $artikel->news_code }}" required/>
											</div>
											<div class="mb-5 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Headline</label>
												<input type="text" name="headline" class="form-control mb-2" id="headline" value="{{ $artikel->headline }}" required/>
											</div>
											<div class="mb-5 fv-row">
												<label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Caption</label>
												<textarea name="caption" class="form-control mb-2" rows="3" required>{{ $artikel->caption }}</textarea>
											</div>
                                            <div class="mb-5 fv-row">
												<label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">News Content</label>
												{{-- <textarea name="news_content" class="form-control mb-2" rows="6" required></textarea> --}}
												<textarea name="news_content" id="news_content">{{ $artikel->news_content }}</textarea>
											</div>
										</div>
									</div>
                                    <!--end::Article Information-->

                                    <!--begin::Image Slider-->
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Pengelolaan Gambar Slider</h2>
											</div>
										</div>

                                        @foreach ($sliders as $slider)
                                            <div class="gambar-group d-flex flex-column align-items-center mb-3" style="margin-top:10px">
                                                <div class="image-input image-input-outline image-input-empty mb-2" data-kt-image-input="true" style="background-image: url('{{ asset($slider->path) }}')">
                                                    <div class="image-input-wrapper w-500px h-200px"></div>
                                                </div>
                                        
                                                <button class="btn btn-danger remove-slider" type="button" data-slider-id="{{ $slider->id }}">
                                                    <i class="glyphicon glyphicon-remove"></i> Hapus
                                                </button>
                                            </div>
                                        @endforeach

										<div class="card-body pt-0">
                                            <div class="input-group-btn mb-5"> 
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="glyphicon glyphicon-plus"></i> Tambah Gambar
                                                </button>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group control-group increment" >
                                                    <input type="file" name="nama_file[]" class="form-control" accept=".png, .jpg, .jpeg">
                                                    <div class="preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Clone di luar form-group -->
                                        <div class="clone hide" style="display: none;">
                                            <div class="control-group input-group" style="margin-top:10px">
                                                <input type="file" name="nama_file[]" class="form-control" accept=".png, .jpg, .jpeg">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button">
                                                        <i class="glyphicon glyphicon-remove"></i> Hapus
                                                    </button>
                                                </div>
                                                <div class="preview"></div>
                                            </div>
                                        </div>
									</div>
                                    <!--end::Image Slider-->
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a id="kt_ecommerce_add_product_cancel" class="css-ca2jq0s">Batalkan</a>
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
		CKEDITOR.replace( 'news_content' );
	</script>
    <!--Looping Image Content-->
    <script type="text/javascript">
        $(document).ready(function() {
            // Tombol tambah gambar
            $(".btn-success").click(function(){ 
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            
            // Tombol hapus gambar
            $("body").on("click",".btn-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
            
            // Tombol hapus gambar slider dari database dengan SweetAlert
            $("body").on("click", ".remove-slider", function(){
                var sliderId = $(this).data('slider-id');
                var group = $(this).parents(".gambar-group");
                var token = $('meta[name="csrf-token"]').attr('content');

                // Tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX request untuk menghapus gambar
                        $.ajax({
                            url: '/admin/artikel/destroy_image_artikel/' + sliderId,
                            type: 'POST',
                            data: {
                                _token: token, // CSRF token
                                sliderId: sliderId
                            },
                            success: function(response) {
                                group.remove();
                                Swal.fire(
                                    'Terhapus!',
                                    'File Anda telah dihapus.',
                                    'success'
                                )
                            },
                            error: function(error) {
                                console.error("Error:", error);
                                Swal.fire(
                                    'Gagal!',
                                    'Tidak dapat menghapus file.',
                                    'error'
                                )
                            }
                        });
                    }
                });
            });

            // Tampilkan pratinjau gambar
            $(document).on('change', 'input[type="file"]', function() {
                var preview = $(this).siblings('.preview');
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result).addClass('img-preview');
                        preview.html(img);
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.html('');
                }
            });
        });
    </script>
@endsection