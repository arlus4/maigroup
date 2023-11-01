@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Ubah Produk</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="/admin/update_product/{{ $dataProduk->slug }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
						<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
							<div class="card-header">
								<div class="card-title">
									<h2 style="font-size: 16px;">Foto Produk</h2>
								</div>
							</div>
							<div class="card-body text-center pt-0">
								<style>.image-input-placeholder { background-image: url('../../storage/produk/thumbnail/{{$dataProduk->thumbnail}}'); } [data-theme="dark"] .image-input-placeholder { background-image: url('../../storage/produk/thumbnail/{{$dataProduk->thumbnail}}'); }</style>
								<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
									<div class="image-input-wrapper w-150px h-150px"></div>
									<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
										<i class="fas fa-pencil fs-7"></i>
										<input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
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
												<input type="text" name="nama_product" class="form-control mb-2 nama_product" id="nama_product" placeholder="Contoh : Teh Dandang" value="{{ $dataProduk->nama_produk }}"/>
												<div class="text-muted fs-7" style="color: #31353B!important;">Nama produk min. 40 karakter dan Nama <strong>tidak bisa diubah</strong> setelah produk terjual, ya.</div>
											</div>
											<div class="mb-10 fv-row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug Produk</label>
												<input type="text" name="slug" class="form-control mb-2 slug" id="slug" style="background-color: #e2e2e2;cursor: not-allowed;" value="{{ $dataProduk->slug }}" readonly>
												<div class="text-muted fs-7" style="color: #31353B!important;">Slug Produk akan otomatis sesuai dengan inputan <strong>Nama Produk.</strong></div>
											</div>
											<div class="row">
												<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Projek</label>
                                                <select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" name="project_id">
                                                    <option></option>
                                                    @foreach($getKategori as $kategori)
                                                        <option value="{{ $kategori->id }}" {{ $dataProduk['project_id'] == $kategori->id ? 'selected' : '' }}>
                                                            {{ $kategori->project_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="text-muted fs-7 mb-5" style="color: #31353B!important;">Pilih kategori projek dengan benar, ya.</div> 
											</div>
											<div>
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Deskripsi Produk</label>
												<textarea name="deskripsi" class="form-control mb-2" rows="4">{{ $dataProduk->deskripsi }}</textarea>
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
												<input type="text" name="sku" class="form-control mb-2" placeholder="Masukkan SKU" value="{{ $dataProduk->sku }}"/>
												<div class="text-muted fs-7" style="color: #31353B!important;">Gunakan <strong>kode unik SKU</strong> jika kamu ingin menandai produkmu.</div>
											</div>
											<label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Harga Produk</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" placeholder="Masukkan Harga" name="harga" id="harga" aria-describedby="harga" value="{{ $dataProduk->harga }}">
                                            </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a href="{{ route('admin.admin_product') }}" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" class="css-kl2kd9a">Simpan Perubahan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        const nama_product  = document.querySelector('#nama_product');
        const slug          = document.querySelector('#slug');

        nama_product.addEventListener('change', function(){
            fetch('/admin/produkSlug?nama_product=' + nama_product.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

    </script>

@endsection