<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
        <!--layout-partial:partials/search/_dropdown.html-->
        @include('tenant.layouts.admin.partials.search._dropdown')
    </div>
    <!--end::Search-->
    <!--begin::Activities-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <!--begin::Drawer toggle-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
            id="kt_activities_toggle">
            <i class="ki-duotone ki-notification-on fs-2 fs-lg-1"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span><span class="path4"></span><span
                    class="path5"></span></i>
        </div>
        <!--end::Drawer toggle-->
    </div>
    <!--end::Activities-->
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <!--begin::Menu- wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
            <i class="ki-duotone ki-notification-status fs-2 fs-lg-1"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
        </div>
        <!--layout-partial:partials/menus/_notifications-menu.html-->
        @include('tenant.layouts.admin.partials.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Chat-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative"
            id="kt_drawer_chat_toggle">
            <i class="ki-duotone ki-message-text-2 fs-2 fs-lg-1"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span></i>
            <span
                class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink">
            </span>
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::My apps links-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <!--begin::Menu wrapper-->
        <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <i class="ki-duotone ki-element-11 fs-2 fs-lg-1"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
        </div>
        <!--layout-partial:partials/menus/_my-apps-menu.html-->
        <!--end::Menu wrapper-->
    </div>
    <!--end::My apps links-->
    <!--begin::Theme mode-->
    <div class="app-navbar-item ms-1 ms-md-3">
        <!--layout-partial:partials/theme-mode/_main.html-->
        @include('tenant.layouts.admin.partials.theme-mode._main')
    </div>
    <!--end::Theme mode-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img src="{{ asset('assets/shared/media/img/avatars/default_boy.png') }}" alt="user" />
        </div>
        <!--layout-partial:partials/menus/_user-account-menu.html-->
        @include('tenant.layouts.admin.partials.menus._user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
        <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
            <i class="ki-duotone ki-element-4 fs-1"><span class="path1"></span><span class="path2"></span></i>
        </div>
    </div>
    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->
