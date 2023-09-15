@if ($item['submenu'] === [])
    @can($item['permission'])
        <!--begin:Menu item-->
        <div class="menu-item">
            <a class="menu-link" @if ($item['route'] !== '') href="{{ route($item['route']) }}" @endif>
                <span class="menu-icon">
                    <!--begin::Svg Icon , 'icon-lg' -->
                    <span class="svg-icon svg-icon-2">
                        @if ($item['icon'] !== '')
                            <?php print $item['icon']; ?>
                        @endif
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-title">{{ trans_choice($item['name'], 2) }}</span>
            </a>
        </div>
        <!--end:Menu item-->
    @endcan
@else
    @can($item['permission'])
        <!--begin:Menu link-->
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-icon">
                    <!--begin::Svg Icon-->
                    <span class="svg-icon svg-icon-2">
                        @if ($item['icon'] !== '')
                            <?php print $item['icon']; ?>
                        @endif
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-title">@lang($item['name'])</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                @foreach ($item['submenu'] as $submenu)
                    @include('tenant.layouts.admin.layout.partials.sidebar.___menu', [
                        'submenu' => $submenu,
                    ])
                @endforeach
            </div>
        </div>
        <!--end:Menu link-->
    @endcan
@endif
