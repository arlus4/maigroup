@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Kategori Brand</h1>
                </div>
                <button type="button" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;" onclick="addData()">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus-circle text-white"></i>
                    </span>
                    Tambah Kategori Brand
                </button>
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
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableCategoryBrand">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Kategori</th>
                                    <th class="min-w-100px text-dark">Description</th>
                                    <th class="min-w-100px text-dark">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori Brand -->
    <div class="modal fade" id="modal_add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-save">
                    @csrf
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Nama Kategori Brand</label>
                        <input type="text" name="nama_category" class="form-control nama_category" id="nama_category" placeholder="Input Nama Kategori Brand" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Slug</label>
                        <input type="text" name="slug" class="form-control form-control-solid slug" id="slug" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Deskripsi Kategori</label>
                        <textarea name="description" class="form-control description" id="description" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                        Batalkan
                    </button>
                    <button type="submit" id="save" class="css-kl2kd9a">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori Brand -->
    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-edit"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" id="form-update">
                    @csrf
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Code Kategori Brand</label>
                        <input type="text" name="code_category" class="form-control form-control-solid code_category" id="code_category" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Nama Kategori Brand</label>
                        <input type="text" name="nama_category_edit" class="form-control nama_category_edit" id="nama_category_edit" placeholder="Input Nama Kategori Brand" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Slug</label>
                        <input type="text" name="slug_edit" class="form-control form-control-solid slug_edit" id="slug_edit" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Deskripsi Kategori</label>
                        <textarea name="description_edit" class="form-control description_edit" id="description_edit" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                        Batalkan
                    </button>
                    <button type="submit" id="update" class="css-kl2kd9a">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Kategori Brand -->
    <div class="modal fade" id="detailUserOwner">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj">Detail Owner & Outlet</h5>
                    </div>
                    <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-cnm6w2a">
                    <div class="css-bnm3js">
                        <div class="css-vbdw2js">
                            <div class="css-hk23nab">
                                <div class="css-sui2nz d-flex">
                                    <div style="border-left: 4px solid #b1c5cd;">
                                    </div>
                                    <h5 class="css-gh9fjq" style="margin-left: 6px;">Informasi Kategori Brand</h5>
                                </div>
                                <div class="css-uwad2ha">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="img-fluid rounded" id="imgUser" src="{{ asset('assets/images/avatar.png') }}">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="css-i9mf6m mt-0">
                                                <div class="css-iopf2sj mb-1">
                                                    <p class="css-fgusn1a">Nama</p>
                                                    <span>:</span>
                                                    <div class="css-fgdh0kl">
                                                        <p class="css-fgusn1a" id="namaUser"></p>
                                                    </div>
                                                </div>
                                                <div class="css-iopf2sj mb-1">
                                                    <p class="css-fgusn1a">NIK</p>
                                                    <span>:</span>
                                                    <div class="css-fgdh0kl">
                                                        <p class="css-fgusn1a" id="noNIK"></p>
                                                    </div>
                                                </div>
                                                <div class="css-iopf2sj mb-1">
                                                    <p class="css-fgusn1a">Tanggal Lahir</p>
                                                    <span>:</span>
                                                    <div class="css-fgdh0kl">
                                                        <p class="css-fgusn1a" id="tglLahir"></p>
                                                    </div>
                                                </div>
                                                <div class="css-iopf2sj mb-1">
                                                    <p class="css-fgusn1a">Jenis Kelamin</p>
                                                    <span>:</span>
                                                    <div class="css-fgdh0kl">
                                                        <p class="css-fgusn1a" id="jenisKelamin"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-kdfh3a">
                                <div class="css-hk23nab" style="padding: 15px 0px;border-bottom:0px;">
                                    <div class="css-jgdh2a">
                                        <h4 class="css-gh9fjq">Informasi Outlet</h4>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a" style="width: 160px;">Nama Outlet</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <p class="css-fgusn1a" id="namaOutlet"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a" style="width: 160px;">Kategori Projek Outlet</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <p class="css-fgusn1a" id="namaKategori"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a" style="width: 160px;">Alamat</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <p class="css-fgusn1a">
                                                    <span id="noHpBawah"></span><br>
                                                    <span id="alamatDetail"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
	<!-- slug add -->
    <script type="text/javascript">
        const nama_category = document.querySelector('#nama_category');
        const slug          = document.querySelector('#slug');

        nama_category.addEventListener('change', function(){
            fetch('/admin/catBrandSlug?nama_category=' + nama_category.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>

	<!-- slug edit -->
    <script type="text/javascript">
        const nama_category_edit = document.querySelector('#nama_category_edit');
        const slug_edit          = document.querySelector('#slug_edit');

        nama_category_edit.addEventListener('change', function(){
            fetch('/admin/catBrandSlug?nama_category=' + nama_category_edit.value)
            .then(response => response.json())
            .then(data => slug_edit.value = data.slug)
        });
    </script>
    
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#tableCategoryBrand').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/get_data_brandCategory",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.brand_category_name}</span>
                                            <span>${row.brand_category_code}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var description = '';
                            if (row.brand_category_description == null) {
                                description += '-';
                            } else {
                                description += row.brand_category_description;
                            }
                            return description;
                        }
                    },
                    {
                        data: 'atur',
                        render: function(data, type, row) {
                            return `<div class="dropdown">
                                        <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Atur
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                                            <li>
                                                <button onclick="editCat(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="deleteCat(${row.id})" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-trash me-2"></i>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    }
                ]
            });

            $(document).on('change', '.ubah-toggle', function() {
                const userId = $(this).data('user-id');
                const isChecked = $(this).prop('checked');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'update-toggle/' + userId,
                    type: 'POST',
                    data: {
                        enabled: isChecked
                    },
                    success: function(response) {
                        toastr.success(response.message);

                        setTimeout(function() {
                        }, 2000);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#form-save').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_add').modal('hide');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin.admin_store_brand_category') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // toastr[response.status](response.message);
                        $('#tableCategoryBrand').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi. " + xhr.status + "." + xhr.statusText + "." + xhr.responseText);
                    }
                })
            })
        });

        function addData() {
            $('#modal_add').modal('show');
            $('#modal-title').text('Tambah Kategori Baru');
            $('#nama_category').val('');
            $('#slug').val('');
            $('#description').val('');
            $('#save').text('Simpan');
        }

        $(document).ready(function() {
            $('#form-update').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_edit').modal('hide');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin.admin_update_brand_category') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // toastr[response.status](response.message);
                        // $('#tableCategoryBrand').load(' #tableCategoryBrand');
                        $('#tableCategoryBrand').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function editCat(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/edit_brandCategory',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#code_category').val(data.brand_category_code);
                    $('#modal_edit').modal('show');
                    $('#modal-title-edit').text('Edit Data Kategori Brand');
                    $('#nama_category_edit').val(data.brand_category_name);
                    $('#slug_edit').val(data.slug);
                    $('#description_edit').val(data.brand_category_description);
                    $('#update').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function deleteCat(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda Ingin Menghapus Data Kategori ini ?",
                icon: 'warning',
                cancelButtonText: "Batal",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Ya, saya yakin!`
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.admin_delete_brand_category") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id : id
                    },
                    success: function(response) {
                        toastr[response.status](response.message);
                        // $('#tableCategoryBrand').DataTable().ajax.reload();
                        $('#tableCategoryBrand').load(' #tableCategoryBrand');
                    },
                    error: function (xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
                }
            })
        }

        // function detailUserOwner(username){
        //     $.ajax({
        //         url: "detail-user-owner/" + username,
        //         type: "GET",
        //         success: function (data){
        //             const formatTglSaja = (date) => {
        //                 var dateObject  = new Date(date);
        //                 var year        = dateObject.getFullYear();
        //                 var day         = dateObject.getDate();
        //                 var month       = dateObject.getMonth();

        //                 var monthsArray = [
        //                     "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        //                     "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        //                 ];

        //                 day                 = day < 10 ? "0" + day : day; 
        //                 month               = monthsArray[month];
        //                 var formattedDate   = day + ' ' + month + ' ' + year;

        //                 return formattedDate;
        //             }

        //             var defaultImagePath    = '{{ asset("storage/user_owner/avatar/avatar.png") }}';
        //             var imagePath           = data.avatar ? '{{ asset("storage/user_owner/avatar") }}/' + data.avatar : defaultImagePath;
                    
        //             $('#imgUser').attr('src', imagePath);
        //             $('#namaUser').text(data.name);
        //             $('#noNIK').text(data.nomor_ktp || '-');
        //             $('#tglLahir').text(formatTglSaja(data.tanggal_lahir));
        //             $('#jenisKelamin').text(data.jenis_kelamin === "P" ? 'Pria' : 'Wanita');
        //             $('#namaOutlet').text(data.nama_category || '-');
        //             $('#namaKategori').text(data.project_name || '-');
        //             $('#noHpBawah').text(data.no_hp || '-');
                    
        //             var alamatDetail = (data.alamat_detail ? data.alamat_detail : 'Alamat Detail Belum Dicantumkan') + ', Kecamatan ' + (data.nama_kecamatan ? data.nama_kecamatan : 'Belum Dicantumkan') + ', Kota ' + (data.nama_kotakab ? data.nama_kotakab : 'Belum Dicantumkan') + ', Provinsi ' + (data.nama_propinsi ? data.nama_propinsi : 'Belum Dicantumkan') + ', Kode Pos ' + (data.kode_pos ? data.kode_pos : 'Belum Dicantumkan');
        //             $('#alamatDetail').text(alamatDetail);

        //             $('#detailUserOwner').modal('show');
        //         },
        //         error: function(error){

        //         }
        //     });
        // }
    </script>
@endsection