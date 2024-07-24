@extends('layout-master/app')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Detail Notification</h1>
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

        <div class="row gy-5 g-xl-10">
            <div class="col-xxl-6">
                <div class="row gx-5 gx-xl-10">
                    <div class="col-sm-6 mb-5 mb-xl-10">
                        <div class="card card-flush h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Platform Statistics</span>
                                </h3>
                            </div>
                            <div class="card-body pt-5">
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Google Analytics</a>
                                    <!--end::Title-->
                                    <!--begin::Action-->
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z" fill="currentColor" />
                                                <rect x="21.9497" y="3.46448" width="13" height="2" rx="1" transform="rotate(135 21.9497 3.46448)" fill="currentColor" />
                                                <path d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--end::Action-->
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Facebook Ads</a>
                                    <!--end::Title-->
                                    <!--begin::Action-->
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z" fill="currentColor" />
                                                <rect x="21.9497" y="3.46448" width="13" height="2" rx="1" transform="rotate(135 21.9497 3.46448)" fill="currentColor" />
                                                <path d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--end::Action-->
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <!--begin::Title-->
                                    <a href="#" class="text-primary opacity-75-hover fs-6 fw-semibold">Seranking</a>
                                    <!--end::Title-->
                                    <!--begin::Action-->
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z" fill="currentColor" />
                                                <rect x="21.9497" y="3.46448" width="13" height="2" rx="1" transform="rotate(135 21.9497 3.46448)" fill="currentColor" />
                                                <path d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--end::Action-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-5 mb-xl-10">
                        <div class="card card-flush h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Delivery Statistics</span>
                                </h3>
                            </div>
                            <div class="card-body pt-5">
                                <div class="d-flex flex-stack">
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">Total Sent</div>
                                    <div class="d-flex align-items-senter">
                                        <span id="total_sent" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <span class="badge badge-success">
                                        <div class="fw-bold fs-6 me-2">Delivered</div>
                                    </span>
                                    <div class="d-flex align-items-senter">
                                        <span id="delivered" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <span class="badge badge-danger">
                                        <div class="fw-bold fs-6 me-2">Failed</div>
                                    </span>
                                    <div class="d-flex align-items-senter">
                                        <span id="failed" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <span class="badge badge-light-danger">
                                        <div class="fw-bold fs-6 me-2">Unsubscribed</div>
                                    </span>
                                    <div class="d-flex align-items-senter">
                                        <span id="unsubscribed" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <span class="badge badge-light-warning">
                                        <div class="fw-bold fs-6 me-2">Remaining</div>
                                    </span>
                                    <div class="d-flex align-items-senter">
                                        <span id="remaining" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <span class="badge badge-light-dark">
                                        <div class="fw-bold fs-6 me-2">Capped</div>
                                    </span>
                                    <div class="d-flex align-items-senter">
                                        <span id="capped" class="text-gray-900 fw-bolder fs-6">...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-5 g-xl-10">
            <div class="col-xl-8 mb-xl-10">
                <div class="card card-flush h-lg-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Message Settings</span>
                        </h3>
                    </div>
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold fs-4">Audience</label>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Total number of recipients</label>
                            <div class="col-lg-8 fv-row">
                                <span id="total_recipients" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold fs-4">Schedule</label>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Start sending</label>
                            <div class="col-lg-8 fv-row">
                                <span id="start_sending" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Per user optimization</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="per_user_optimization" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold fs-4">Message</label>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Title</label>
                            <div class="col-lg-8 fv-row">
                                <span id="message_title" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Message</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="message_body" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold fs-4">Google Android</label>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Sound</label>
                            <div class="col-lg-8">
                                <span id="android_sound" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Big Picture</label>
                            <div class="col-lg-8">
                                <span id="android_big_picture" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Lockscreen Visibility</label>
                            <div class="col-lg-8">
                                <span id="android_lockscreen_visibility" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Channel Mode</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span id="android_channel_mode" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold fs-4">Advanced Settings</label>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Priority</label>
                            <div class="col-lg-8 fv-row">
                                <span id="advanced_priority" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                        <div class="row mb-10">
                            <label class="col-lg-4 fw-semibold text-muted">Time To Live</label>
                            <div class="col-lg-8">
                                <span id="advanced_ttl" class="fw-semibold text-gray-800 fs-6">...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 mb-5 mb-xl-10">
                <div class="card h-md-100">
                    <div class="card-body d-flex flex-column flex-center">
                        <div class="mb-2">
                            <h1 class="fw-semibold text-gray-800 text-center lh-lg">Lorem ipsum dolor
                                <br /> sit amet consectetur adipisicing elit.
                                <span class="fw-bolder">Molestiae, totam ?</span>
                            </h1>
                            <div class="py-10 text-center">
                                <img src="{{ asset('assets/master/media/svg/illustrations/easy/1.svg') }}" class="theme-light-show w-200px" alt="" />
                                <img src="{{ asset('assets/master/media/svg/illustrations/easy/1-dark.svg') }}" class="theme-dark-show w-200px" alt="" />
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const notificationId = "{{ $id }}";

            $.ajax({
                url: `/admin/setting/notification/get_detailNotifications/${notificationId}`,
                method: 'GET',
                success: function(response) {
                    $('#total_sent').text(response.successful);
                    $('#delivered').text(response.platform_delivery_stats.android.successful);
                    $('#failed').text(response.failed);
                    $('#unsubscribed').text(response.include_unsubscribed ? 'Yes' : 'No');
                    $('#remaining').text(response.remaining);
                    $('#capped').text(response.fcap_status);

                    $('#total_recipients').text(response.include_player_ids ? response.include_player_ids.length : 0);
                    $('#start_sending').text(new Date(response.queued_at * 1000).toLocaleString());
                    $('#per_user_optimization').text(response.android_accent_color ? 'Yes' : 'No');
                    
                    $('#message_title').text(response.headings.en);
                    $('#message_body').text(response.contents.en);
                    
                    $('#android_sound').text(response.android_sound);
                    $('#android_big_picture').text(response.big_picture);
                    $('#android_lockscreen_visibility').text(response.android_visibility);
                    $('#android_channel_mode').text(response.priority);
                    
                    $('#advanced_priority').text(response.priority);
                    $('#advanced_ttl').text(response.ttl);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection