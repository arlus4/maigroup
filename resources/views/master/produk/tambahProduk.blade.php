@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Tambah Produk</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="products.html">
					<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
						<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
							<div class="card-header">
								<div class="card-title">
									<h2 style="font-size: 16px;">Foto Produk</h2>
								</div>
							</div>
							<div class="card-body text-center pt-0">
								<style>.image-input-placeholder { background-image: url('../../../assets/media/svg/files/blank-image.svg'); } [data-theme="dark"] .image-input-placeholder { background-image: url('../../../assets/media/svg/files/blank-image-dark.svg'); }</style>
								<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
									<div class="image-input-wrapper w-150px h-150px"></div>
									<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
										<i class="fas fa-pencil fs-7"></i>
										<input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
										<input type="hidden" name="avatar_remove" />
									</label>
									<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal Gambar">
										<i class="fas fa-close fs-2"></i>
									</span>
									<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
										<i class="fas fa-close fs-2"></i>
									</span>
								</div>
								<div class="text-muted fs-7" style="color: #31353B!important;">Format gambar <strong>Wajib .jpg .jpeg .png</strong></div>
							</div>
						</div>
					</div>
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Informasi Produk</h2>
											</div>
										</div>
										<div class="card-body pt-0">
											<div class="mb-10 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Produk</label>
												<input type="text" name="nama_produk" class="form-control mb-2" placeholder="Contoh : Teh Dandang" value="" />
												<div class="text-muted fs-7" style="color: #31353B!important;">Nama produk min. 40 karakter dan Nama <strong>tidak bisa diubah</strong> setelah produk terjual, ya.</div>
											</div>
											<div class="mb-10 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug Produk</label>
												<input type="text" name="slug_produk" class="form-control mb-2" style="background-color: #e2e2e2;cursor: not-allowed;" readonly>
												<div class="text-muted fs-7" style="color: #31353B!important;">Slug Produk akan otomatis sesuai dengan inputan <strong>Nama Produk.</strong></div>
											</div>
											<div class="row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Produk</label>
												<div class="col-md-6">
													<select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" multiple="multiple">
														<option></option>
														<option value="Computers">Computers</option>
														<option value="Watches">Watches</option>
														<option value="Headphones">Headphones</option>
														<option value="Footwear">Footwear</option>
														<option value="Cameras">Cameras</option>
														<option value="Shirts">Shirts</option>
														<option value="Household">Household</option>
														<option value="Handbags">Handbags</option>
														<option value="Wines">Wines</option>
														<option value="Sandals">Sandals</option>
													</select>
													<div class="text-muted fs-7 mb-5" style="color: #31353B!important;">Pilih kategori produk dengan benar, ya.</div>
												</div>
												<div class="col-md-6">
													<button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#addModalKategori">
														<i class="fas fa-plus-circle text-white"></i>
														Tambah Kategori Produk
													</button>
												</div>
											</div>
											<div>
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Deskripsi Produk</label>
												<textarea name="deskripsi_produk" class="form-control mb-2" rows="4"></textarea>
												<div class="text-muted fs-7" style="color: #31353B!important;">Pastikan deskripsi produk memuat penjelasan detail terkait produkmu agar pembeli mudah mengerti dan menemukan produkmu.</div>
											</div>
										</div>
									</div>
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Pengelolaan Produk</h2>
											</div>
										</div>
										<div class="card-body pt-0">
											<div class="mb-10 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">SKU (Stock Keeping Unit)</label>
												<input type="text" name="sku" class="form-control mb-2" placeholder="Masukkan SKU" value="" />
												<div class="text-muted fs-7" style="color: #31353B!important;">Gunakan <strong>kode unik SKU</strong> jika kamu ingin menandai produkmu.</div>
											</div>
											<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Harga Produk</label>
											<div class="input-group">
												<span class="input-group-text" id="harga">Rp</span>
												<input type="text" class="form-control" placeholder="Masukkan Harga" aria-describedby="harga">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a href="products.html" id="kt_ecommerce_add_product_cancel" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" id="kt_ecommerce_add_product_submit" class="css-kl2kd9a">
								<span class="indicator-label">Simpan</span>
								<span class="indicator-progress">Tunggu Sebentar... 
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>

	<!-- Modal -->
	<div class="modal fade" id="addModalKategori">
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 8px">
				<div class="content-header">
					<div class="content-title">
						<h4 class="css-lk3jsp">Tambah Kategori Produk</h4>
					</div>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
					</button>
				</div>
				<div class="css-flj2ej">
				<div class="css-fjkpo0ma">
					<div class="css-wj23sk">
						<div class="css-pp2kjsn">
							<div class="css-fhxb1ns">
								<div class="css-akcdj8w">
									<div class="css-gh3knsa">
										<i class="fas fa-info-circle" style="color: #004085;"></i>
									</div>
									<div>
										<span class="css-vcnak2s">Inputan <strong>Nama Kategori</strong> Wajib Diisi.</span>
									</div>
								</div>
							</div>
						</div>
						<form action="#">
							<div class="form-group mb-3">
								<label class="required fw-semibold fs-6 mb-1">Nama Kategori</label>
								<input type="text" class="form-control nama_kategori" name="nama_kategori" required>
							</div>
							<div class="form-group">
								<label class="fw-semibold fs-6 mb-1">Slug Kategori</label>
								<input type="text" class="form-control slug_kategori" name="slug_kategori" style="background-color: #e2e2e2;cursor: not-allowed" readonly>
							</div>
						</form>
					</div>
				</div> 
				</div>
				<div class="modal-footer">
					<button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batalkan</button>
					<button type="button" class="css-kl2kd9a" style="width: 100px;">Simpan</button>
				</div>
			</div>
		</div>
	</div>
@endsection