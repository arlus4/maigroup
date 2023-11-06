@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Order</h1>
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
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari Produk" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('admin.admin_tambah_order') }}" class="css-kl2kd9a" style="color:#fff!important;line-height: 40px;">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </span>
                                Tambah Order
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableOrder" class="display">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px text-dark">No</th>
                                <th class="min-w-100px text-dark">ID Outlet</th>
                                <th class="min-w-100px text-dark">No Invoice</th>
                                <th class="min-w-100px text-dark">Kategori</th>
                                <th class="min-w-100px text-dark">QTY</th>
                                <th class="min-w-100px text-dark">Amount</th>
                                <th class="min-w-100px text-dark">Progress</th>
                                <th class="min-w-100px text-dark"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($data as $val)
                                <tr>
                                    <td class="align-items-center ps-2">{{ $loop->iteration }}</td>
                                    <td class="align-items-center ps-2">{{ $val->outlet_id }}</td>
                                    <td class="align-items-center ps-2">{{ $val->invoice_no }}</td>
                                    <td class="align-items-center ps-2">
                                        <span class="badge badge-secondary">{{ $val->project_name }}</span>
                                    </td>
                                    <td class="align-items-center ps-2">{{ $val->qty }}</td>
                                    <td class="align-items-center ps-2">Rp {{ number_format($val->amount) }}</td>
                                    <td class="align-items-center ps-2">
                                        @if($val->progress == 0)
                                            <span class="badge badge-light-warning">Pending</span>
                                        @elseif($val->progress == 1)
                                            <span class="badge badge-light-success">Approve</span>
                                        @elseif($val->progress == 2)
                                            <span class="badge badge-light-primary">Deliver</span>
                                        @else
                                            <span class="badge badge-light-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="align-items-center">
                                        <div class="dropdown">
                                            <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Atur
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <button type="button" onclick="modalDetail('{{ $val->invoice_no }}')" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                        <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                        Detail
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                        <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                        Edit
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj">Detail Order</h5>
                    </div>
                    <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-cnm6w2a">
                    <div class="css-bnm3js">
                        <div class="css-vbdw2js">
                            <div class="css-hk23nab">
                                <div class="css-sui2nz d-flex">
                                    <div style="border-left: 4px solid #ffc700;">
                                    </div>
                                    <h5 class="css-gh9fjq" style="margin-left: 6px;">Pending</h5>
                                </div>
                                <div class="css-uwad2ha">
                                    <div class="css-dhj9nda">
                                        <h4 class="css-poh2hs">No Invoice</h4>
                                        <div>
                                            <span class="css-n4js9na" id="id-invoice"></span>
                                        </div>
                                    </div>
                                    <div class="css-dhj9nda">
                                        <p class="css-poh2hs">ID Outlet</p>
                                        <div>
                                            <span class="css-n4js9na" id="id-outlet"></span>
                                        </div>
                                    </div>
                                    <div class="css-dhj9nda">
                                        <p class="css-poh2hs">Tanggal Buat</p>
                                        <div>
                                            <span class="css-n4js9na" id="tanggal-buat"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-kdfh3a">
                                <div class="css-uwad2ha">
                                    <div class="css-jgdh2a">
                                        <h4 class="css-gh9fjq">Detail Produk</h4>
                                    </div>
                                    <div class="css-bn34bal">
                                        <div class="css-pouys8k">
                                            <div class="css-hj7sb2a">
                                                <div class="css-produk-info">
                                                    <img width="46" id="img-produk" class="css-img-produk">
                                                    <div>
                                                        <div class="w-100">
                                                            <span class="badge badge-secondary" style="margin-bottom: 4px;" id="nama-kategori"></span>
                                                        </div>
                                                        <span class="css-nama-prod" id="nama-produk"></span>
                                                        <p class="css-bag-p mb-0" id="qtyAmount"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="css-harga-prod">
                                                <div class="css-total-amount">
                                                    <p class="css-bag-p mb-0" style="color: #212121;">Total Harga</p>
                                                    <h3 style="font-size: 14px;" id="total-amount"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="css-hk23nab" style="padding: 24px 0px;border-top: 8px solid #F0F3F7;border-bottom:0px;">
                                    <div class="css-jgdh2a">
                                        <h4 class="css-gh9fjq">Detail Lainnya</h4>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a">Nama Outlet</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <p class="css-fgusn1a" id="nama-outlet"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="css-i9mf6m">
                                        <div class="css-iopf2sj">
                                            <p class="css-fgusn1a">Alamat</p>
                                            <span>:</span>
                                            <div class="css-fgdh0kl">
                                                <h5 class="css-gh9fjq" style="font-size: 12px;" id="nama-penjual"></h5>
                                                <p class="css-fgusn1a">
                                                    <span id="no-hp">089516769831</span><br>
                                                    <span id="alamat-detail">Jalan Melati 1, Kecataman Bandung Kulon, Kota Bandung, Jawa Barat, 16610.</span>
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
        $(document).ready( function () {
            $('#tableOrder').DataTable();
        });

        function modalDetail(invoice){
            $.ajax({
                type: "GET",
                url: "order-detail/" + invoice,
                success: function(data){
                    console.log(data);

                    const dateFormat    = (date) => {
                        var dateObject    = new Date(date);
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

                        var year          = dateObject.getFullYear();
                        var hour          = dateObject.getHours();
                        var minute        = dateObject.getMinutes();
                        day               = day < 10 ? "0" + day : day; 
                        month             = month < 10 ? "0" + month : month; 
                        var formattedDate = day + ' ' + month + ' ' + year + ', ' + hour+':'+minute+" WIB";

                        return formattedDate;
                    }

                    const rupiah = (number) => {
                        return new Intl.NumberFormat('id-ID', { 
                        style: 'currency', 
                        currency: 'IDR' 
                        }).format(number).replace(/(\.|,)00$/g, '');
                    }

                    $('#modalDetail').modal('show');
                    $('#id-invoice').text(data.invoice_no);
                    $('#id-outlet').text(data.outlet_id);
                    $('#tanggal-buat').text(dateFormat(data.date_created));
                    $('#img-produk').text(data.thumbnail);
                    $('#nama-kategori').text(data.project_name);
                    $('#nama-produk').text(data.nama_produk);
                    $('#qtyAmount').text(data.qty + ' x ' + rupiah(data.amount));
                    $('#total-amount').text(rupiah(data.total_amount));
                    $('#nama-outlet').text(data.nama_outlet);
                    $('#nama-penjual').text(data.name);
                    $('#no-hp').text(data.nomor_telfon);
                    $('#alamat-detail').text(data.alamat_detail + ', Kelurahan ' + data.nama_kelurahan + ', Kecamatan ' + data.nama_kecamatan + ', ' + data.nama_kotakab + ', ' + data.nama_propinsi + ' ' + data.kode_pos + '.');
                },
                error: function(data){
                    error
                }
            });
        }
    </script>
@endsection