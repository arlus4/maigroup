            <!--start::Menu-->
            <div class="menu menu-column menu-gray-600 menu-active-primary menu-hover-light-primary menu-here-light-primary menu-show-light-primary fw-semibold mb-3" data-kt-menu="true" id="menu">
                <div class="menu">
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_order') ? 'active' : '' }}" href="{{ route('admin.admin_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-basket2 fs-3"></i>
                            </span>
                            <span class="menu-title">New Order</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_waiting_payment_order') ? 'active' : '' }}" href="{{ route('admin.admin_waiting_payment_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-cash-stack fs-3"></i>
                            </span>
                            <span class="menu-title">Waiting Payment</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_payment_received_order') ? 'active' : '' }}" href="{{ route('admin.admin_payment_received_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-cash-coin fs-3"></i>
                            </span>
                            <span class="menu-title">Payment Received</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_approve_order') ? 'active' : '' }}" href="{{ route('admin.admin_approve_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-calendar2-check fs-3"></i>
                            </span>
                            <span class="menu-title">Approve Order</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_deliver_order') ? 'active' : '' }}" href="{{ route('admin.admin_deliver_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-truck fs-3"></i>
                            </span>
                            <span class="menu-title">Deliver Order</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('admin.admin_rejected_order') ? 'active' : '' }}" href="{{ route('admin.admin_rejected_order') }}">
                            <span class="menu-icon">
                                <i class="bi bi-exclamation-diamond fs-3"></i>
                            </span>
                            <span class="menu-title">Rejected Order</span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                </div>
            </div>
            <!--end::Menu-->