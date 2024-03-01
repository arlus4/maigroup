@extends('owner/layout-sidebar/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Outlet Anda</h1>
                </div>
                <a href="/owner/createOutlet" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus-circle text-white"></i>
                    </span>
                    Tambah Outlet Baru
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableUserOutlet">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">Info Outlet</th>
                                    <th class="min-w-100px text-dark">Maps</th>
                                    <th class="min-w-100px text-dark">Status</th>
                                    <th class="text-dark">&nbsp;</th>
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

    <!-- Modal Detail User Outlet -->
    <div class="modal fade" id="detailOutlet">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj">Detail Outlet</h5>
                    </div>
                    <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-cnm6w2a">
                    <div class="css-bnm3js">
                        <div class="css-vbdw2js">
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
                                            <p class="css-fgusn1a" style="width: 160px;">ID Outlet</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <p class="css-fgusn1a" id="idOutlet"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a" style="width: 160px;">Kategori Outlet</p>
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
            $('#tableUserOutlet').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/owner/get_data_listOutlet",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
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
                                            <span class="me-4">Kategori :</span>
                                            <span>${row.nama_category}</span>
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
                        data: "Alamat",
                        render: function(data, type, row) {
                            var html = `<div class="d-flex flex-column">`;

                            if (row.map_location === null) {
                                html += `<span class="text-gray-800 mb-1">Tidak Ada</span>`;
                            } else {
                                html += `<a href="${row.map_location}" target="_blank" class="btn btn-primary"><i class="fa-solid fa-map-location-dot"></i> Maps</a>`;
                            }
                            html += `</div>`;

                            return html;
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = '';
                            if (row.is_verified === "0") {
                                status = '<span class="badge badge-warning">Waiting Approved</span>';
                            } else {
                                status = '<span class="badge badge-success">Active</span>';
                            }
                            return status;
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
                                                <button type="button" class="dropdown-item p-2 ps-5" style="cursor: pointer" onclick="detailOutlet('${row.slug}')">
                                                    <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                    Detail
                                                </button>
                                            </li>
                                            <li>
                                                <button onclick="window.location.href = 'editOutlet/${row.slug}'" class="dropdown-item p-2 ps-5" style="cursor: pointer">
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

        function detailOutlet(slug){
            $.ajax({
                url: "detail_user_outlet/" + slug,
                type: "GET",
                success: function (data) {

                    $('#namaOutlet').text(data.nama_outlet || '-');
                    $('#idOutlet').text(data.outlet_id || '-');
                    $('#namaKategori').text(data.nama_category || '-');
                    $('#noHpBawah').text(data.no_hp || '-');
                    
                    var alamatDetail = (data.alamat_detail ? data.alamat_detail : 'Alamat Detail Belum Dicantumkan') + ', Kecamatan ' + (data.nama_kecamatan ? data.nama_kecamatan : 'Belum Dicantumkan') + ', Kota ' + (data.nama_kotakab ? data.nama_kotakab : 'Belum Dicantumkan') + ', Provinsi ' + (data.nama_propinsi ? data.nama_propinsi : 'Belum Dicantumkan') + ', Kode Pos ' + (data.kodepos ? data.kodepos : 'Belum Dicantumkan');
                    $('#alamatDetail').text(alamatDetail);

                    $('#detailOutlet').modal('show');
                },
                error: function(error){

                }
            });
        }
    </script>

@endsection