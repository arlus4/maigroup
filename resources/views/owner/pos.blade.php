@extends('owner/layout-owner/app')

@section('content')
    <div class="d-flex flex-column flex-xl-row">
        <div class="d-flex flex-row-fluid me-xl-9 mb-10 mb-xl-0">
            <div class="cursor-pointer">
                <div class="d-flex flex-wrap d-grid gap-5 gap-xxl-9">
                    @foreach($dataOutlet as $outlet)
                        <div class="card card-flush menu-item flex-row-fluid css-bn92msa pb-5 mw-100" id="{{ $outlet->product_id }}">
                            <div class="text-center p-0">
                                <img src="{{ asset($outlet->path_thumbnail) }}" class="rounded-3 mb-2 w-150px h-150px w-xxl-200px h-xxl-200px">
                                <div class="text-center mt-2">
                                    <span class="fw-bold text-gray-800 cursor-pointer" style="font-size: 14px;">{{ $outlet->nama_produk }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex-row-auto w-xl-425px">
            <div class="card card-flush css-bn92msa">
                <div class="card-header pt-5">
                    <h3 class="card-title fw-bold text-gray-800 fs-1">Data Order</h3>
                </div>
                <div class="card-body pt-0 cursor-pointer" style="padding: 0rem 1.25rem!important;">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-flush css-bn92msa" style="margin-top: 30px;">
                <div class="d-flex justify-content-between pt-5 mb-3" style="padding: 0 2.25rem;">
                    <h3 class="card-title fw-bold text-gray-800 fs-1">Sub Total 
                        <span id="totalItem">(0 Item)</span>
                    </h3>
                    <h3 class="card-title fw-bold text-gray-800 fs-1" id="totalHargaSemua" disabled>Rp 0</h3>
                </div>
                <div class="m-0 css-huops2n" style="padding: 1rem 1.25rem!important;">
                    <div class="alert alert-primary" style="border-radius: 8px;">
                        <span>Silakan masukkan nomor HP pembeli. Pastikan nomor HP Pembeli yang Anda masukkan aktif dan dapat dihubungi</span>
                    </div>
                    <form>
                        <div class="form-group">
                            <input type="hidden" id="outletId" value="{{ Auth::user()->outlet_id }}">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-mobile-screen"></i>
                                </span>
                                <input type="text" class="form-control css-dhk2xjk" id="inputNoHp" placeholder="Contoh : 082xxxxxx" required>
                                <ul id="nomorHpList" class="list-group"></ul>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="css-kl2kd9a mt-5" style="background-color: #e2e2e2;color: #929292;cursor: not-allowed;" id="btnOrder" disabled>
                        <i class="fas fa-check-circle" id="iconColor" style="color: #929292"></i>&nbsp;
                        Order Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Order -->
    <div class="modal fade" id="modalOrder">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 8px;">
                <div class="css-head2js">
                    <div class="css-txtb1bs">
                        <h5 class="css-txth6na text-center">Konfirmasi Order</h5>
                    </div>
                </div>
                <div class="css-gfu9nxq">
                    <div class="alert alert-primary">
                        <span>
                            Tahap terakhir, pastikan semua sudah benar dan apakah Anda yakin ingin melanjutkan order ini?
                        </span>
                    </div>
                    <div class="css-okl2dh1">
                        <div style="overflow: scroll;">
                            <div id="orderContentHeader"></div>
                            <div id="orderContent"></div>
                            <div id="orderContentFooter"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="font-weight:600;" data-bs-dismiss="modal">Tidak, batalkan</button>
                    <button type="button" onclick="saveOrder()" class="btn" style="font-weight:600;color: #fff;background-color: #039344;">Ya, lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function rupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(number).replace(/(\.|,)00$/g, '');
            }

            function updateTotalHarga() {
                var totalHarga = 0;
                $('.table tbody tr').each(function() {
                    var hargaItem = parseInt($(this).find('.text-end span').attr('data-harga'), 10);
                    var jumlahItem = parseInt($(this).find('.input-number').val(), 10);
                    totalHarga += hargaItem * jumlahItem;
                });
                $('#totalHargaSemua').text(rupiah(totalHarga));
                return totalHarga;
            }

            function updateButtonStatus() {
                var jumlahBaris = $('.table tbody tr').length;
                var inputanNoHp = $('#inputNoHp').val().trim();

                if (jumlahBaris > 0 && inputanNoHp !== '') {
                    $('#btnOrder').prop('disabled', false)
                        .css({
                            'background-color': '#039344',
                            'color': '#fff',
                            'cursor': 'pointer'
                        });
                    $('#iconColor').css({
                        'color': '#fff'
                    });
                } else {
                    $('#btnOrder').prop('disabled', true)
                        .css({
                            'background-color': '#e2e2e2', 
                            'color': '#929292',
                            'cursor': 'not-allowed'
                        });
                    $('#iconColor').css({
                        'color': '#929292'
                    });
                }
                $('#totalItem').text("(" + jumlahBaris + " Item)");

                return jumlahBaris;
            }

            $('.card.card-flush.menu-item').on('click', function() {
                var productId = $(this).attr('id');
                $.ajax({
                    type: "GET",
                    url: "get-produk/" + productId,
                    success: function(data) {
                        var cekDataOrder = $('#itemTotal_' + data.id);
                        if (cekDataOrder.length) {
                            var input = $("input[name='" + data.id + "']");
                            var currentVal = parseInt(input.val(), 10);
                            var newValue = currentVal + 1;

                            input.val(newValue).change();
                        }else{
                            var namaProduk      = data.nama_produk;
                            var hargaProduk     = data.harga;
                            var gambarProduk    = data.path_thumbnail;
                            var assetImg        = "{{ asset('') }}";
                            var imageUrl        = assetImg + gambarProduk;

                            var tableRow =
                                '<tr>' +
                                    '<td class="text-end pt-1 pb-1 css-sjdk28sn">' +
                                        '<i class="fas fa-times text-danger" style="font-size: 20px;"></i>' +
                                    '</td>' +
                                    '<td class="p-0 pt-1 pb-1">' +
                                        '<div class="d-flex align-items-center">' +
                                        '<img src="' + imageUrl + '" class="w-50px h-50px rounded-3" data-gambar="' + imageUrl + '" id="gambar-produk">' +
                                        '<span style="font-size: 13px;" class="fw-bold text-gray-800 cursor-pointer me-1" id="nama-produk">' + namaProduk + '</span>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td class="p-0 pt-1 pb-1">' +
                                        '<div class="input-group css-input-grup">'+
                                            '<span class="input-group-btn">' +
                                                '<button type="button" class="btn btn-icon btn-number btn-sm btn-light btn-icon-gray-400" data-type="minus" data-field="'+data.id+'">' +
                                                    '<i class="fas fa-minus"></i>&nbsp;'+
                                                '</button>'+
                                            '</span>'+
                                            '<input type="text" name="'+data.id+'" class="form-control input-number border-0 text-center p-0 fs-3 fw-bold text-gray-800 w-15px" min="1" max="10" readonly="readonly" value="1">'+
                                            '<span class="input-group-btn">'+
                                                '<button type="button" class="btn btn-icon btn-number btn-sm btn-light btn-icon-gray-400" data-type="plus" data-field="'+data.id+'">'+
                                                    '<i class="fas fa-plus"></i>'+
                                                '</button>'+
                                            '</span>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td class="text-end pt-1 pb-1">' +
                                        '<span style="font-size: 13px;" class="fw-bold text-dark pe-4 itemTotal" id="itemTotal_' + data.id + '" data-harga="' + hargaProduk + '" data-kt-pos-element="item-total">' + rupiah(hargaProduk) + '</span>' +
                                    '</td>' +
                                '</tr>';

                            $('.table tbody').append(tableRow);
                        }

                        updateTotalHarga();
                        updateButtonStatus();
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });
            });

            $(document).on('click', '.btn-number', function(e) {
                e.preventDefault();

                var fieldName = $(this).data('field');
                var type = $(this).data('type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());
                var formatHarga = $('#itemTotal_' + fieldName).text();
                var hargaSatuan = parseInt(formatHarga.replace(/[^0-9]/g, ''), 10);

                if (!isNaN(currentVal) && !isNaN(hargaSatuan)) {
                    if (type === 'minus') {
                        if (currentVal > input.attr('min')) {
                            newValue = currentVal - 1;
                            input.val(newValue).change();
                            var totalHarga = newValue * hargaSatuan;

                            $('#totalHargaSemua').text('Rp ' + totalHarga.toLocaleString('id-ID'));
                        }
                        if (newValue == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if (type === 'plus') {
                        if (currentVal < input.attr('max')) {
                            newValue = currentVal + 1;
                            input.val(newValue).change();
                            var totalHarga = newValue * hargaSatuan;

                            $('#totalHargaSemua').text('Rp ' + totalHarga.toLocaleString('id-ID'));
                        }
                        if (newValue == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
                
                updateTotalHarga();
                updateButtonStatus();
            });

            $(document).on('click', '.fas.fa-times', function() {
                $(this).closest('tr').remove();

                updateTotalHarga();
                updateButtonStatus();
            });

            $("#inputNoHp").keydown(function (e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }

                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            $('#inputNoHp').on('input', updateButtonStatus);

            $(document).on('click', '.btn-number, .fas.fa-times', function() {
                updateButtonStatus();
            });

            $('#inputNoHp').on('keyup', function() {
                var query = $(this).val();
                $('#nomorHpList').html('');
                if(query.length >= 2) {
                    $.ajax({
                        url: "/owner/getNomorHP",
                        type: "GET",
                        data: {
                            'term': query
                        },
                        success: function(data) {
                            if(data.length > 0) {
                                for(var i = 0; i < data.length; i++) {
                                    $('#nomorHpList').append('<li class="list-group-item link-class">'+ data[i] +'</li>');
                                }
                            }
                        }
                    });
                }
            });
        
            $(document).on('click', 'li', function() {
                var value = $(this).text();
                $('#inputNoHp').val(value);
                $('#nomorHpList').html('');
            });

            $('#btnOrder').on('click', function() {
                var totalHarga          = updateTotalHarga();
                var totalItem           = updateButtonStatus();
                var orderContentHeader  = '';
                var modalContent        = '';
                var orderContentFooter  = '';

                $('.card-body .table tbody tr').each(function() {
                    outletId
                    var noHP          = $('#inputNoHp').val();
                    var outletId      = $('#outletId').val();
                    var namaProduk    = $(this).find('#nama-produk').text();
                    var gambarProduk  = $(this).find('#gambar-produk').data('gambar');
                    var jumlah        = $(this).find('input.input-number').val();
                    var harga         = $(this).find('.itemTotal').data('harga');
                    var totalHargaQTY = jumlah * harga;

                    orderContentHeader = `
                        <div class="css-vb3nxk8m">
                            <p class="css-jkopg1h">Id Outlet Anda</p>
                            <div>
                                <p class="css-jkopg1h fw-bold" style="color: #212121">
                                    <span>${outletId}</span>
                                </p>
                            </div>
                        </div>
                        <div class="css-vb3nxk8m">
                            <p class="css-jkopg1h">No HP Pembeli</p>
                            <div>
                                <p class="css-jkopg1h fw-bold" style="color: #212121">
                                    <span>${noHP}</span>
                                </p> 
                            </div>
                        </div>
                        <hr style="border:2px solid #D6DFEB;">`;

                    modalContent += `
                        <div class="css-prodo2j">
                            <div class="css-bhj9sja">
                                <div class="css-pkluvhij">
                                    <img class="css-pkimg9j" src="${gambarProduk}" width="46">
                                    <div>
                                        <span class="css-pkpoi7a">${namaProduk}</span>
                                        <p>${jumlah} x ${rupiah(harga)}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="css-pkhtd2hs">
                                <div class="css-totalharga">
                                    <p style="margin-bottom: 0px;color: #fff">total</p>
                                    <h5 class="css-txth6na" style="font-weight: 500;font-size: 13px;">${rupiah(totalHargaQTY)}</h5>
                                </div>
                            </div>
                        </div>`;

                    orderContentFooter = `
                        <hr>
                        <div class="css-vb3nxk8m">
                            <p class="css-jkopg1h fw-bold" style="color: #212121;font-size: 15px;">Sub Total (${totalItem} Item)</p>
                            <div>
                                <p class="css-jkopg1h fw-bold" style="color: #212121;font-size: 15px;">
                                    <span> ${rupiah(totalHarga)}</span>
                                </p>
                            </div>
                        </div>`;

                });

                $('#orderContentHeader').html(orderContentHeader);
                $('#orderContent').html(modalContent);
                $('#orderContentFooter').html(orderContentFooter);

                // Tampilkan modal
                $('#modalOrder').modal('show');
            });
        });

        function saveOrder(){
            var products = [];

            $('.table tbody tr').each(function() {
                var productId = $(this).find('input.input-number').attr('name');
                var qty = parseInt($(this).find('input.input-number').val(), 10);
                var productData = {
                    product_id: productId,
                    qty: qty
                };
                products.push(productData);
            });

            var orderData = {
                outlet_id   : $('#outletId').val(),
                noHp        : $('#inputNoHp').val(),
                product_id  : products
            };

            $.ajax({
                type: 'POST',
                url: 'store-order',
                data: orderData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection