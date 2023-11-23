@extends('layout-master/app')
@section('content')

<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Invoice {{ $data->invoice_no }}</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
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
            <!-- begin::Invoice 3-->
            <div class="card">
                <!-- begin::Body-->
                <div class="card-body py-20">
                    <!-- begin::Wrapper-->
                    <div class="mw-lg-950px mx-auto w-100">
                        <!-- begin::Header-->
                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                            <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                            <!--end::Logo-->
                            <div class="text-sm-end">
                                <!--begin::Logo-->
                                <a href="javascript:;" class="d-block mw-150px ms-sm-auto">
                                    <img alt="Logo" src="{{ asset('assets/images/ic_maitea.png') }}" class="h-80px" />
                                </a>
                                <!--end::Logo-->
                                <!--begin::Text-->
                                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                    <div>Alamat MaiGroup</div>
                                </div>
                                <!--end::Text-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="pb-12">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column gap-7 gap-md-10">
                                <!--begin::Message-->
                                <div class="fw-bold fs-2">Dear, {{ $data->nama_outlet }}
                                    <br />
                                    <span class="text-muted fs-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem, earum!</span>
                                </div>
                                <!--begin::Message-->
                                <!--begin::Separator-->
                                <div class="separator"></div>
                                <!--begin::Separator-->
                                <!--begin::Order details-->
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Tanggal</span>
                                        <span class="fs-5">{{ \Carbon\Carbon::parse($data->date_created_invoice)->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Invoice ID</span>
                                        <span class="fs-5">{{ $data->invoice_no }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Alamat Outlet</span>
                                        <span class="fs-6">{{ $data->alamat_detail }}, {{ $data->nama_kelurahan }},
                                            <br />{{ $data->nama_kecamatan }}, {{ $data->nama_kotakab }},
                                            <br />{{ $data->nama_provinsi }}, {{ $data->kodepos }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Order details-->
                                <!--begin:Order summary-->
                                <div class="d-flex justify-content-between flex-column">
                                    <!--begin::Table-->
                                    <div class="table-responsive border-bottom mb-9">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                                <tr class="border-bottom fs-6 fw-bold text-muted">
                                                    <th class="min-w-175px pb-2">Products</th>
                                                    <th class="min-w-70px text-end pb-2">SKU</th>
                                                    <th class="min-w-80px text-end pb-2">QTY</th>
                                                    <th class="min-w-100px text-end pb-2">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                <!--begin::Products-->
                                                @foreach ($details as $detail)
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if ($detail->sku_id == "PA1")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Startup</div>
                                                                    </div>
                                                                @elseif ($detail->sku_id == "PA2")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Advanced</div>
                                                                    </div>
                                                                @elseif ($detail->sku_id == "PA3")
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">Paket Custom</div>
                                                                    </div>
                                                                @else
                                                                    <a href="javascript:;" class="symbol symbol-50px">
                                                                        <span class="symbol-label" style="background-image:url(../../../{{ $detail->path_thumbnail }});"></span>
                                                                    </a>
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">{{ $detail->nama_produk }}</div>
                                                                        <div class="fs-7 text-muted">{{ $detail->project_name }}</div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        @if ($detail->sku_id == "PA1")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @elseif ($detail->sku_id == "PA2")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @elseif ($detail->sku_id == "PA3")
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @else
                                                            <td class="text-end">{{ $detail->sku_id }}</td>
                                                        @endif
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{ $detail->qty }}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Total-->
                                                        @if ($detail->total_amount == null)
                                                            <td class="text-end">
                                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#inputHarga" data-bs-sku="{{ $detail->sku_id }}">Input Harga</button>
                                                            </td>
                                                        @else
                                                            <td class="text-end">@rupiah($detail->total_amount)</td>
                                                        @endif
                                                        <!--end::Total-->
                                                    </tr>
                                                @endforeach
                                                <!--end::Products-->
                                                <!--begin::Subtotal-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Subtotal</td>
                                                    @php
                                                        $isConfirmationNeeded = false;
                                                        foreach ($details as $detail) {
                                                            if ($detail->total_amount == null) {
                                                                $isConfirmationNeeded = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($isConfirmationNeeded)
                                                        <td class="text-end">Data Belum Lengkap</td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->amount)</td>
                                                    @endif
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Ongkos Kirim</td>
                                                    @if ($data->ongkir == null)
                                                        <td class="text-end">
                                                            <button type="button" onclick="modalUpdateOngkir('{{ $data->invoice_no }}')" class="btn btn-primary btn-sm cursor-pointer">Input Ongkir</button>
                                                        </td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->ongkir)</td>
                                                    @endif
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Unique Code-->
                                                <tr>
                                                    <td colspan="3" class="text-end">Kode Unik</td>
                                                    @if ($data->kode_unik == null)
                                                        <td class="text-end">Data Belum Lengkap</td>
                                                    @else
                                                        <td class="text-end">@rupiah($data->kode_unik)</td>
                                                    @endif
                                                </tr>
                                                <!--end::Unique Code-->
                                                <!--begin::Total-->
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark fw-bold text-end">Total</td>
                                                    @if ($data->total == null)
                                                        <td class="text-end">Data Belum Lengkap</td>
                                                    @else
                                                        <td class="text-dark fs-3 fw-bolder text-end">@rupiah($data->total)</td>
                                                    @endif
                                                </tr>
                                                <!--end::Total-->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end:Order summary-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                        <!-- begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            {{-- <button type="button" onclick="window.location.href='{{ route('admin.download.invoice', $data->invoice_no) }}'" class="btn btn-success my-1 me-12">Download</button> --}}
                            <button type="button" onclick="window.location.href='/admin/download-invoice/{{ $data->invoice_no }}'" class="btn btn-success my-1 me-12">Download</button>
                            <!-- end::Action-->
                        </div>
                        <!-- end::Footer-->
                    </div>
                    <!-- end::Wrapper-->
                </div>
                <!-- end::Body-->
            </div>
            <!-- end::Invoice 1-->

            <!-- Modal Input Harga Custom -->
            <div class="modal fade" tabindex="-1" id="inputHarga">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="/admin/update_harga_paket/{{ $data->invoice_no }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title">Input Harga</h3>
                                <button type="button" class="btn-close css-fhk9sna" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                
                            <div class="modal-body">
                                <input type="hidden" id="id_sku" name="sku_id">
                                <div class="css-pouys8k">
                                    <div class="css-hj7sb2a">
                                        <div class="css-produk-info">
                                            <label class="form-label" style="color:#31353B!important;font-size: 1rem;font-weight: 700">Input Harga Paket</label>
                                        </div>
                                    </div>
                                    <div class="css-harga-prod">
                                        <div class="css-total-amount">
                                            <input type="text" name="harga" id="harga" class="form-control mb-6" required/>
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
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->

@endsection

@section('script')
<script>
    // Show Modal Update Ongkir
    function modalUpdateOngkir(invoice){
        $.ajax({
            type: "GET",
            url: "/admin/data_order/" + invoice,
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
                $('#tanggal-buat').text(dateFormat(data.date_created));
                $('#img-produk').text(data.thumbnail);
                $('#nama-kategori').text(data.project_name);
                $('#nama-produk').text(data.nama_produk);
                $('#qtyAmount').text(data.qty + ' x ' + rupiah(data.amount));
                $('#total-amount').text(rupiah(data.amount));
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
<script>
    $('#inputHarga').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var skuId = button.data('bs-sku'); // Extract info from data-bs-* attributes

        // Update the modal's content.
        var modal = $(this);
        modal.find('.modal-body #id_sku').val(skuId);
    });
</script>

@endsection