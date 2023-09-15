<!--begin::Logo-->
<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="?page=index">
        <img alt="Logo" src="{{ asset('assets/shared/media/logos/default-sidebar.png') }}"
            class="h-25px app-sidebar-logo-default theme-light-show" />
        <img alt="Logo" src="{{ asset('assets/shared/media/logos/default-sidebar-small.png') }}"
            class="h-25px app-sidebar-logo-default theme-dark-show" />
        <img alt="Logo" src="{{ asset('assets/shared/media/logos/default-sidebar-small.png') }}"
            class="h-20px app-sidebar-logo-minimize" />
    </a>
    <!--end::Logo image-->
    <!--begin::Sidebar toggle-->
    <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
     -->
    <div id="kt_app_sidebar_toggle"
        class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate "
        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
        data-kt-toggle-name="app-sidebar-minimize">
        <i class="ki-duotone ki-double-left fs-2 rotate-180"><span class="path1"></span><span
                class="path2"></span></i>
    </div>
    <!--end::Sidebar toggle-->
</div>
<!--end::Logo-->
