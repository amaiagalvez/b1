<div class="c-sidebar-brand">
    <a href="{{route('basics.home')}}">
        <img class="c-sidebar-brand-full" src="{{ asset('images/logo.png') }}" width="auto" height="46"
             alt="{{ $app_name }}">
        <img class="c-sidebar-brand-minimized" src="{{ asset('images/logo_small.png') }}" width="auto" height="46"
             alt="{{ $app_name }}">
    </a>
</div>

<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        &nbsp;
    </li>
    @foreach($applications AS $application)

        <li class="c-sidebar-nav-item">
            <span class="c-sidebar-nav-link c-sidebar-nav-divider text-uppercase">
                <strong>{{$application['title']}}</strong>
            </span>
        </li>

        @foreach($menus->where('application_id', $application['id']) AS $menu)
            @if($menu->route !== '#')
                <li class="c-sidebar-nav-item">
                    <a class="not-text-decoration c-sidebar-nav-link" href="{{route($menu->route)}}">
                        <i class="c-sidebar-nav-icon {{$menu->icon}}"></i> {{trans_choice($menu->name,2)}}
                    </a>
                </li>
            @else
                <li class="c-sidebar-nav-dropdown">
                    <a class="not-text-decoration c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="c-sidebar-nav-icon {{$menu->icon}}"></i> {{trans_choice($menu->name,2)}}
                    </a>

                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach($menu->submenus AS $submenu)
                            <li class="c-sidebar-nav-item">
                                <a class="not-text-decoration c-sidebar-nav-link" href="{{route($submenu->route)}}">
                                    <i class="{{$submenu->icon}}"></i> {{trans_choice($submenu->name,2)}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    @endforeach
</ul>

<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>

{{-- the header blade div end --}}
</div>
