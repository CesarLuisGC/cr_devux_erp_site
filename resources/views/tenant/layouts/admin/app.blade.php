<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--begin::Head-->

<head>
    <base href="" />
    <title> {{ config('app.name') }} @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />

    <link rel="shortcut icon" href="{{ asset('assets/shared/media/logos/favicon.ico') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/metronic/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/metronic/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/metronic/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>

    @yield('style')

    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on"
    data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">
    <!--layout-partial:partials/theme-mode/_init.html-->
    @include('tenant.layouts.admin.partials.theme-mode._init')

    <!--layout-partial:layout/partials/_page-loader.html-->
    @include('tenant.layouts.admin.layout.partials._page-loader')

    <!--layout-partial:layout/_default.html-->
    @include('tenant.layouts.admin.layout._default')

    <!--layout-partial:partials/_scrolltop.html-->
    @include('tenant.layouts.admin.partials._scrolltop')

    <!--begin::Modals-->
    <!--layout-partial:partials/modals/_upgrade-plan.html-->
    <!--layout-partial:partials/modals/create-app/_main.html-->
    <!--layout-partial:partials/modals/_new-target.html-->
    <!--layout-partial:partials/modals/_view-users.html-->
    <!--layout-partial:partials/modals/users-search/_main.html-->
    <!--layout-partial:partials/modals/_invite-friends.html-->
    <!--end::Modals-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('') }}";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/metronic/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/scripts.bundle.js') }}"></script>

    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/metronic/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('assets/metronic/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/metronic/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/custom/widgets.js') }}"></script>

    <script src="{{ asset('assets/metronic/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('assets/metronic/js/custom/utilities/modals/users-search.js') }}"></script>

    <script>
        //Notifications - livewire
        window.addEventListener('message', ({
            detail: {
                type,
                title,
                message
            }
        }) => {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toastr-bottom-right",
                "preventDuplicates": false,
                "showDuration": "400",
                "hideDuration": "1500",
                "timeOut": "5000",
                "extendedTimeOut": "1500",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            switch (event.detail.type) {
                case 'info':
                    toastr.info(
                        event.detail.message ? event.detail.message : `@lang('global_notification.messageInfo')`,
                        event.detail.title ? event.detail.title : `@lang('global_notification.typeInfo')`
                    );
                    break;
                case 'success':
                    toastr.success(
                        event.detail.message ? event.detail.message : `@lang('global_notification.messageSuccess')`,
                        event.detail.title ? event.detail.title : `@lang('global_notification.typeSuccess')`
                    );
                    break;
                case 'warning':
                    toastr.warning(
                        event.detail.message ? event.detail.message : `@lang('global_notification.messageWarning')`,
                        event.detail.title ? event.detail.title : `@lang('global_notification.typeWarning')`
                    );
                    break;
                case 'error':
                    /**
                     * A diferencia de la notificación success, nunca mostramos el error crudo (Ya quedo registrado en DB), únicamente se informa al usuario.
                     **/
                    toastr.error(
                        `@lang('global_notification.messageError')`,
                        `@lang('global_notification.typeError')`
                    );
                    break;
                default:
                    toastr.error(
                        "Uncontrolled message!", event.detail.title ? event.detail.title :
                        `@lang('global_notification.typeWarning')`
                    );
            }
        });

        //Notifications - with();
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toastr-bottom-right",
                "preventDuplicates": false,
                "showDuration": "400",
                "hideDuration": "1500",
                "timeOut": "5000",
                "extendedTimeOut": "1500",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            switch ("{{ Session::get('type') }}") {
                case 'info':
                    toastr.info("{{ Session::get('message') }}", "{{ Session::get('title') }}" ?
                        "{{ Session::get('title') }}" : `@lang('global_notification.typeInfo')`);
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}" ? "{{ Session::get('message') }}" :
                        `@lang('global_notification.messageSuccess')`,
                        "{{ Session::get('title') }}" ? "{{ Session::get('title') }}" : `@lang('global_notification.typeSuccess')`);
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}", "{{ Session::get('title') }}" ?
                        "{{ Session::get('title') }}" : `@lang('global_notification.typeWarning')`);
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}" ? "{{ Session::get('message') }}" : `@lang('global_notification.messageError')`,
                        "{{ Session::get('title') }}" ? "{{ Session::get('title') }}" :
                        `@lang('global_notification.typeError')`);
                    break;
                default:
                    toastr.error("Uncontrolled message!", "{{ Session::get('title') }}" ? "{{ Session::get('title') }}" :
                        `@lang('global_notification.typeError')`);
            }
        @endif
    </script>

    <script>
        window.addEventListener('swal.inactiveChecked', function(event) {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.icon,
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: `@lang('global_button.apply')`,
                cancelButtonText: `@lang('global_button.cancel')`,
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('inactiveCheckedRows', event.detail.checkedIds);
                }
            });
        })
    </script>

    @livewireScripts

    @yield('javascript')

    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
