@extends('owner/layout-sidebar/app')

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
                <form action="/owner/storeOutlet" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2 style="font-size: 18px;">Informasi Outlet</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row fv-row">
									            <h2 style="font-size: 1rem;">Foto Outlet</h2>
                                                <div class="col-md-6">
                                                    <style>.image-input-placeholder { background-image: url('../../../assets/media/svg/files/blank-image.svg'); } [data-theme="dark"] .image-input-placeholder { background-image: url('../../../assets/media/svg/files/blank-image-dark.svg'); }</style>
                                                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                        <div class="image-input-wrapper w-150px h-150px"></div>
                                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Gambar">
                                                            <i class="fas fa-pencil fs-7"></i>
                                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" required/>
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
                                                        <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Outlet</label>
                                                        <input type="text" name="nama_outlet" class="form-control mb-2" id="nama_outlet" placeholder="Masukan Nama Outlet Anda" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Slug</label>
                                                                <input type="text" name="slug" class="form-control mb-2" id="slug" style="background-color: #e2e2e2;cursor: not-allowed;" readonly>
                                                                <div class="text-muted fs-7" style="color: #31353B!important;">Slug akan otomatis sesuai dengan inputan <strong>Nama Outlet.</strong></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-10 fv-row">
                                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">No HP</label>
                                                                <input type="text" name="no_hp" class="form-control mb-2" id="no_hp" placeholder="Contoh : 081xxxxx" required/>
                                                                <div id="textAlert" class="text-muted fs-7" style="color: #31353B!important;">No HP <strong style="font-size: 11px;">Wajib Diisi</strong>, ya.</div>
                                                                <div id="noHpUsedMsg" class="text-muted fs-7" style="color: #d90429!important; display: none;">No HP Sudah digunakan</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kategori Outlet</label>
                                                <div class="input-group">
                                                    <select class="form-select mb-2" data-control="select2" data-placeholder="Pilih Kategori" data-allow-clear="true" name="outlet_category" required>
                                                        <option></option>
                                                        @foreach($getKategori as $kategori)
                                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Provinsi</label>
                                                        <select class="form-select mb-2" name="provinsi_outlet" id="prv_id_outlet" data-control="select2" data-placeholder="Pilih Provinsi" data-allow-clear="true" required>
                                                            <option></option>
                                                            @foreach($getProvinsi as $provinsi)
                                                                <option value="{{ $provinsi->kode_propinsi }}">{{ $provinsi->nama_propinsi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kota / Kabupaten</label>
                                                        <select class="form-select mb-2" name="kotkab_outlet" id="kotkab_id_outlet" data-control="select2" data-placeholder="Pilih Kota / Kabupaten" data-allow-clear="true" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kecamatan</label>
                                                        <select class="form-select mb-2" name="kecamatan_outlet" id="kecamatan_id_outlet" data-control="select2" data-placeholder="Pilih Kecamatan" data-allow-clear="true" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-10 fv-row">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kelurahan</label>
                                                        <select class="form-select mb-2" name="kelurahan_outlet" id="kelurahan_id_outlet" data-control="select2" data-placeholder="Pilih Kelurahan" data-allow-clear="true" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Kode Pos</label>
                                                <select class="form-select mb-2" name="kode_pos_outlet" id="kodepos_id_outlet" data-control="select2" data-placeholder="Pilih Kode Pos" data-allow-clear="true" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Alamat Detail</label>
                                                <textarea name="alamat_detail_outlet" class="form-control mb-2" rows="4"></textarea>
                                                <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan deskripsi alamat memuat penjelasan detail yang jelas.</div>
                                            </div> <br>
                                            <div>
                                                <label class="form-label mt-5" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Map Location</label>
                                                <textarea name="map_location_outlet" class="form-control mb-2" rows="4"></textarea>
                                                <div class="text-muted fs-7" style="color: #31353B!important;">Pastikan map location sesuai dengan google maps.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="#" class="css-ca2jq0s">Batalkan</a>
                            <button type="submit" class="css-kl2kd9a">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
	<!-- slug Outlet -->
    <script type="text/javascript">
        const nama_outlet = document.querySelector('#nama_outlet');
        const slug        = document.querySelector('#slug');

        nama_outlet.addEventListener('change', function(){
            fetch('/owner/outletSlug?nama_outlet=' + nama_outlet.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

    <!-- Ajax -->
    <script>
        $(document).ready(function() {
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
                var noHP         = $('#no_hp').val();
                var noHpUsedMsg  = $('#noHpUsedMsg');
                var textAlert    = $('#textAlert');

                if (noHP.length >= 3) {
                    $.ajax({
                        url: "/owner/validateNoHp",
                        type: "GET",
                        data: { 'no_hp': noHP },
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

            $("#prv_id_outlet").change(function() {
                var provinsi_id = $(this).val();
                $.ajax({
                    url: '/get_data_kotakab/' + provinsi_id ,
                    type: "GET",
                    data: {
                        provinsi_id: provinsi_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kotakab_id = $("#kotkab_id_outlet");
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

            $("#kotkab_id_outlet").change(function() {
                var kotakab_id = $(this).val();
                $.ajax({
                    url: '/get_data_kecamatan/' + kotakab_id ,
                    type: "GET",
                    data: {
                        kotakab_id: kotakab_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kecamatan_id = $("#kecamatan_id_outlet");
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

            $("#kecamatan_id_outlet").change(function() {
                var kecamatan_id = $(this).val();
                $.ajax({
                    url: '/get_data_kelurahan/' + kecamatan_id ,
                    type: "GET",
                    data: {
                        kecamatan_id: kecamatan_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kelurahan_id = $("#kelurahan_id_outlet");
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

            $("#kelurahan_id_outlet").change(function() {
                var kelurahan_id = $(this).val();
                $.ajax({
                    url: '/get_data_kodepos/' + kelurahan_id ,
                    type: "GET",
                    data: {
                        kelurahan_id: kelurahan_id
                    },
                    dataType: "json",
                    success: function(data) {
                        var kodepos_id = $("#kodepos_id_outlet");
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