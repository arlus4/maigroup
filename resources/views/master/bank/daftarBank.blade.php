@extends('layout-master/app')

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Bank</h1>
                </div>
                <button type="button" class="css-kl2kd9a" style="width: 200px;" onclick="addData()">
                    <span class="svg-icon svg-icon-2">
                        <i class="fas fa-plus-circle text-white"></i>
                    </span>
                    Tambah Bank
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableDataBank">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px text-dark">Info Bank</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($dataBank as $val)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="{{ asset(''.$val->path_icon_bank) }}" class="w-100">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-800 mb-1">{{ $val->nama_bank }}</span>
                                            <span class="fw-semibold">No.Rek : {{ $val->nomor_rekening }}</span>
                                        </div>
                                    </td>
                                    <td class="align-items-center">
                                        <div class="dropdown">
                                            <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" fdprocessedid="wbxgff">
                                                Atur
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <button class="dropdown-item p-2 ps-5 cursor-pointer" onclick="editData('{{ $val->id }}')">
                                                        <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item p-2 ps-5 cursor-pointer" onclick="deleteData('{{ $val->id }}')">
                                                        <i style="color:#181C32;" class="fas fa-trash me-2"></i>
                                                        Hapus
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
                        <input type="hidden" name="idBank" id="idBank">
                        <label style="color: #31353B!important;font-weight: 600;">Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control nama_bank" id="nama_bank" placeholder="Input Nama Bank" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">No. Rekening</label>
                        <input type="text" name="nomor_rekening" class="form-control nomor_rekening" id="nomor_rekening" placeholder="Input Nomor Rekening" required>
                    </div>
                    <div class="form-group mb-3">
                        <label style="color: #31353B!important;font-weight: 600;">Icon Bank</label>
                        <input type="file" name="icon_bank" class="form-control icon_bank" id="icon_bank" accept=".png, .jpg, .jpeg" required>
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
@endsection

@section('script')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#form-save').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $('#modal_add').modal('hide');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.admin_store_update_bank') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#tableDataBank').load(' #tableDataBank');
                    },
                    error: function(xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
            })
        });

        function addData(){
            $('#idBank').val('');
            $('#modal_add').modal('show');
            $('#modal-title').text('Tambah Bank');
            $('#nama_bank').val('');
            $('#nomor_rekening').val('');
            $('#icon_bank').val('');
            $('#save').text('Simpan');
        }

        function editData(id) {
            $('#icon_bank').val('');
            $.ajax({
                type: 'GET',
                url: '{{ route("admin.admin_edit_bank") }}',
                data: {
                    id: id
                },
                success: function(data) {
                    var linkInfo = "{{ asset('storage/icon_bank') }}"
                    $('#idBank').val(data.id);
                    $('#modal_add').modal('show');
                    $('#modal-title').text('Edit Data Bank');
                    $('#nama_bank').val(data.nama_bank);
                    $('#nomor_rekening').val(data.nomor_rekening);
                    $('#save').text('Simpan Perubahan');
                },
                error: function (xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        }

        function deleteData(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda ingin hapus data bank ini ?",
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
                    url: '{{ route("admin.admin_destroy_bank") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id : id
                    },
                    success: function(response) {
                        toastr[response.status](response.message);
                        $('#tableDataBank').load(' #tableDataBank');
                    },
                    error: function (xhr, status, error) {
                        toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                    }
                })
                }
            })
        }
    </script>
@endsection

