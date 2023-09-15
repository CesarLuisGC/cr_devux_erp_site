<!--begin::loader-->
<div class="page-loader flex-column">
    <img alt="Logo" class="theme-light-show max-h-50px"
        src="{{ asset('assets/shared/media/logos/default-loader.png') }}" />
    <img alt="Logo" class="theme-dark-show max-h-50px"
        src="{{ asset('assets/shared/media/logos/default-loader.png') }}" />
    <div class="d-flex align-items-center mt-5">
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-muted fs-6 fw-semibold ms-5">@lang('syst_label.loading')...</span>
    </div>
</div>
<!--end::Loader-->
