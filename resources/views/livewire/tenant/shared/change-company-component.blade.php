<!--begin:Menu item-->
<div class="d-flex align-items-center">
    <!--begin::Label-->
    <span class="fs-7 fw-bold text-gray-700 pe-4 text-nowrap d-none d-xxl-block">
        {{ trans_choice('buss_company.company', 1) }}:</span>
    <!--end::Label-->

    <!--begin::Toggle-->
    <button type="button"
        class="btn btn-flex btn-active-color-primary align-items-cenrer justify-content-center justify-content-md-between align-items-lg-cenrer flex-md-content-between bg-white bg-opacity-10 btn-color-gray-500 px-0 ps-md-6 pe-md-5 h-30px w-30px h-md-35px w-md-300px"
        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
        <span class="d-none d-md-inline">{{ $mainCompanyName }}</span>
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
        <span class="svg-icon svg-icon-4 ms-md-4 me-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </button>
    <!--end::Toggle-->
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg fw-bold w-300px pb-3"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content fs-7 text-dark fw-bolder px-3 py-4">
                @lang('syst_label.selectCompany')
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator mb-3 opacity-75"></div>
        <!--end::Menu separator-->
        @foreach ($myCompanies as $company)
            <!--begin::Menu item-->
            <div class="menu-item px-3" wire:click="changeCompany({{ $company->country_id }},{{ $company->id }})">
                <a href="#" class="menu-link px-3">{{ $company->id . ' - ' . $company->name }}</a>
            </div>
            <!--end::Menu item-->
        @endforeach
    </div>
    <!--end::Menu-->
</div>
<!--end:Menu item-->
