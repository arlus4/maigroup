@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Edit Outlet {{ $outlet->outlet_name }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="javascript:;" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Management Outlet</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Daftar Outlet Aktif</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Edit Outlet {{ $outlet->outlet_name }}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.admin_outlet_active') }}" class="btn fw-bold btn-primary">Kembali</a>
            </div>
        </div>
    </div>
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
        <form action="{{ route('admin.admin_outlet_update') }}" method="POST" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
            @csrf
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <!-- Card Informasi -->
                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 style="font-size: 18px;">Informasi Outlet {{ $outlet->outlet_name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row fv-row">
                                <h2 style="font-size: 1rem;">Foto / Logo Outlet</h2>
                                <input type="hidden" name="image_name" value="{{ $outlet->image_name }}" />
                                <input type="hidden" name="path" value="{{ $outlet->path }}" />
                                <div class="col-md-6">
                                    @if ($outlet->image_name != NULL)
                                        <style>
                                            .image-input-placeholder {
                                                background-image: url('https://apps.tokoseru.com/{{ $outlet->path }}');
                                            } [data-theme="dark"]
                                            .image-input-placeholder {
                                                background-image: url('https://apps.tokoseru.com/{{ $outlet->path }}');
                                            }
                                        </style>
                                    @else
                                        <style>
                                            .image-input-placeholder {
                                                background-image: url('../../../assets/master/media/svg/files/blank-image.svg');
                                            } [data-theme="dark"]
                                            .image-input-placeholder {
                                                background-image: url('../../../assets/master/media/svg/files/blank-image-dark.svg');
                                            }
                                        </style>
                                    @endif
                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                            <i class="fas fa-pencil fs-7"></i>
                                            <input type="file" name="logo_outlet" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="logo_outlet_remove" />
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
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Outlet</label>
                                        <input type="text" name="outlet_name" class="form-control mb-2" id="outlet_name" placeholder="Masukan Nama Outlet" value="{{ $outlet->outlet_name }}" required />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug</label>
                                                <input type="text" name="slug" class="form-control mb-2" id="slug" style="background-color: #e2e2e2;cursor: not-allowed;" value="{{ $outlet->slug }}" readonly />
                                                <div class="text-muted fs-7" style="color: #31353B!important;">Slug akan otomatis sesuai dengan inputan <strong>Nama Outlet.</strong></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label" style="color:#31353B;font-size: 1rem;font-weight: 700">Kode Outlet</label>
                                                <input type="text" name="outlet_code" class="form-control mb-2" style="background-color: #e2e2e2;cursor: not-allowed;" value="{{ $outlet->outlet_code }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Alamat -->
                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 style="font-size: 18px;">Detail Outlet {{ $outlet->outlet_name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row fv-row">
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Provinsi</label>
                                        <select class="form-select mb-2" name="provinsi" id="prv_id" data-control="select2" data-placeholder="Pilih Provinsi" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach($getProvinsi as $provinsi)
                                                <option value="{{ $provinsi->kode_propinsi }}" {{ $detail->provinsi == $provinsi->kode_propinsi ? 'selected' : '' }}>
                                                    {{ $provinsi->nama_propinsi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kota / Kabupaten</label>
                                        <select class="form-select mb-2" name="kotkab" id="kotkab_id" data-control="select2" data-placeholder="Pilih Kota / Kabupaten" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($getKotaKab as $kotkab)
                                                <option value="{{ $kotkab->kode_kotakab }}" {{ $detail->kota_kabupaten == $kotkab->kode_kotakab ? 'selected' : '' }}>
                                                    {{ $kotkab->nama_kotakab }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row fv-row">
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kecamatan</label>
                                        <select class="form-select mb-2" name="kecamatan" id="kecamatan_id" data-control="select2" data-placeholder="Pilih Kecamatan" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($getKecamatan as $kecamatan)
                                                <option value="{{ $kecamatan->kode_kecamatan }}" {{ $detail->kecamatan == $kecamatan->kode_kecamatan ? 'selected' : '' }}>
                                                    {{ $kecamatan->nama_kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kelurahan</label>
                                        <select class="form-select mb-2" name="kelurahan" id="kelurahan_id" data-control="select2" data-placeholder="Pilih Kelurahan" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($getKelurahan as $kelurahan)
                                                <option value="{{ $kelurahan->kode_kelurahan }}" {{ $detail->kelurahan == $kelurahan->kode_kelurahan ? 'selected' : '' }}>
                                                    {{ $kelurahan->nama_kelurahan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row fv-row">
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode Pos</label>
                                        <select class="form-select mb-2" name="kode_pos" id="kodepos_id" data-control="select2" data-placeholder="Pilih Kode Pos" data-allow-clear="true" required>
                                            <option></option>
                                            @foreach ($getKodePos as $kodepos)
                                                <option value="{{ $kodepos->kodepos }}" {{ $detail->kode_pos == $kodepos->kodepos ? 'selected' : '' }}>
                                                    {{ $kodepos->kodepos }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Url Google Maps</label>
                                        <input type="text" name="link_google_maps" class="form-control mb-2" placeholder="Masukan Url Google Maps" value="{{ $detail->link_google_maps }}" required />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="required form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Alamat Detail</label>
                                <textarea name="alamat_detail" class="form-control mb-2" rows="4" required>{{ $detail->alamat_detail }}</textarea>
                                <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan deskripsi alamat memuat penjelasan detail yang jelas.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Sosmed -->
                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 style="font-size: 18px;">Media Outlet {{ $outlet->outlet_name }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row fv-row">
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">No HP Outlet</label>
                                        <input type="text" name="no_hp_outlet" class="form-control mb-2" id="no_hp_outlet" placeholder="Contoh : 081xxxxx" value="{{ $outlet->no_hp }}" required/>
                                        <div id="textAlert_outlet" class="text-muted fs-7" style="color: #31353B!important;">No HP <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                        <div id="noHpUsedMsg_outlet" class="text-muted fs-7" style="color: #d90429!important; display: none;">No HP Sudah digunakan</div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Facebook Outlet</label>
                                        <input type="text" name="facebook_outlet" class="form-control mb-2" value="{{ $outlet->facebook }}" id="facebook_outlet"/>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Youtube Outlet</label>
                                        <input type="text" name="youtube_outlet" class="form-control mb-2" value="{{ $outlet->youtube }}" id="youtube_outlet"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Whatsapp Outlet</label>
                                        <input type="text" name="whatsapp_outlet" class="form-control mb-2" id="whatsapp_outlet" placeholder="Contoh : 081xxxxx" value="{{ $outlet->whatsapp }}" required/>
                                        <div class="text-muted fs-7" style="color: #31353B!important;">Whatsapp <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Instagram Outlet</label>
                                        <input type="text" name="instagram_outlet" class="form-control mb-2" value="{{ $outlet->instagram }}" id="instagram_outlet"/>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Tiktok Outlet</label>
                                        <input type="text" name="tiktok_outlet" class="form-control mb-2" value="{{ $outlet->tiktok }}" id="tiktok_outlet"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-10 fv-row">
                                    <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Link Website Outlet</label>
                                    <input type="text" name="website_outlet" class="form-control mb-2" id="website_outlet"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.admin_outlet_active') }}" class="css-ca2jq0s">Batalkan</a>
                    <button type="submit" class="css-kl2kd9a">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <!-- slug Outlet -->
    <script type="text/javascript">
        const outlet_name  = document.querySelector('#outlet_name');
        const slug        = document.querySelector('#slug');

        outlet_name.addEventListener('change', function(){
            fetch('/admin/outletSlug?outlet_name=' + outlet_name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <!-- Ajax -->
    <script>
        $(document).ready(function() {
            $("#no_hp_outlet").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            var handleSearchNoHpOutlet = _.debounce(function() {
                var outlet_code        = {{ $outlet->outlet_code }}
                var noHP               = $('#no_hp_outlet').val();
                var noHpUsedMsg_outlet = $('#noHpUsedMsg_outlet');
                var textAlert_outlet   = $('#textAlert_outlet');

                if (noHP.length >= 3) {
                    $.ajax({
                        url: "/admin/validate_Edit_NoHp_outlet",
                        type: "GET",
                        data: {
                            'no_hp': noHP,
                            'outlet_code' : outlet_code
                        },
                        success: function(data) {
                            let isUsed = data && data.isUsed;

                            if (isUsed) {
                                noHpUsedMsg_outlet.css('display', 'block');
                                textAlert_outlet.css('display', 'none');
                            } else {
                                noHpUsedMsg_outlet.css('display', 'none');
                                textAlert_outlet.css('display', 'block');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Error saat pencarian:", error);
                        }
                    });
                } else {
                    noHpUsedMsg_outlet.css('display', 'none');
                    textAlert_outlet.css('display', 'block');
                }
            }, 300);

            $('#no_hp_outlet').on('input', handleSearchNoHpOutlet);
        });
    </script>
    
    <!-- Get Alamat -->
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