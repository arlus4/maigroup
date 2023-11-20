@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Edit Pengaturan Akun</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('owner.owner_update_profile', ['username' => Auth::user()->username]) }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <input type="hidden" name="idUserLogin" value="{{ $getData->idUserLogin }}">
                        <input type="hidden" name="avatar" value="{{ $getData->avatar }}">
                        <input type="hidden" name="path_avatar" value="{{ $getData->path_avatar }}">
						<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
							<div class="card-header">
								<div class="card-title">
									<h2 style="font-size: 16px;">Pilih Avatar</h2>
								</div>
							</div>
							<div class="card-body text-center pt-0">
                                <style>.image-input-placeholder { background-image: url('../../../storage/user_penjual/avatar/{{$getData->avatar}}'); } [data-theme="dark"] .image-input-placeholder { background-image: url('../../../storage/user_penjual/avatar/{{$getData->avatar}}'); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                        <i class="fas fa-pencil fs-7"></i>
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal Gambar">
                                        <i class="fas fa-close fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Gambar">
                                        <i class="fas fa-close fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7" style="color: #31353B!important;">Format gambar <strong style="font-size: 11px;">Wajib .jpg .jpeg .png</strong></div>
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
												<h2 style="font-size: 16px;">Informasi Umum</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Lengkap</label>
                                                        <input type="text" name="name" class="form-control mb-2" placeholder="Contoh : Asep Sumantri" value="{{ $getData->name }}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Username</label>
                                                        <input type="text" name="username" class="form-control mb-2" placeholder="Contoh : asepsumantri03" value="{{ $getData->username }}" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">NIK</label>
                                                        <input type="text" name="nomor_ktp" class="form-control mb-2" placeholder="Contoh : 3217xxxxxxxxx" value="{{ $getData->nomor_ktp }}" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nomor HP</label>
                                                        <input type="text" name="no_hp" class="form-control mb-2" placeholder="Contoh : 082xxxxx" value="{{ $getData->no_hp }}" required/>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-md-6" data-select2-id="select2-data-20-xvz6">
                                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jenis Kelamin</label>
                                                    <select class="form-select mb-2" name="jenis_kelamin" data-control="select2" data-placeholder="Pilih Jenis Kelamin" data-allow-clear="true" required>
                                                        <option></option>
                                                        <option value="P" {{ $getData->jenis_kelamin == 'P' ? 'selected' : '' }}>Pria</option>
                                                        <option value="W" {{ $getData->jenis_kelamin == 'W' ? 'selected' : '' }}>Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control mb-2" value="{{ $getData->tanggal_lahir }}" required/>
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 16px;">Informasi Alamat</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div class="form-group">
                                                <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Provinsi</label>
                                                <select class="form-select mb-2" name="provinsi" id="prv_id" data-control="select2" data-placeholder="Pilih Provinsi" data-allow-clear="true">
                                                    <option></option>
                                                    @foreach($getProvinsi as $provinsi)
                                                        <option value="{{ $provinsi->kode_propinsi }}" {{ $getData['provinsi'] == $provinsi->kode_propinsi ? 'selected' : '' }}>
                                                            {{ $provinsi->nama_propinsi }}
                                                        </option>
                                                    @endforeach
												</select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kota / Kabupaten</label>
                                                        <select class="form-select mb-2" name="kotkab" id="kotkab_id" data-control="select2" data-placeholder="Pilih Kota / Kabupaten" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKotaKab as $kotkab)
                                                                <option value="{{ $kotkab->kode_kotakab }}" {{ $getData['kota_kabupaten'] == $kotkab->kode_kotakab ? 'selected' : '' }}>
                                                                    {{ $kotkab->nama_kotakab }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kecamatan</label>
                                                        <select class="form-select mb-2" name="kecamatan" id="kecamatan_id" data-control="select2" data-placeholder="Pilih Kecamatan" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKecamatan as $kecamatan)
                                                                <option value="{{ $kecamatan->kode_kecamatan }}" {{ $getData['kecamatan'] == $kecamatan->kode_kecamatan ? 'selected' : '' }}>
                                                                    {{ $kecamatan->nama_kecamatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kelurahan</label>
                                                        <select class="form-select mb-2" name="kelurahan" id="kelurahan_id" data-control="select2" data-placeholder="Pilih Kelurahan" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKelurahan as $kelurahan)
                                                                <option value="{{ $kelurahan->kode_kelurahan }}" {{ $getData['kelurahan'] == $kelurahan->kode_kelurahan ? 'selected' : '' }}>
                                                                    {{ $kelurahan->nama_kelurahan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode POS</label>
                                                        <select class="form-select mb-2" name="kode_pos" id="kodepos_id" data-control="select2" data-placeholder="Pilih Kode Pos" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKodePos as $kodepos)
                                                                <option value="{{ $kodepos->kodepos }}" {{ $getData['kode_pos'] == $kodepos->kodepos ? 'selected' : '' }}>
                                                                    {{ $kodepos->kodepos }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Detail Alamat Lengkap</label>
												<textarea name="alamat_detail" class="form-control mb-2" rows="4" placeholder="Contoh : Jalan Amir Mahmud, Belakang Griya Mart">{{ $getData->alamat_detail }}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a href="{{ route('owner.owner_pengaturan_akun', ['username' => Auth::user()->username]) }}" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" class="css-kl2kd9a">Simpan Perubahan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("#prv_id").change(function() {
                var provinsi_id = $(this).val();
                $.ajax({
                    url: '/get_data_kotakab/' + provinsi_id ,
                    type: "GET",
                    data: {
                        provinsi_id: provinsi_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kotakab_id = $("#kotkab_id");
                        kotakab_id.empty();
                        kotakab_id.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.kode_kotakab).text(element.nama_kotakab);

                            if (element.kode_kotakab == '{{ old('kotakab_id') }}') {
                                option.attr('selected', 'selected');
                            }

                            kotakab_id.append(option);
                        });
                    }
                });
            });

            $("#kotkab_id").change(function() {
                var kotakab_id = $(this).val();
                $.ajax({
                    url: '/get_data_kecamatan/' + kotakab_id ,
                    type: "GET",
                    data: {
                        kotakab_id: kotakab_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kecamatan_id = $("#kecamatan_id");
                        kecamatan_id.empty();
                        kecamatan_id.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.kode_kecamatan).text(element.nama_kecamatan);

                            // Set opsi yang dipilih berdasarkan nilai old('kecamatan_id')
                            if (element.kode_kecamatan == '{{ old('kecamatan_id') }}') {
                                option.attr('selected', 'selected');
                            }

                            kecamatan_id.append(option);
                        });
                    }
                });
            });

            $("#kecamatan_id").change(function() {
                var kecamatan_id = $(this).val();
                $.ajax({
                    url: '/get_data_kelurahan/' + kecamatan_id ,
                    type: "GET",
                    data: {
                        kecamatan_id: kecamatan_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kelurahan_id = $("#kelurahan_id");
                        kelurahan_id.empty();
                        kelurahan_id.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.kode_kelurahan).text(element.nama_kelurahan);

                            // Set opsi yang dipilih berdasarkan nilai old('kelurahan_id')
                            if (element.kode_kelurahan == '{{ old('kelurahan_id') }}') {
                                option.attr('selected', 'selected');
                            }

                            kelurahan_id.append(option);
                        });
                    }
                });
            });

            $("#kelurahan_id").change(function() {
                var kelurahan_id = $(this).val();
                $.ajax({
                    url: '/get_data_kodepos/' + kelurahan_id ,
                    type: "GET",
                    data: {
                        kelurahan_id: kelurahan_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kodepos_id = $("#kodepos_id");
                        kodepos_id.empty();
                        kodepos_id.append("<option></option>");
                        $.each(data, function(index, element) {
                            var option = $("<option>").val(element.kodepos).text(element.kodepos);

                            // Set opsi yang dipilih berdasarkan nilai old('kodepos_id')
                            if (element.kodepos == '{{ old('kodepos_id') }}') {
                                option.attr('selected', 'selected');
                            }

                            kodepos_id.append(option);
                        });
                    }
                });
            });
        });
    </script>
@endsection