@extends('owner/layout-sidebar/app')

@section('content')
    <div class="app-content  flex-column-fluid ">
        <div class="app-container  container-xxl ">
            <h2 class="py-3 py-lg-6">Pengaturan Akun</h2>
            <div class="card mb-5 mb-xl-10" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-body pt-5 pb-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-label fw-bold text-gray-800 pb-4">Informasi Umum</h3>
                        <a href="{{ route('owner.owner_edit_profile', ['username' => Auth::user()->username]) }}" class="btn align-items-end text-white" style="height:28px;padding: 5px 12px;font-size:12px;background: #039344;" fdprocessedid="fc3kcs">
                            <i class="fas fa-pencil text-white"></i>
                            Edit
                        </a>
                    </div>
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset($dataUser->path_avatar ?? 'assets/images/avatar.png') }}" alt="image">
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <div class="card-body p-3 pt-0">
                                <div class="row mb-4">
                                    <label class="col-lg-4 fw-bold text-muted">Nama</label>
                                    <div class="col-lg-8">                    
                                        <span class="fw-semibold fs-6 text-gray-800">{{ $dataUser->name }}</span>                
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-lg-4 fw-bold text-muted">Username</label>
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $dataUser->username }}</span>                         
                                    </div>
                                </div>
                                <div class="row mb-4">
                                   <label class="col-lg-4 fw-bold text-muted">
                                        No HP

                                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                </span>              
                                    </label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold fs-6 text-gray-800 me-2">{{ $dataUser->no_hp }}</span> 
                                        <span style="color: #fff;border-radius: 5px;padding: 2px 15px;font-size: 10px;background: #039344;font-weight: 600;">Nomor Aktif</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-lg-4 fw-bold text-muted">Jenis Kelamin</label>
                                    <div class="col-lg-8">
                                        <a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $dataUser->jenis_kelamin === 'P' ? 'Pria' : ($dataUser->jenis_kelamin === 'W' ? 'Wanita' : $dataUser->jenis_kelamin) }}</a>                         
                                    </div>
                                </div>
                                <div class="row mb-4">
                                     <label class="col-lg-4 fw-bold text-muted">
                                        Email
                                        
                                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Country of origination" data-bs-original-title="Country of origination" data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                </span>
                                    </label>
                                    <div class="col-lg-8">
                                        <span class="fw-semibold fs-6 text-gray-800 me-2">{{ $dataUser->email }}</span> 
                                        <span style="color: #fff;border-radius: 5px;padding: 2px 15px;font-size: 10px;background: #039344;font-weight: 600;">Terverifikasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5 mb-xl-10" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 6px 0px;">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="card-label fw-bold text-gray-800 pb-4">Keamanan</h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="d-flex flex-wrap align-items-center">
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bold mb-1">Email Address</div>
                                <div class="fw-semibold text-gray-600">{{ $dataUser->email }}</div>
                            </div>
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <form id="kt_signin_change_email" class="form" action="#" method="POST">
                                    <div class="d-flex">
                                        <button id="kt_signin_submit" type="submit" class="btn btn-primary me-2 px-6">
                                            Update Email
                                        </button>
                                        <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn bg-white"></button>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-6"></div>
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div id="kt_signin_password" data-password-saat-ini="{{ $dataUser->password }}">
                                <div class="fs-6 fw-bold mb-1">Password</div>
                                <div class="fw-semibold text-gray-600">************</div>
                            </div>
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <form id="kt_signin_change_password" class="form" action="{{ route('owner.owner_update_password', ['username' => Auth::user()->username] ) }}" method="POST">
                                    @csrf
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="current_password" class="form-label fs-6 fw-bold mb-3">Kata Sandi Saat Ini</label>
                                                <input type="password" class="form-control form-control-lg" name="current_password" id="current_password"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="password" class="form-label fs-6 fw-bold mb-3">Password Baru</label>
                                                <input type="password" class="form-control form-control-lg" name="password" id="password"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="password_confirmation" class="form-label fs-6 fw-bold mb-3" >Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">
                                        Kata sandi minimal harus 8 karakter
                                    </div>
                                    <div class="d-flex">
                                        <button id="kt_password_cancel" type="button" class="css-ca2jq0s">
                                            Batalkan
                                        </button>
                                        <button id="kt_password_submit" type="submit" class="css-kl2kd9a" style="background: #039344;">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn text-white" style="padding: 5px 12px;font-size:12px;background: #d90429;">
                                    <i class="fas fa-key text-white"></i>
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
