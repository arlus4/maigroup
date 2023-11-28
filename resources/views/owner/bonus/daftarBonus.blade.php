@extends('owner/layout-sidebar/app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar {{ $title }}</h1>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="menu menu-column menu-gray-600 menu-active-primary menu-hover-light-primary menu-here-light-primary menu-show-light-primary fw-semibold mb-3" data-kt-menu="true" id="menu">
                    <div class="menu">
                        <div class="menu-item">
                            <a class="menu-link css-hdk82bsa {{ Request::routeIs('owner.owner_bonus') ? 'active' : '' }}" href="{{ route('owner.owner_bonus') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-exchange"></i>
                                </span>
                                <span class="menu-title">Pembeli Claim</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link css-hdk82bsa {{ Request::routeIs('owner.owner_bonus_gift') ? 'active' : '' }}" href="{{ route('owner.owner_bonus_gift') }}">
                                <span class="menu-icon">
                                    <i class="fas fa-gift"></i>
                                </span>
                                <span class="menu-title">Pembeli Gift</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle fs-6 gy-5" id="tablePembeliClaim" class="display">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px text-dark">No</th>
                                        <th class="min-w-150px text-dark">Kode Voucher</th>
                                        <th class="min-w-100px text-dark">Info Pembeli</th>
                                        <th class="min-w-100px text-dark">Status Claim</th>
                                        <th class="min-w-100px text-dark">Status Gift</th>
                                        <th class="min-w-150px text-dark">Tanggal Claim</th>
                                        <th class="min-w-150px text-dark">Tanggal Gift</th>
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
    </div>
@endsection


@section('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            const formatTglSaja  = (date) => {
                var dateObject    = new Date(date);
                var year          = dateObject.getFullYear();
                var day           = dateObject.getDate();
                var month         = dateObject.getMonth();

                switch(month) {
                    case 0: month = "Januari"; break;
                    case 1: month = "Februari"; break;
                    case 2: month = "Maret"; break;
                    case 3: month = "April"; break;
                    case 4: month = "Mei"; break;
                    case 5: month = "Juni"; break;
                    case 6: month = "Juli"; break;
                    case 7: month = "Agustus"; break;
                    case 8: month = "September"; break;
                    case 9: month = "Oktober"; break;
                    case 10: month = "November"; break;
                    case 11: month = "Desember"; break;
                }

                day               = day < 10 ? "0" + day : day; 
                month             = month < 10 ? "0" + month : month; 
                var formattedDate = day + ' ' + month + ' ' + year;

                return formattedDate;
            }
            $('#tablePembeliClaim').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "/owner/bonus/{{ $url }}",
                    dataType: "JSON",
                },
                language: {
                    processing: "Loading..."
                },
                columns: [
                    { 
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { 
                        data: "voucher_code" 
                    },
                    {
                        data: 'nomor_telfon',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 mb-1">${row.name}</span>
                                            <span>${row.nomor_telfon}</span>
                                        </div>
                                    </div>`;
                        }
                    },
                    {
                        data: 'is_claim',
                        render: function(data, type, row) {
                            var status = '';
                            switch (row.is_claim) {
                                case "0":
                                    status = '<span class="badge badge-light-danger">Bonus belum diclaim</span>';
                                    break;
                                case "1":
                                    status = '<span class="badge badge-light-success">Bonus sudah diclaim</span>';
                                    break;
                            }
                            return status;
                        }
                    },
                    {
                        data: 'is_gift',
                        render: function(data, type, row) {
                            var status = '';
                            switch (row.is_gift) {
                                case "0":
                                    status = '<span class="badge badge-light-danger">Bonus belum diterima</span>';
                                    break;
                                case "1":
                                    status = '<span class="badge badge-light-success">Bonus sudah diterima</span>';
                                    break;
                            }
                            return status;
                        }
                    },
                    {
                        data: 'date_claim',
                        render: function(data, type, row) {
                            var status = '';
                            if (row.date_claim == null) {
                                status = '<span class="badge badge-light-danger">----</span>';
                            } else {
                                // Pastikan untuk menggunakan backticks di sini
                                status = `<span class="text-gray-800">${formatTglSaja(row.date_claim)}</span>`; 
                            }
                            return status;
                        }
                    },
                    {
                        data: 'date_gift',
                        render: function(data, type, row) {
                            var status = '';
                            if (row.date_gift == null) {
                                status = '<span class="badge badge-light-danger">----</span>';
                            }else{
                                status = `<span class="text-gray-800">${formatTglSaja(row.date_gift)}</span>`;
                            }
                            return status;
                        }
                    }
                ]
            });
        });
    </script>
@endsection