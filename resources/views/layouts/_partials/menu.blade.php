<div class="c-sidebar-brand">
    <a href="{{route('admin.home')}}">
        <img class="c-sidebar-brand-full" src="{{ asset('images/logo.png') }}" width="auto" height="46"
             alt="{{env('APP_NAME', '')}}">
        <img class="c-sidebar-brand-minimized" src="{{ asset('images/logo_small.png') }}" width="auto" height="46"
             alt="{{env('APP_NAME', '')}}">
    </a>
</div>

<ul class="c-sidebar-nav">

    <li class="c-sidebar-nav-title">
        <a class="not-text-decoration c-sidebar-nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-laptop-house"></i> {{trans('admin.home')}}
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="not-text-decoration c-sidebar-nav-link" href="{{route('front.home')}}" target="_blank">
            <i class="fas fa-link"></i> Web
        </a>
    </li>

    @foreach($menus AS $menu)
        @if($menu->route !== '#')
            <li class="c-sidebar-nav-item">
                <a class="not-text-decoration c-sidebar-nav-link" href="{{route($menu->route)}}">
                    <i class="c-sidebar-nav-icon {{$menu->icon}}"></i> {{trans_choice('admin.'.$menu->name,2)}}
                </a>
            </li>
        @else
            <li class="c-sidebar-nav-dropdown">
                <a class="not-text-decoration c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="c-sidebar-nav-icon {{$menu->icon}}"></i> {{trans_choice('admin.'.$menu->name,2)}}
                </a>

                <ul class="c-sidebar-nav-dropdown-items">
                    @foreach($menu->submenus AS $submenu)
                        <li class="c-sidebar-nav-item">
                            <a class="not-text-decoration c-sidebar-nav-link" href="{{route($submenu->route)}}">
                                <i class="{{$submenu->icon}}"></i> {{trans_choice('admin.'.$submenu->name,2)}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach

    @if(auth()->user()->isDeveloper())
    <li class="c-sidebar-nav-dropdown">
        <a class="not-text-decoration c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon fas fa-cogs"></i> Garapena
        </a>

        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="not-text-decoration c-sidebar-nav-link" href="#">
                    <i class="fas fa-code-branch"></i> {{trans_choice('admin.version',2)}}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="not-text-decoration c-sidebar-nav-link" href="#">
                        <i class="fab fa-elementor"></i> {{trans_choice('admin.menu',2)}}
                    </a>
                </li>
        </ul>
    </li>
    @endif
</ul>

<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>

{{-- the header blade div end --}}
</div>
