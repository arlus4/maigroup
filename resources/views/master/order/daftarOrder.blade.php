@extends('layout-master/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar {{ $title }}</h1>
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

            <!--begin::Menu-->
            @include('layout-master.tab_menuOrder')
            <!--end::Menu-->

            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-body border-0 py-4">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tableOrder" class="display">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">No</th>
                                    <th class="min-w-100px text-dark">ID Outlet</th>
                                    <th class="min-w-100px text-dark">No Invoice</th>
                                    <th class="min-w-100px text-dark">Amount</th>
                                    <th class="min-w-100px text-dark">Progress</th>
                                    <th class="min-w-100px text-dark">Ongkos Kirim</th>
                                    <th class="min-w-100px text-dark">Tanggal Pemesanan</th>
                                    <th class="min-w-100px text-dark"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Ongkir -->
    <div class="modal fade" id="modalUpdateOngkir">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-dtu37sh">
                    <div class="css-cfn3ksa">
                        <h5 class="css-fnm3aj" style="text-align: center;">Detail Order</h5>
                    </div>
                    <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-cnm6w2a">
                    <div class="css-bnm3js">
                        <div class="css-vbdw2js">
                            <form action="/admin/store_ongkir" method="POST">
                                @csrf
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
                                                <input type="hidden" id="invoice_id" name="invoice_no">
                                            </div>
                                        </div>
                                        <div class="css-dhj9nda">
                                            <p class="css-poh2hs">Sub Total</p>
                                            <div>
                                                <span class="css-n4js9na" id="total-amount"></span>
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
                                        </div>
                                        <div class="css-bn34bal">
                                            <div class="css-pouys8k">
                                                <div class="css-hj7sb2a">
                                                    <div class="css-produk-info">
                                                        <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Input Ongkos Kirim</label>
                                                    </div>
                                                </div>
                                                <div class="css-harga-prod">
                                                    <div class="css-total-amount">
                                                        <input type="text" name="ongkir" id="ongkir" class="form-control mb-6" required/>
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
                                                        <span id="no-hp"></span><br>
                                                        <span id="alamat-detail"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Approve Order -->
    <div class="modal fade" id="modalApproveOrder">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="content-header">
                    <div class="content-title">
                        <h4 class="css-lk3jsp" style="text-align: center;">Terima Pembayaran</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="css-flj2ej">
                    <div class="css-fjkpo0ma">
                        <div class="css-wj23sk">
                            <form action="" method="POST" id="approveOrder">
                                @csrf
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <input type="hidden" name="id_invoice" id="id_invoice">
                                    <div class="col-md-12 fv-row" >
                                        <span style="font-size: 15px">
                                            Apakah Anda yakin untuk Menerima Pembayaran dengan nomor invoice <span id="nomor_invoice"></span>?
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="css-kl2kd9a">
                                        <span class="indicator-label">Terima Pembayaran</span>
                                    </button>
                                </div>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Deliver Order -->
    <div class="modal fade" id="modalDeliverOrder">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="content-header">
                    <div class="content-title">
                        <h4 class="css-lk3jsp" style="text-align: center;">Kirim Pesanan</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span style="font-size: 30px;color: grey;" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="css-flj2ej">
                    <div class="css-fjkpo0ma">
                        <div class="css-wj23sk">
                            <form action="" method="POST" id="deliverOrder">
                                @csrf
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <input type="hidden" name="invoice_number" id="invoice_number">
                                    <div class="col-md-12 fv-row" >
                                        <strong><p style="text-align: center;">Mohon Periksa Kembali Pesanan yang dibuat</p></strong> 
                                        <span style="font-size: 15px">
                                            <p style="text-align: center;">Apakah Anda yakin untuk Mengirim Pesanan dengan nomor invoice <span id="invoice_nomor"></span>?</p>
                                        </span>
                                        <div class="mb-10 fv-row">
                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nomor Resi</label>
                                            <input type="text" name="no_resi" class="form-control mb-2" required>
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Nama Ekspedisi</label>
                                            <input type="text" name="nama_ekspedisi" class="form-control mb-2" required>
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Tanggal Pengiriman</label>
                                            <input type="date" name="tanggal_pengiriman" class="form-control mb-2" id="tanggal_pengiriman" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="css-ca2jq0s" style="width: 80px;" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="css-kl2kd9a">
                                        <span class="indicator-label">Kirim Pesanan</span>
                                    </button>
                                </div>
                            </form>
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
            var dataTable = $('#tableOrder').DataTable({
                "processing": true,
                "serverSide": false,
                ajax: {
                    url: "/admin/order/{{ $url }}",
                    dataType: "json",
                },
                columns: [
                    { 
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: "outlet_id" },
                    { data: "invoice_no" },
                    { data: "total", 
                        render: function(data, type, full, meta) {
                            return data ? formatRupiah(data) : '<span class="badge badge-light-warning">Please Input Ongkir</span>';
                        }
                    },
                    {
                        data: "progress",
                        render: function(data, type, row) {
                            var status = '';
                            switch (row.progress) {
                                case "0":
                                    status = '<span class="badge badge-light-success">New Order</span>';
                                    break;
                                case "1":
                                    status = '<span class="badge badge-light-warning">Menunggu Pembayaran</span>';
                                    break;
                                case "2":
                                    status = `<button class="btn btn-success btn-sm" onclick="showApproveModal('${row.invoice_no}')">Terima Pembayaran</button>`;
                                    break;
                                case "3":
                                    status = `<button class="btn btn-success btn-sm" onclick="showDeliverModal('${row.invoice_no}')">Kirim Pesanan</button>`;
                                    break;
                                case "4":
                                    status = '<span class="badge badge-light-warning">Menunggu Pesanan Diterima</span>';
                                    break;
                                case "6":
                                    status = '<span class="badge badge-light-warning">Waiting Payment</span>';
                                    break;
                            }
                            return status;
                        }
                    },
                    {
                        data: "ongkir",
                        render: function(data, type, full, meta) {
                            if (data) {
                                return formatRupiah(data);
                            } else {
                                return `<button type="button" onclick="modalUpdateOngkir('${full.invoice_no}')" class="btn btn-primary btn-sm cursor-pointer">Input Ongkir</button>`;
                            }
                        }
                    },
                    { 
                        data: "date_created", 
                        render: function(data, type, row) {
                            if(type === 'display' || type === 'filter'){
                                var date = new Date(data);
                                var options = { day: '2-digit', month: 'long', year: 'numeric' };
                                return date.toLocaleDateString('id-ID', options); // 'id-ID' untuk format Indonesia
                            }
                            return data;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return `
                                <div class="dropdown">
                                    <button class="css-ca2jq0s dropdown-toggle" style="width: 90px;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Atur
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a href="/admin/order-detail/${full.invoice_no}" class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                <i style="color:#181C32;" class="fas fa-eye me-2"></i>
                                                Detail
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item p-2 ps-5" style="cursor: pointer">
                                                <i style="color:#181C32;" class="fas fa-pencil me-2"></i>
                                                Edit
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            `;
                        }
                    }
                ]
            });
        });

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }

        // Show Modal Update Ongkir
        function modalUpdateOngkir(invoice){
            $.ajax({
                type: "GET",
                url: "data_order/" + invoice,
                success: function(data){

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

                    $('#modalUpdateOngkir').modal('show');
                    $('#id-invoice').text(data.invoice_no);
                    $('#invoice_id').val(data.invoice_no);
                    $('#tanggal-buat').text(dateFormat(data.date_created_invoice));
                    $('#total-amount').text(rupiah(data.amount));
                    $('#nama-outlet').text(data.nama_outlet);
                    $('#nama-penjual').text(data.name);
                    $('#no-hp').text(data.no_hp_outlet);
                    $('#alamat-detail').text(data.alamat_detail + ', Kelurahan ' + data.nama_kelurahan + ', Kecamatan ' + data.nama_kecamatan + ', ' + data.nama_kotakab + ', ' + data.nama_provinsi + ' ' + data.kodepos + '.');
                },
                error: function(data){
                    error
                }
            });
        }

        // Show Modal Approve Payment
        function showApproveModal(invoiceNo) {
            $('#id_invoice').val(invoiceNo);
            $('#nomor_invoice').text(invoiceNo);
            $('#modalApproveOrder').modal('show');
        }

        $('#approveOrder').submit(function(e) {
            e.preventDefault();
            var invoiceNo = $('#id_invoice').val(); // Dapatkan nomor invoice dari form
            var actionUrl = "/admin/store_payment_received_order/" + invoiceNo;

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Tangani respons sukses
                    $('#modalApproveOrder').modal('hide');

                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Sukses!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });

        // Show Modal Deliver Payment
        function showDeliverModal(invoiceNo) {
            $('#invoice_number').val(invoiceNo);
            $('#invoice_nomor').text(invoiceNo);
            $('#modalDeliverOrder').modal('show');
        }

        $('#deliverOrder').submit(function(e) {
            e.preventDefault();
            var invoiceNo = $('#invoice_number').val(); // Dapatkan nomor invoice dari form
            var actionUrl = "/admin/store_approve_order/" + invoiceNo;

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Tangani respons sukses
                    $('#modalDeliverOrder').modal('hide');

                    if(response.status === 'success') {
                        Swal.fire({
                            title: 'Sukses!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: response.responseJSON.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });
    </script>
@endsection