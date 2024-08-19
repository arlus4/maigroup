@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Configuration</h1>
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

        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                            </svg>
                        </span>
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <button type="button" class="css-kl2kd9a" style="width: 200px;" data-bs-toggle="modal" data-bs-target="#modalAdd">
                            <span class="svg-icon svg-icon-2">
                                <i class="fas fa-plus-circle text-white"></i>
                            </span>
                            Add Configuration
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableConfiguration">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px text-dark">No</th>
                                <th class="min-w-100px text-dark">Configuration Code</th>
                                <th class="min-w-100px text-dark">Value Code</th>
                                <th class="min-w-100px text-dark">Value</th>
                                <th class="min-w-100px text-dark">Description</th>
                                <th class="min-w-100px text-dark">Sequence</th>
                                <th class="min-w-100px text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Add Configuration -->
        <div class="modal fade" id="modalAdd">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: 8px;">
                    <div class="content-header">
                        <div class="content-title">
                            <h4 class="css-lk3jsp">Add Configuration</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="/admin/setting/config/store_config" method="POST">
                        @csrf
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
                                                    <span class="css-vcnak2s">Semua <strong>Inputan</strong> Wajib Diisi.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Configuration Code</label>
                                        <input type="text" class="form-control code" name="code" id="code" placeholder="opt_month" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Value Code</label>
                                        <input type="text" class="form-control id_value" name="id_value" id="id_value" placeholder="M1" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Value</label>
                                        <input type="text" class="form-control value" name="value" id="value" placeholder="Januari" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Sequence</label>
                                        <input type="text" class="form-control sequence" name="sequence" id="sequence" placeholder="1" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="required fw-semibold fs-6 mb-1">Description</label>
                                        <input type="text" class="form-control description" name="description" id="description" placeholder="Month" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" id="simpan-button" class="css-kl2kd9a">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Configuration -->
        <div class="modal fade" id="modal_edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-edit"></h4>
                    </div>
                    <form action="#" id="form-update">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" class="form-control id" id="id" readonly>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Configuration Code</label>
                                <input type="text" name="code_edit" class="form-control code_edit" id="code_edit" placeholder="opt_month" required>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Value Code</label>
                                <input type="text" name="id_value_edit" class="form-control id_value_edit" id="id_value_edit" placeholder="M1" required>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Value</label>
                                <input type="text" name="value_edit" class="form-control value_edit" id="value_edit" placeholder="Januari" required>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Sequence</label>
                                <input type="text" name="sequence_edit" class="form-control sequence_edit" id="sequence_edit" placeholder="1" required>
                            </div>
                            <div class="form-group mb-3">
                                <label style="color: #31353B!important;font-weight: 600;">Description</label>
                                <input type="text" name="description_edit" class="form-control description_edit" id="description_edit" placeholder="Month" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="close-button" class="css-ca2jq0s" style="width: 90px;" data-bs-dismiss="modal">
                                Batalkan
                            </button>
                            <button type="submit" id="update" class="css-kl2kd9a">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#tableConfiguration').DataTable({
            processing: true,
            serverSide: false,
            ajax: "/admin/setting/config/get_dataConfig",
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'code' },
                { data: 'id_value' },
                { data: 'value' },
                { data: 'description' },
                { data: 'sequence' },
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
            ],
        });
    });

    function editCat(id) {
        $.ajax({
            type: 'GET',
            url: '/admin/setting/config/edit_config',
            data: {
                id: id
            },
            success: function(data) {
                $('#modal_edit').modal('show');
                $('#modal-title-edit').text('Edit Configuration');
                $('#id').val(data.id);
                $('#code_edit').val(data.code);
                $('#id_value_edit').val(data.id_value);
                $('#value_edit').val(data.value);
                $('#description_edit').val(data.description);
                $('#sequence_edit').val(data.sequence);
                $('#update').text('Simpan Perubahan');
            },
            error: function (xhr, status, error) {
                toastr.error("Terjadi kesalahan. Silakan coba lagi.");
            }
        })
    }

    // Action Update
    $(document).ready(function() {
        $('#form-update').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#modal_edit').modal('hide');
            $.ajax({
                type: 'POST',
                url: "/admin/setting/config/update_config",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#tableConfiguration').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Terjadi kesalahan. Silakan coba lagi.");
                }
            })
        })
    });
</script>


@endsection