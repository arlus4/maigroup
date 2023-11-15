@extends('owner/layout-sidebar/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Pembelian</h1>
                </div>
                <button type="button" class="css-dn4naop" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-question-circle" style="color: #039344;"></i>
                    Cara Bayar
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
                        <table class="table table-bordered align-middle fs-6 gy-5" id="tableStatusRestock" class="display">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px text-dark">No</th>
                                    <th class="min-w-100px text-dark">ID Outlet</th>
                                    <th class="min-w-100px text-dark">Nama Outlet</th>
                                    <th class="min-w-100px text-dark">No Invoice</th>
                                    <th class="min-w-100px text-dark">Status</th>
                                    <th class="min-w-100px text-dark">Detail</th>
                                    <th class="min-w-100px text-dark"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($getStatus as $status)
                                    <tr>
                                        <td class="align-items-center ps-2">{{ $loop->iteration }}</td>
                                        <td class="align-items-center ps-2">{{ $status->outlet_id }}</td>
                                        <td class="align-items-center ps-2">{{ $status->nama_outlet }}</td>
                                        <td class="align-items-center ps-2">{{ $status->invoice_no }}</td>
                                        <td class="align-items-center ps-2">
                                            @if($status->progress == 0)
                                                <span class="badge" style="background:#809bce;">Order Baru</span>
                                            @elseif($status->progress == 1)
                                                <span class="badge" style="background:#fcb75d;">Menunggu Pembayaran</span>
                                            @elseif($status->progress == 2)
                                                <span class="badge" style="background:#7fd8be;">Pembayaran Diterima</span>
                                            @elseif($status->progress == 3)
                                                <span class="badge" style="background:#957fef;">Approve</span>
                                            @elseif($status->progress == 4)
                                                <span class="badge" style="background:#5aa9e6;">Sedang Dikirim</span>
                                            @elseif($status->progress == 5)
                                                <span class="badge" style="background:#618264;">Diterima</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td class="align-items-center w-100">
                                            <a style="color: #525867;" href="detail-order/{{ $status->invoice_no }}"><u>Detail Pembelian</u></a>
                                        </td>
                                        <td class="align-items-center">
                                            @if($status->progress == 4)
                                                <button class="css-btn-konf" onclick="konfirmasiOrder('{{ $status->invoice_no }}')">
                                                    <i class="fas fa-check-circle" style="color: #525867;"></i>&nbsp;
                                                    Konfirmasi
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cara Bayar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content css-fjl2jsa">
                <div class="css-content-header">
                    <div class="css-content-title">
                        <h4 class="css-lk3jsp">Cara Pembayaran</h4>
                    </div>
                    <button type="button" class="btn-close" style="font-size: 25px;" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="css-flj2ej">
                    <div class="css-fjkpo0ma">
                        <div class="css-wj23sk">
                            <div class="css-pp2kjsna">
                                <div class="css-fhxb1ns">
                                    <div class="css-akcdj8w">
                                        <div class="css-vubsk2a">
                                            <i class="fas fa-info-circle fa-lg" style="color: rgb(0, 64, 133);"></i>
                                        </div>
                                        <div>
                                            <span class="css-jdk02ns">
                                            Pastikan Anda mentransfer dengan nominal yang tepat.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-josq1jas">
                                <div>
                                    <div id="accordion-7" class="accordion-style-7 bg-white mt-4">
                                        <img src="{{ asset('assets/images/logo_bri.png') }}">
                                        <div class="accordion-item">
                                            <a href="#acc7_1" class="accordion__title h6 mb-2" data-toggle="collapse" aria-expanded="true">
                                                <small style="font-weight: 600;font-size:13px;color:#606065;">
                                                    <span class="accordion__icon small mr-2 mt-1">
                                                        <i class="ti-angle-down"></i>
                                                        <i class="ti-angle-up"></i>
                                                    </span>
                                                    Transfer melalui BRImo BRI
                                                </small>
                                            </a>
                                            <div id="acc7_1" class="collapse show" data-parent="#accordion-7" style="">
                                                <ol>
                                                    <li style="font-size: 13px;">Masuk ke menu Transfer dari menu utama BRImo.</li>
                                                    <li style="font-size: 13px;">Klik menu <strong>"Tambah Penerima"</strong>.</li>
                                                    <li style="font-size: 13px;">Pastikan Bank Tujuan yaitu <strong>"Bank BRI"</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT MaiTea Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT MaiTea Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website MaiTea Group sebagai bukti pembayaran telah selesai.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-josq1jas">
                                <div>
                                    <div id="accordion-7" class="accordion-style-7 bg-white mt-4">
                                        <img src="{{ asset('assets/images/logo_bca.png') }}">
                                        <div class="accordion-item">
                                            <a href="#acc7_1" class="accordion__title h6 mb-2" data-toggle="collapse" aria-expanded="true">
                                                <small style="font-weight: 600;font-size:13px;color:#606065;">
                                                    <span class="accordion__icon small mr-2 mt-1">
                                                        <i class="ti-angle-down"></i>
                                                        <i class="ti-angle-up"></i>
                                                    </span>
                                                    Transfer melalui BCA
                                                </small>
                                            </a>
                                            <div id="acc7_1" class="collapse show" data-parent="#accordion-7" style="">
                                                <ol>
                                                    <li style="font-size: 13px;">Masuk ke menu Transfer dari menu utama BRImo.</li>
                                                    <li style="font-size: 13px;">Klik menu <strong>"Tambah Penerima"</strong>.</li>
                                                    <li style="font-size: 13px;">Pastikan Bank Tujuan yaitu <strong>"Bank BRI"</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT MaiTea Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT MaiTea Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website MaiTea Group sebagai bukti pembayaran telah selesai.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="css-josq1jas">
                                <div>
                                    <div id="accordion-7" class="accordion-style-7 bg-white mt-4">
                                        <img src="{{ asset('assets/images/logo_mandiri.png') }}">
                                        <div class="accordion-item">
                                            <a href="#acc7_1" class="accordion__title h6 mb-2" data-toggle="collapse" aria-expanded="true">
                                                <small style="font-weight: 600;font-size:13px;color:#606065;">
                                                    <span class="accordion__icon small mr-2 mt-1">
                                                        <i class="ti-angle-down"></i>
                                                        <i class="ti-angle-up"></i>
                                                    </span>
                                                    Transfer melalui Mandiri
                                                </small>
                                            </a>
                                            <div id="acc7_1" class="collapse show" data-parent="#accordion-7" style="">
                                                <ol>
                                                    <li style="font-size: 13px;">Masuk ke menu Transfer dari menu utama BRImo.</li>
                                                    <li style="font-size: 13px;">Klik menu <strong>"Tambah Penerima"</strong>.</li>
                                                    <li style="font-size: 13px;">Pastikan Bank Tujuan yaitu <strong>"Bank BRI"</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT MaiTea Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT MaiTea Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website MaiTea Group sebagai bukti pembayaran telah selesai.</li>
                                                </ol>
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
            $('#tableStatusRestock').DataTable();
        });

        function konfirmasiOrder(outletId){
            Swal.fire({
                html: `Apakah barang atau orderan <strong>Sudah Diterima?</strong>,`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Ya, sudah!",
                cancelButtonText: 'Tidak, belum',
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'change-progress-order/' + outletId,
                        method: "GET"
                    })
                    .then(function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            // location.reload();
                        } else {
                            toastr.warning(data.message);
                            // location.reload();
                        }
                    })
                    .catch(function(err) {
                        toastr.error("Terjadi kesalahan dalam mengirim permintaan.");
                    });
                }
            });
        }
    </script>
@endsection