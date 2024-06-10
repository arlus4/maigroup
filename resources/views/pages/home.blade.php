<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Toko Seru - Nusantara</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/bootsnav.css" >
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.4.0/css/all.min.css">
    </head>
	
	<body>
        <!-- Bagian Mobile -->
        <section class="css-bagian-mobile">
            <nav class="bgWarna">
                <div class="d-flex px-4 py-3" style="justify-content: space-between">
                    <div class="d-flex align-items-center">
                        <img class="img-fluid img-log" src="{{ asset('assets/images/maitea_nusantara_landing.png') }}">
                    </div>
                    <button class="btn-bars" type="button" data-toggle="modal" data-target="#modalSidebar">
                        <i class="fas fa-bars fa-2x" style="font-size: 1.5em;"></i>
                    </button>
                </div>
            </nav>

            <div class="css-banner-mobile">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/bg_mobile_1.png') }}" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/bg_mobile_2.png') }}" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/bg_mobile_3.png') }}" class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>

            <div class="px-4 py-5">
                <span style="font-size: 14px;color: #293237">"Selamat Datang Pada Sebuah Terobosan Baru Dalam Es Teh Yang Menyajikan Rasa Memukau Dan Menghargai Setiap Tegukan Dengan Program Loyalty Eksklusif Juga Manfaat Istimewa Pada Setiap Keanggotaan Mitra. Rasakan Pengalaman Es Teh Yang Tak Tertandingi Dan Jadilah Bagian Dari Revolusi Teh Anak Negeri!"</span>
            </div>
        </section>


        <!-- Bagian Website -->
        <section class="mobile-hidden">
            <div class="css-cnf2kjs">
                <div>
                    <div class="css-hero-image">
                        <span style="box-sizing:border-box;display:block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:absolute;top:0;left:0;bottom:0;right:0">
                            <img src="{{ asset('assets/images/bg_4.png') }}" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%;object-fit:cover">
                        </span>
                    </div>
                </div>
                <div>
                    <header class="css-cf32hks">
                        <div class="css-jd23jsk">
                            <div class="css-nb3nksa">
                                <div class="css-lkg3ns">
                                    <div class="css-bnm2jsd">
                                        <div class="css-dnmn2sw">
                                            <a href="/">
                                                <img src="{{ asset('assets/images/maitea_nusantara_landing.png') }}" style="height: 100%; object-fit:contain;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="css-cop3rjs">
                                    <a href="#" class="css-cnmt3nsa">
                                        Beranda
                                    </a>
                                    <a href="#" class="css-cnmt3nsa">
                                        Artikel
                                    </a>
                                    <a href="#" class="css-cnmt3nsa">
                                        Tentang Kami
                                    </a>
                                    <a href="/login" class="css-cnmt3nsa">
                                        Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="css-vr3kjak">
                    <h2 class="css-hj3kdop">
                        Segarnya Nikmat<br>
                        Kesetiaan Yang Memikat<br>
                        <span style="font-size: 30px;font-weight: 500;">#1<sup style="font-size: 15px;top: -1em;margin-right: 4px;">st</sup> Tea With Loyalty</span>
                    </h2>
                    <div style="margin-top: 16px;">
                        <button class="btn" style="position:relative;right: 54%;width:100%;border-radius:8px;background-color:#155724;border: 1.4px solid #d4edda;color: #fff;">
                            <span style="font-size: 17px;font-weight: 600;">Gabung Mitra Toko Seru</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-hidden" style="margin: 0 60px;">
            <div class="model-search-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-model-search">
                            <h5 class="css-fhk2nsa">
                                "Selamat datang pada sebuah terobosan baru dalam es teh yang menyajikan rasa memukau dan menghargai setiap tegukan dengan 
                                program loyalty eksklusif juga manfaat istimewa pada setiap keanggotaan mitra. Rasakan pengalaman es teh yang tak tertandingi 
                                dan jadilah bagian dari revolusi teh anak negeri!"
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-hidden" style="margin: 0 60px; margin-top: 70px;">
            <div class="css-fn4gnkak">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="css-fwnk4jd">Kini saat yang tepat bagi Anda untuk membangun bisnis yang mengutamakan kesetiaan pelanggan melalui kemitraan bersama Maitea Nusantara + MaiApps</div>
                    </div>
                    <div class="col-md-5" style="padding-left: 80px;">
                        <img width="300" height="200" src="{{ asset('assets/images/banner_body_1.png') }}">
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img style="width: 400px; height: 390px;" src="{{ asset('assets/images/banner_body_2.png') }}">
                    </div>
                    <div class="col-md-6">
                        <div class="css-fj2kjdm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tristique pretium ligula, in mollis tellus ultrices vitae. Quisque iaculis condimentum turpis a ultricies. In nisl dolor, condimentum in gravida id, laoreet eget dui. Donec eu mollis turpis, at gravida quam. Curabitur accumsan, urna hendrerit tristique aliquet, mauris urna aliquam lacus, vel ullamcorper turpis sem ac turpis. Aliquam interdum lobortis viverra. Sed eget faucibus ex. </div>
                    </div>
                </div>
        </section>


        <section class="mobile-hidden sec-menu" style="padding:0px!important;margin: 0px;padding-bottom: 0px;">
            <div class="css-po2jsm" style="margin: 0 60px;">
                <div class="css-hjsa2js">
                    <h3 class="css-cjdkja"><span style="color: #155724">Varian</span> MaiTea Nusantara</h3>
                </div>
            </div>
            <div class="css-dcnk23j">
                <div class="css-fnk2skj css-vkn9jca">
                    <div class="css-diop1ms">
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/honey_cup_2.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Honey <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/lychee_cup_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Lychee <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/lemon_cup_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Lemon <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/strawberry_cup_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Strawberry <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/manggo_cup_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Manggo <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/greentea_cup_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Greentea <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/milktea_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Milk <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                        <div class="css-jk1hsk">
                            <div class="css-lojd1h">
                                <img class="css-menu-img" src="{{ asset('assets/images/thai_1.png') }}">
                            </div>
                            <div class="css-kanan-text">
                                <h4>Thai <span style="color: #155724">Tea</span></h4>
                                <p style="font-weight: 500; font-size: 15px; color: #212121;">Rp 6000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mobile-hidden">
            <img src="{{ asset('assets/images/bg_body_3.png') }}" alt="">
        </section>

        <section class="mobile-hidden">
            <img src="{{ asset('assets/images/bg_body_4.png') }}" alt="">
        </section>

        <!-- Awal Bagian Mobile Menu -->
        <div class="css-dahk1nbs">
            <div class="css-posn1da">
                <div class="css-coan1sn">
                    <div class="css-bvjhaqo" style="justify-content: space-between;">
                        <h4 class="css-ndk2nsa mb-0">Varian MaiTea Nusantara</h4>
                    </div>
                </div>
                <div class="css-88fj2na">
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/bg_pinggir_1.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_1.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_2.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/bg_pinggir_2.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_3.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_4.png') }}">
                        </div>
                    </a>
                </div>
                <hr class="css-jarak-mobile m-0">
                <div class="css-88fj2na">
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/bg_pinggir_3.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_5.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_6.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/bg_pinggir_4.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_7.png') }}">
                        </div>
                    </a>
                    <a href="#" class="css-p78hg8j">
                        <div class="css-op09wjn responsive">
                            <span class="responsive css-i899jdl"></span>
                            <img class="css-fn22nd9a" src="{{ asset('assets/images/cth_8.png') }}">
                        </div>
                    </a>
                </div>
                <hr class="css-jarak-mobile m-0">
            </div>
        </div>

        <div class="css-dahk1nbs" style="padding: 0px!important;">
            <img src="{{ asset('assets/images/bg_body_3.png') }}" alt="">
        </div>
        <div class="css-dahk1nbs" style="padding: 0px!important;">
            <img src="{{ asset('assets/images/bg_body_4.png') }}" alt="">
            <div style="background: #f6f6f6">
                <div class="css-tes-header w-100">
                    <h3 class="css-cjdkja text-center" style="padding-top: 50px;">Testimoni Mitra &amp; Customer <span>MaiTea</span></h3>
                </div>
                <div class="swiper mySwiper" style="padding-top: 130px; padding-bottom: 80px;">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="css-jfwi09fn">
                                <div class="css-j88hd2n">
                                    <img class="css-po00nd2" src="{{ asset('assets/images/dodi.png') }}" alt="">
                                </div>
                                <div class="css-66ggb3b">
                                    <p style="font-size: 16px; font-weight: 600; color: #212121;">Doddy Prayogo</p>
                                    <hr class="mt-0 mb-0 p-0" style="margin-left: 25%;margin-right: 25%;width: 50%;border: 1px solid #146600;">
                                    <p style="font-weight:600;color: #146600;">Customer</p>
                                    <span style="color: #333">"Kalian semua harus coba WAJIB, ini gue ga bokis rasanya seger."</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="css-jfwi09fn">
                                <div class="css-j88hd2n">
                                    <img class="css-po00nd2" src="{{ asset('assets/images/dedi.png') }}" alt="">
                                </div>
                                <div class="css-66ggb3b">
                                    <p style="font-size: 16px; font-weight: 600; color: #212121;">Deddy Cobuzier</p>
                                    <hr class="mt-0 mb-0 p-0" style="margin-left: 25%;margin-right: 25%;width: 50%;border: 1px solid #146600;">
                                    <p style="font-weight:600;color: #146600;">Customer</p>
                                    <span style="color: #333;">"MaiTea adalah minuman teh yang selalu gue sarankan tiap saat."</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="css-jfwi09fn">
                                <div class="css-j88hd2n">
                                    <img class="css-po00nd2" src="{{ asset('assets/images/anisa.png') }}" alt="">
                                </div>
                                <div class="css-66ggb3b">
                                    <p style="font-size: 16px; font-weight: 600; color: #212121;">Anisa Steviani</p>
                                    <hr class="mt-0 mb-0 p-0" style="margin-left: 25%;margin-right: 25%;width: 50%;border: 1px solid #146600;">
                                    <p style="font-weight:600;color: #146600;">Mitra Bogor</p>
                                    <span style="color: #333;">"Aku sudah jadi Mitra MaiTea sejak launching hingga sekarang."</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination" style="padding-bottom: 20px;"></div>
                </div>
            </div>
        </div>

        <section class="testimoni css-dad09am" style="padding: 0px;">
            <div class="css-cnk32ns">
                <div class="css-dfnn2ka">
                    <div class="css-tes-header" style="width: 100%;">
                        <div>
                            <h3 class="css-cjdkja" style="text-align: center!important;">Testimoni Mitra & Customer <span>MaiTea</span></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 css-margin">
                        <div class="css-cnka2he">
                            <h3 style="color: #212121; font-weight: 700; font-size: 25px;">Doddy Prayogo</h3>
                            <hr class="m-0" style="border-top: 2px solid #146600;">
                            <div class="css-fnk2kjd">Customer</div>
                            <div class="css-fjl2js">
                                <img class="rounded-circle" src="{{ asset('assets/images/dodi.png') }}">
                            </div>
                            <div class="css-wnk3ms" style="border-radius: 10px;">
                                <p class="mt-0 text-white p-3">"Kalian semua harus coba WAJIB, ini gue ga bokis rasanya seger."</p>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 css-margin">
                        <div class="css-cnka2he">
                            <h3 style="color: #212121; font-weight: 700; font-size: 25px;">Deddy Cobuzier</h3>
                            <hr class="m-0" style="border-top: 2px solid #146600;">
                            <div class="css-fnk2kjd">Customer</div>
                            <div class="css-fjl2js">
                                <img class="rounded-circle" src="{{ asset('assets/images/dedi.png') }}">
                            </div>
                            <div class="css-wnk3ms" style="border-radius: 10px;">
                                <p class="mt-0 text-white p-3">"Kalian semua harus coba WAJIB, ini gue ga bokis rasanya seger."</p>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 css-margin">
                        <div class="css-cnka2he">
                            <h3 style="color: #212121; font-weight: 700; font-size: 25px;">Raditya Dika</h3>
                            <hr class="m-0" style="border-top: 2px solid #146600;">
                            <div class="css-fnk2kjd">Customer</div>
                            <div class="css-fjl2js">
                                <img class="rounded-circle" src="{{ asset('assets/images/radit.png') }}">
                            </div>
                            <div class="css-wnk3ms" style="border-radius: 10px;">
                                <p class="mt-0 text-white p-3">"MaiTea adalah minuman teh yang selalu gue sarankan tiap saat."</p>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 css-margin">
                        <div class="css-cnka2he">
                            <h3 style="color: #212121; font-weight: 700; font-size: 25px;">Anisa Steviani</h3>
                            <hr class="m-0" style="border-top: 2px solid #146600;">
                            <div class="css-fnk2kjd">Mitra Bogor</div>
                            <div class="css-fjl2js">
                                <img class="rounded-circle" src="{{ asset('assets/images/anisa.png') }}">
                            </div>
                            <div class="css-wnk3ms" style="border-radius: 10px;">
                                <p class="mt-0 text-white p-3">"Aku sudah jadi Mitra MaiTea sejak launching hingga sekarang."</p>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                                <i class="fas fa-star" style="color: #ffe234;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="content">
            <div class="css-dajk2js mt-4">
                <h3 class="css-cjdkja" style="margin-bottom: 20px;text-align: center;">FAQ (Frequently Asked Questions)</h3>
                <div class="faq-list">
                    <ul id="accordion" class="accordion-container">
                        <li class="content-entry">
                            <div class="article-title">
                                <strong class="css-text-faq1">01</strong>
                                <span class="css-text-faq2">Bagaimana cara memulai bisnis ini?</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla velit tenetur sed? Fugiat culpa cumque quos, deserunt ratione unde reprehenderit modi optio voluptatem consequuntur facere suscipit officia ad assumenda natus.</p>
                            </div>
                        </li>

                        <li class="content-entry">
                            <div class="article-title">
                                <strong class="css-text-faq1">02</strong>
                                <span class="css-text-faq2">Bolehkah harga jual ditentukan sendiri oleh mitra?</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla velit tenetur sed? Fugiat culpa cumque quos, deserunt ratione unde reprehenderit modi optio voluptatem consequuntur facere suscipit officia ad assumenda natus.</p>
                            </div>
                        </li>

                        <li class="content-entry">
                            <div class="article-title">
                                <strong class="css-text-faq1">03</strong>
                                <span class="css-text-faq2">Bagaimana jika Mitra menggunakan bahan baku sendiri?</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="accordion-content" style="padding-left: 48px;">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias voluptatum, sed laborum similique amet provident repellat expedita totam dolor eos dolorem dolorum veritatis labore? Perferendis tempore aliquam optio qui aut?</p>
                            </div>
                        </li>

                        <li class="content-entry">
                            <div class="article-title">
                                <strong class="css-text-faq1">04</strong>
                                <span class="css-text-faq2">Apa Syarat & Ketentuan bergabung dengan Maitea Nusantara?</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="accordion-content" style="padding-left: 48px;">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem rerum, eum sint, repellendus accusantium est doloremque provident quia doloribus totam? Quaerat temporibus omnis corporis unde. Consectetur sit cumque blanditiis.</p>
                            </div>
                        </li>

                        <li class="content-entry">
                            <div class="article-title">
                                <strong class="css-text-faq1">05</strong>
                                <span class="css-text-faq2">Apa yang harus dilakukan jika tertarik bergabung dengan Toko Seru Nusantara?</span>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="accordion-content" style="padding-left: 48px;">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem rerum, eum sint, repellendus accusantium est doloremque provident quia doloribus totam? Quaerat temporibus omnis corporis unde. Consectetur sit cumque blanditiis.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="css-dahk1nbs css-footer" style="margin-top: 15px;">
            <div class="css-fio833na">
                <div class="footer-content">
                    <div class="footer-content-top">
                        <div class="css-sec-top">
                            <div class="css-alamat">
                                <div class="css-fwkn99na">
                                    <a href="">
                                        <img style="width: 150px; height: 95px;" src="{{ asset('assets/images/maitea.png') }}">
                                    </a>
                                </div>
                                <div class="css-fjkw9nw">
                                    <p class="text-dark css-fji09njs mb-2">MAITEA NUSANTARA | MAIAPPS</p>
                                    <p class="text-dark css-fji09njs" style="line-height: 15px;font-weight: 400;">Jl Villa Bogor Indah 5 Cluster Nuri Blok CB 2 No. 5, Ciparigi, Kota Bogor, Jawa Barat 16170</p>
                                </div>
                            </div>
                            <p class="text-dark css-fji09njs" style="margin-bottom: 1.25rem;">Coba GRATIS Aplikasi MaiApps</p>
                            <!-- <div class="css-ionf77fb"> -->
                                <!-- <div style="background: #000; border: 1px solid #fff; border-radius: 8px;"> -->
                                    <img style="width: 170px; height: 50px;" src="{{ asset('assets/images/google_play.png') }}" alt="">
                                <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <div></div>
                    </div>
                    <div class="footer-content-bottom">
                        <div class="text-center">
                            <p class="text-dark css-fji09njs" style="margin-bottom: 1.25rem;">Ikuti Kami :</p>
                            <div class="text-center">
                                <div style="display: inline-flex">
                                    <a href="#" style="margin: 0.25rem;">
                                        <img src="{{ asset('assets/images/ic_ig.svg') }}" alt="">
                                    </a>
                                    <a href="#" style="margin: 0.25rem;">
                                        <img src="{{ asset('assets/images/ic_tt.svg') }}" alt="">
                                    </a>
                                    <a href="#" style="margin: 0.25rem;">
                                        <img src="{{ asset('assets/images/ic_fb.svg') }}" alt="">
                                    </a>
                                    <a href="#" style="margin: 0.25rem;">
                                        <img src="{{ asset('assets/images/ic_yt.svg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-year">
                    <p class="text-dark text-center css-fji09njs">All Right Reserved &copy; Toko Indonesia Seru 2023</p>
                </div>
            </div>
        </section>

        <section class="mobile-hidden">
            <div class="css-ehkd3ka">
                <div class="d-flex justify-content-between">
                    <img class="img-fluid" style="width: 280px" src="{{ asset('assets/images/banner_body_1.png') }}" alt="">
                    <div class="css-git4knd">
                        <span style="font-size: 20px;">MaiTea Nusantara | MaiApps</span><br><br>
                        Villa Bogor Indah 5 Cluster Nuri<br>
                        Blok CB 2 No. 5<br>
                        Bogor - Indonesia<br><br>
                        support@tokoseru.com
                    </div>
                    <div class="css-git4knd" style="padding-left: 0px;">
                        Follow Us :<br><br>
                        <div class="d-flex align-items-center">
                            <img class="mr-2" width="30" src="{{ asset('assets/images/ic_ig.png') }}">
                            <img class="mr-2" width="30" src="{{ asset('assets/images/ic_tt.png') }}">
                            <img class="mr-2" width="30" src="{{ asset('assets/images/ic_fb.png') }}">
                            <img class="mr-2" width="30" src="{{ asset('assets/images/ic_yt.png') }}">
                        </div>
                        <div class="text-right css-git4knd" style="padding-left: 0px;">
                            <div>Privacy Policy</div>
                            <div>Terms and Conditions</div>
                        </div>
                    </div>
                </div>
                <div class="text-right text-white css-git4knd" style="margin-bottom: 30px;padding-left: 0px;padding-top: 70px;">
                    <div style="float: right;width: 12.5%;border: 1px solid #fff"></div>
                    <div style="padding-top: 10px; padding-bottom: 15px">All Right Reserved &copy; Toko Indonesia Seru 2023</div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        
        <script>
            var swiper = new Swiper(".mySwiper", {
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            $(function() {
                    var Accordion = function(el, multiple) {
                        this.el = el || {};
                        this.multiple = multiple || false;

                        var links = this.el.find('.article-title');
                        links.on('click', {
                            el: this.el,
                            multiple: this.multiple
                        }, this.dropdown)
                    }

                    Accordion.prototype.dropdown = function(e) {
                        var $el = e.data.el;
                        $this = $(this),
                            $next = $this.next();

                        $next.slideToggle();
                        $this.parent().toggleClass('open');

                        if (!e.data.multiple) {
                            $el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
                        };
                    }
                    var accordion = new Accordion($('.accordion-container'), false);
                });
        </script>
    </body>
</html>