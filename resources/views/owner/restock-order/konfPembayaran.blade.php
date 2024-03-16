@extends('owner/layout-sidebar/app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0" style="font-size: 20px!important;">Konfirmasi Pembayaran Order</h1>
                </div>
                <button type="button" class="css-dn4naop" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-question-circle" style="color: #039344;"></i>
                    Cara Bayar
                </button>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
                @if ($message = Session::get('success'))
                    <div class="css-pp2kjsn">
                        <div class="css-fhxb1ns">
                            <div class="css-akcdj8w">
                                <div class="css-vubsk2a">
                                    <i class="fas fa-check-circle fa-lg" style="color: rgb(0, 64, 133);"></i>
                                </div>
                                <div>
                                    <span class="css-jdk02ns">
                                        {!! $message !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="css-pp2kjsn">
                        <div class="css-fhxb1ns">
                            <div class="css-akcdj8ws">
                                <div class="css-vubsk2a">
                                    <i class="fas fa-times-circle fa-lg" style="color: #dc3545;"></i>
                                </div>
                                <div>
                                    <span class="css-jdk02ns" style="color: #dc3545!important;">
                                        {!! $message !!}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

				<form action="{{ route('owner.owner_store_konf_pembayaran_order') }}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
					@csrf
					<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
						<div class="tab-content">
							<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
								<div class="d-flex flex-column gap-7 gap-lg-10">
									<div class="card css-xcvf6ga card-flush py-4" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
										<div class="card-body css-xcvf6gb pt-0">
                                            <input type="hidden" name="outlet_id" value="{{ Auth::user()->outlet_id }}">
                                            <label class="required form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Pilihan Invoice</label>
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text">
                                                    <i class="fas fa-file-invoice fs-2"></i>
                                                </span>
                                                <div class="overflow-hidden flex-grow-1">
                                                    <select class="form-select rounded-start-0" name="invoice_no" data-control="select2" data-placeholder="Pilih Invoice" required>
                                                        <option></option>
                                                        @foreach($getInvoice as $invoice)
                                                            <option value="{{ $invoice->invoice_no }}">{{ $invoice->invoice_no }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-muted fs-7 mt-2 mb-5" style="color: #31353B!important;">Pilih Invoice dengan benar, ya.</div>
                                            <div style="display: none;margin-top: 30px;border-radius: 8px;border: 1px solid #D6DFEB" id="formKonfirmasi">
                                                <label class="form-label" style="padding-top: 12px;padding-left: 15px;color:#31353B!important;font-size: 1rem;font-weight: 700">Form Konfirmasi Pembayaran</label>
                                                <div style="padding: 16px;">
                                                    <div class="form-group mb-3 mt-3">
                                                        <label class="mb-2 mt-2">No. Invoice</label>
                                                        <input type="text" id="noInvoice" class="form-control" style="background-color: #e2e2e2;cursor: not-allowed;" readonly>
                                                    </div>
                                                    <label class="mb-2 mt-2">Pilih Bank Tujuan</label>
                                                    <div class="form-floating border rounded" style="border: 1px solid #E4E6EF!important;">
                                                        <select class="form-select form-select-transparent" name="bank_maigroup" placeholder="-- Pilih Bank --" id="kt_docs_select2_country">
                                                            <option></option>
                                                            @foreach($getBankTujuan as $val)
                                                                <option value="{{ $val->id }}" data-kt-select2-country="{{ asset(''.$val->path_icon_bank) }}">{{ $val->nama_bank }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="kt_docs_select2_country">-- PIlih Bank Tujuan --</label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-2 mt-2">Nama Bank Asal / Pengirim</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <i class="fas fa-credit-card"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" name="asal_rekening_bank" placeholder="Contoh: BCA" aria-describedby="basic-addon1" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-2 mt-2">Nama Pemilik Rekening</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <i class="fas fa-address-book"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" name="nama_pemilik_rekening_pembayaran" placeholder="Contoh: Budi Setiyawan" aria-describedby="basic-addon1" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-2 mt-2">Total Pembayaran</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1" style="background-color: #e2e2e2;">
                                                                        <i class="fas fa-rupiah-sign"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" id="jumlahTotal" aria-describedby="basic-addon1" style="background-color: #e2e2e2;cursor: not-allowed;" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-2 mt-2">Jumlah yang diTransfer</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <i class="fas fa-rupiah-sign"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" id="nominalTF" name="jumlah_pembayaran" placeholder="Masukkan nomimal yang ditransfer" aria-describedby="basic-addon1" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-2 mt-2">Upload Bukti Pembayaran</label>
                                                        <input type="file" name="bukti_pembayaran" class="form-control bukti_pembayaran" accept=".png, .jpg, .jpeg, .pdf" required>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="css-dn4naopi" style="width: auto">
                                                                <i class="fas fa-check-circle text-white"></i>
                                                                Unggah Bukti Pembayaran
                                                            </button>
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
				</form>
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
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT Toko Seru Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT Toko Seru Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website Toko Seru Group sebagai bukti pembayaran telah selesai.</li>
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
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT Toko Seru Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT Toko Seru Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website Toko Seru Group sebagai bukti pembayaran telah selesai.</li>
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
                                                    <li style="font-size: 13px;">Masukkan rekening tujuan <strong>038-601-002-588-303 a.n PT Toko Seru Group</strong>.</li>
                                                    <li style="font-size: 13px;">Masukkan jumlah uang yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Pada halaman konfirmasi, pastikan Nomor Tujuan a.n. <strong>PT Toko Seru Group</strong></li>
                                                    <li style="font-size: 13px;">Tuliskan no. order Anda pada berita atau keterangan transfer.</li>
                                                    <li style="font-size: 13px;">Periksa kembali nominal yang akan ditransfer.</li>
                                                    <li style="font-size: 13px;">Masukkan Personal Identification Number (PIN) BRI Anda.</li>
                                                    <li style="font-size: 13px;">Transaksi selesai.</li>
                                                    <li style="font-size: 13px;">Download resi transaksi atau screenshot halaman saat transaksi berhasil dan upload bukti pembayaran ke website Toko Seru Group sebagai bukti pembayaran telah selesai.</li>
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
    <script>
        $(document).ready(function() {
            var optionFormat = function(item) {
                if ( !item.id ) {
                    return item.text;
                }

                var span     = document.createElement('span');
                var imgUrl   = item.element.getAttribute('data-kt-select2-country');
                var template = '';

                template += '<img src="' + imgUrl + '" class="rounded-circle h-20px me-2" alt="image"/>';
                template += item.text;

                span.innerHTML = template;

                return $(span);
            }

            $('#kt_docs_select2_country').select2({
                templateResult: optionFormat,
                templateSelection: optionFormat
            });

            $('select[name="invoice_no"]').change(function() {
                var noInvoice = $(this).val();
                if (noInvoice) {
                    $.ajax({
                        url: '/owner/cek-data-invoice/' + noInvoice,
                        type: "GET",
                        success: function(data) {
                            if (data.invoice_no) { 
                                $('#noInvoice').val(data.invoice_no);
                                $('#jumlahTotal').val(formatRupiah(data.total));
                                
                                $('#formKonfirmasi').css({
                                    'display' : 'block'
                                });
                            }
                        },
                        error: function() {
                            alert('Tidak dapat mengambil data');
                        }
                    });
                } else {
                    $('#formKonfirmasi').css({
                        'display' : 'none'
                    });
                }
            });

            $("#nominalTF").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $('#nominalTF').on('input', function() {
                var inputValue = $(this).val();
                var formattedValue = formatRupiah(inputValue);
                $(this).val(formattedValue);
            });

            setTimeout(function() {
                document.querySelector('.css-pp2kjsn').remove();
            }, 10000);

            setTimeout(function() {
                document.querySelector('.css-pp2kjsn').remove();
            }, 10000);
        });

        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    

    </script>
@endsection