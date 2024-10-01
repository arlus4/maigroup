@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Profil Owner {{ $getData->name }}</h1>
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
                        <li class="breadcrumb-item text-muted">Management Owner</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Daftar Owner</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Edit Profil Owner {{ $getData->name }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/admin/owner/detail-user-owner/{{ $getData->username }}" class="btn fw-bold btn-primary">Kembali</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
				<form action="{{ route('admin.admin_update_user_owner') }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
                            <input type="hidden" name="idUserLogin" value="{{ $getData->idUserLogin }}">
                            <input type="hidden" name="avatar_exists" value="{{ $getData->avatar }}">
                            <input type="hidden" name="path_avatar_exists" value="{{ $getData->path_avatar }}">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
									<div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-header">
											<div class="card-title">
												<h2 style="font-size: 18px;">Informasi User Owner</h2>
											</div>
										</div>
										<div class="card-body pt-0">
                                            <div class="row fv-row">
									            <h2 style="font-size: 1rem;">Avatar / Foto Profil</h2>
                                                <div class="col-md-6">
								                    <style>
                                                        .image-input-placeholder { 
                                                            background-image: url('../../../{{ $getData->path_avatar }}');
                                                        } [data-theme="dark"]
                                                        .image-input-placeholder {
                                                            background-image: url('../../../{{ $getData->path_avatar }}');
                                                        }
                                                    </style>
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
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama User Owner</label>
                                                        <input type="text" name="name" class="form-control mb-2" id="name" placeholder="Contoh : Asep Sukarna" value="{{ $getData->name }}" required/>
                                                        <div class="text-muted fs-7" style="color: #31353B!important;">Nama user penjual <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">No HP</label>
                                                                <input type="text" name="no_hp" class="form-control mb-2" id="no_hp" placeholder="Contoh : 081xxxxx" value="{{ $getData->no_hp }}" required/>
                                                                <div id="textAlert" class="text-muted fs-7" style="color: #31353B!important;">No HP <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                                <div id="noHpUsedMsg" class="text-muted fs-7" style="color: #d90429!important; display: none;">No HP Sudah digunakan</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Username</label>
                                                                <input type="text" name="username" id="slug_user" class="form-control mb-2 username" placeholder="asep123" value="{{ $getData->username }}">
                                                                <div id="textAlertUsername" class="text-muted fs-7" style="color: #31353B!important;">Username <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                                <div id="usernameUsedMsg" class="text-muted fs-7" style="color: #d90429!important; display: none;">Username Sudah digunakan</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control mb-2 email" placeholder="asep123@gmail.com" value="{{ $getData->email }}">
                                                        <div id="textAlertEmail" class="text-muted fs-7" style="color: #31353B!important;">Masukkan format Email yang valid dan Email <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                        <div id="emailUsedMsg" class="text-muted fs-7" style="color: #d90429!important; display: none;">Email Sudah digunakan</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Ubah Password</label>
                                                        <div class="password-toggle">
                                                            <input type="password" name="password" class="form-control mb-2 password" placeholder="Masukkan Password">
                                                            <span class="toggle-password">
                                                                <i class="fa fa-eye-slash"></i>
                                                            </span>
                                                        </div>
                                                        <div class="text-muted fs-7" style="color: #31353B!important;">Jika melakukan perubahan <strong style="font-size: 11px;">Password</strong> Wajib Diisi, ya.</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-10 fv-row">
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">NIK</label>
                                                        <input type="text" name="nomor_ktp" class="form-control mb-2" id="nomor_ktp" placeholder="Masukkan NIK" value="{{ $getData->nomor_ktp }}" required/>
                                                        <div class="text-muted fs-7" style="color: #31353B!important;">NIK(Nomor Induk Kependudukan) <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir" class="form-control mb-2" id="tanggal_lahir" value="{{ $getData->tanggal_lahir }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Jenis Kelamin</label>
                                                        <select class="form-select mb-2" name="jenis_kelamin" data-control="select2" data-placeholder="Pilih Jenis Kelamin" data-allow-clear="true" required>
                                                            <option></option>
                                                            <option value="P" {{ $getData->jenis_kelamin == 'P' ? 'selected' : '' }}>Pria</option>
                                                            <option value="W" {{ $getData->jenis_kelamin == 'W' ? 'selected' : '' }}>Wanita</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Provinsi</label>
                                                        <select class="form-select mb-2" name="provinsi" id="prv_id" data-control="select2" data-placeholder="Pilih Provinsi" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach($getProvinsi as $provinsi)
                                                                <option value="{{ $provinsi->kode_propinsi }}" {{ $getData->kode_propinsi == $provinsi->kode_propinsi ? 'selected' : '' }}>
                                                                    {{ $provinsi->nama_propinsi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kota / Kabupaten</label>
                                                        <select class="form-select mb-2" name="kotkab" id="kotkab_id" data-control="select2" data-placeholder="Pilih Kota / Kabupaten" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKotaKab as $kotkab)
                                                                <option value="{{ $kotkab->kode_kotakab }}" {{ $getData->kode_kotakab == $kotkab->kode_kotakab ? 'selected' : '' }}>
                                                                    {{ $kotkab->nama_kotakab }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kecamatan</label>
                                                        <select class="form-select mb-2" name="kecamatan" id="kecamatan_id" data-control="select2" data-placeholder="Pilih Kecamatan" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKecamatan as $kecamatan)
                                                                <option value="{{ $kecamatan->kode_kecamatan }}" {{ $getData->kode_kecamatan == $kecamatan->kode_kecamatan ? 'selected' : '' }}>
                                                                    {{ $kecamatan->nama_kecamatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kelurahan</label>
                                                        <select class="form-select mb-2" name="kelurahan" id="kelurahan_id" data-control="select2" data-placeholder="Pilih Kelurahan" data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($getKelurahan as $kelurahan)
                                                                <option value="{{ $kelurahan->kode_kelurahan }}" {{ $getData->kode_kelurahan == $kelurahan->kode_kelurahan ? 'selected' : '' }}>
                                                                    {{ $kelurahan->nama_kelurahan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-10 fv-row">
												<label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode Pos</label>
                                                <select class="form-select mb-2" name="kode_pos" id="kodepos_id" data-control="select2" data-placeholder="Pilih Kode Pos" data-allow-clear="true">
                                                    <option></option>
                                                    @foreach ($getKodePos as $kodepos)
                                                        <option value="{{ $kodepos->kodepos }}" {{ $getData->kode_pos == $kodepos->kodepos ? 'selected' : '' }}>
                                                            {{ $kodepos->kodepos }}
                                                        </option>
                                                    @endforeach
                                                </select>
											</div>
                                            <div>
												<label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Alamat Detail</label>
												<textarea name="alamat_detail" class="form-control mb-2" rows="4">{{ $getData->alamat_detail }}</textarea>
												<div class="text-muted fs-7" style="color: #31353B!important;">Pastikan deskripsi alamat memuat penjelasan detail yang jelas.</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a href="#" class="css-ca2jq0s">Batalkan</a>
							<button type="submit" class="css-kl2kd9a">Simpan Perubahan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- slug Username -->
    <script type="text/javascript">
        const name = document.querySelector('#name');
        const slug_user = document.querySelector('#slug_user');

        name.addEventListener('change', function(){
            fetch('/admin/userSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug_user.value = data.username)
        });
    </script>

    <!-- Ajax -->
    <script>
        $(document).ready(function() {
            $('.toggle-password').on('click', function() {
                var passwordField = $(this).prev('.password');
                var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                // Ganti ikon tipe input
                $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            });

            $("#no_hp").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            var handleSearchNoHp = _.debounce(function() {
                var id           = {{ $getData->idUserLogin }}
                var noHP         = $('#no_hp').val();
                var noHpUsedMsg  = $('#noHpUsedMsg');
                var textAlert    = $('#textAlert');

                if (noHP.length >= 3) {
                    $.ajax({
                        url: "/admin/validate_Edit_NoHp",
                        type: "GET",
                        data: {
                            'no_hp': noHP,
                            'id' : id
                        },
                        success: function(data) {
                            let isUsed = data && data.isUsed;

                            if (isUsed) {
                                noHpUsedMsg.css('display', 'block');
                                textAlert.css('display', 'none');
                            } else {
                                noHpUsedMsg.css('display', 'none');
                                textAlert.css('display', 'block');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    noHpUsedMsg.css('display', 'none');
                    textAlert.css('display', 'block');
                }
            }, 300);

            var handleSearchUsername = _.debounce(function() {
                var userId             = {{ $getData->idUserLogin }}
                var userName           = $('#slug_user').val();
                var usernameUsedMsg    = $('#usernameUsedMsg');
                var textAlertUsername  = $('#textAlertUsername');

                if (userName.length >= 3) {
                    $.ajax({
                        url: "/admin/validate_Edit_Username",
                        type: "GET",
                        data: {
                            'username': userName,
                            'id' : userId
                        },
                        success: function(data) {
                            let dipakai = data && data.dipakai;

                            if (dipakai) {
                                usernameUsedMsg.css('display', 'block');
                                textAlertUsername.css('display', 'none');
                            } else {
                                usernameUsedMsg.css('display', 'none');
                                textAlertUsername.css('display', 'block');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    usernameUsedMsg.css('display', 'none');
                    textAlertUsername.css('display', 'block');
                }
            }, 300);

            var handleSearchEmail = _.debounce(function() {
                var idUser          = {{ $getData->idUserLogin }}
                var email           = $('#email').val();
                var emailUsedMsg    = $('#emailUsedMsg');
                var textAlertEmail  = $('#textAlertEmail');

                if (email.length >= 3) {
                    $.ajax({
                        url: "/admin/validate_Edit_Email",
                        type: "GET",
                        data: {
                            'email' : email,
                            'id' : idUser
                        },
                        success: function(data) {
                            let used = data && data.used;

                            if (used) {
                                emailUsedMsg.css('display', 'block');
                                textAlertEmail.css('display', 'none');
                            } else {
                                emailUsedMsg.css('display', 'none');
                                textAlertEmail.css('display', 'block');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    emailUsedMsg.css('display', 'none');
                    textAlertEmail.css('display', 'block');
                }
            }, 300);

            $('#no_hp').on('input', handleSearchNoHp);
            $('#slug_user').on('input', handleSearchUsername);
            $('#email').on('input', handleSearchEmail);


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