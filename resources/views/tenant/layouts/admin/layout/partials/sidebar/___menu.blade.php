@if ($submenu['submenu'] == [])
    @can($submenu['permission'])
        <div class="menu-item">
            <a class="menu-link py-3" @if ($submenu['route'] !== '') href="{{ route($submenu['route']) }}" @endif>
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ trans_choice($submenu['name'], 2) }}</span>
            </a>
        </div>
    @endcan
@else
    @can($submenu['permission'])
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ trans_choice($submenu['name'], 2) }}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                @foreach ($submenu['submenu'] as $submenu)
                    @if ($submenu['submenu'] == [])
                        @can($submenu['permission'])
                            <div class="menu-item">
                                <a class="menu-link py-3"
                                    @if ($submenu['route'] !== '') href="{{ route($submenu['route']) }}" @endif>
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice($submenu['name'], 2) }}</span>
                                </a>
                            </div>
                        @endcan
                    @else
                        @can($submenu['permission'])
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                <span class="menu-link">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ trans_choice($submenu['name'], 2) }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    @foreach ($submenu['submenu'] as $submenu)
                                        @include('tenant.layouts.admin.layout.partials.sidebar.___menu', [
                                            'submenu' => $submenu,
                                        ])
                                    @endforeach
                                </div>
                            </div>
                        @endcan
                    @endif
                @endforeach
            </div>
        </div>
    @endcan
@endif
