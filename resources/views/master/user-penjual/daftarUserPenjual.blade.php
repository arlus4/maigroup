@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar User Penjual</h1>
                </div>
                <a href="{{ route('admin.admin_tambah_user_penjual') }}" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus-circle text-white"></i>
                    </span>
                    Tambah User Penjual
                </a>
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableUserPenjual">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Info Penjual</th>
                                    <th class="min-w-100px text-dark">Info Outlet</th>
                                    <th class="min-w-100px text-dark">Aktif</th>
                                    <th class="text-dark"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail User Penjual -->
    <div class="modal fade" id="detailUserPenjual">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj">Detail Penjual & Outlet</h5>
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
                                    <h5 class="css-gh9fjq" style="margin-left: 6px;">Informasi User Penjual</h5>
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
    <script>
        $(document).ready(function() {
            $('#tableUserPenjual').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/admin/get_data_user_penjual",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { 
                        data: 'name',
                        render: function(data, type, row) {
                            var imagePath = row.avatar ? row.avatar : '/avatar.png';
                            return `<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="{{ asset('storage/user_penjual/avatar/${imagePath}') }}" class="w-100"/>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.name}</span>
                                            <span>${row.email}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'nama_outlet',
                        render: function(data, type, row) {
                            var html = `<div class="d-flex flex-column">`;

                            if (row.outlet_id === null) {
                                html += `<span class="text-gray-800 mb-1">Tidak Ada</span>`;
                            } else {
                                html += `<span class="text-gray-800 mb-1">${row.nama_outlet}</span>
                                        <div class="d-flex css-fcabk9sn">
                                            <span class="me-4">ID Outlet :</span>
                                            <span>${row.outlet_id}</span>
                                        </div>
                                        <div class="d-flex css-fcabk9sa">
                                            <span class="me-4">Kuota Point :</span>
                                            <span>${row.kuota_point}</span>
                                        </div>`;
                            }
                            html += `</div>`;

                            return html;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var checked = row.is_active == 1 ? 'checked' : '';
                            return `<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input type="checkbox" class="form-check-input ubah-toggle" name="notifications" data-user-id="${row.idUserLogin}" ${checked} style="cursor: pointer;">
                                    </div>`;
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
                                                <button type="button" class="dropdown-item p-2 ps-5" style="cursor: pointer" onclick="detailUserPenjual('${row.username}')">
                                                    <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="window.location.href = 'edit-user-penjual/${row.username}'" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                    <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                    Edit
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

        function detailUserPenjual(username){
            $.ajax({
                url: "detail-user-penjual/" + username,
                type: "GET",
                success: function (data){
                    const formatTglSaja = (date) => {
                        var dateObject  = new Date(date);
                        var year        = dateObject.getFullYear();
                        var day         = dateObject.getDate();
                        var month       = dateObject.getMonth();

                        var monthsArray = [
                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        ];

                        day                 = day < 10 ? "0" + day : day; 
                        month               = monthsArray[month];
                        var formattedDate   = day + ' ' + month + ' ' + year;

                        return formattedDate;
                    }

                    var defaultImagePath    = '{{ asset("storage/user_penjual/avatar/avatar.png") }}';
                    var imagePath           = data.avatar ? '{{ asset("storage/user_penjual/avatar") }}/' + data.avatar : defaultImagePath;
                    
                    $('#imgUser').attr('src', imagePath);
                    $('#namaUser').text(data.name);
                    $('#noNIK').text(data.nomor_ktp || '-');
                    $('#tglLahir').text(formatTglSaja(data.tanggal_lahir));
                    $('#jenisKelamin').text(data.jenis_kelamin === "P" ? 'Pria' : 'Wanita');
                    $('#namaOutlet').text(data.nama_outlet || '-');
                    $('#namaKategori').text(data.project_name || '-');
                    $('#noHpBawah').text(data.no_hp || '-');
                    
                    var alamatDetail = data.alamat_detail + ', Kecamatan ' + data.nama_kecamatan + ', ' + data.nama_kotakab + ', ' + data.nama_propinsi + ', ' + data.kode_pos;
                    $('#alamatDetail').text(alamatDetail);

                    $('#detailUserPenjual').modal('show');
                },
                error: function(error){

                }
            });
        }
    </script>

@endsection