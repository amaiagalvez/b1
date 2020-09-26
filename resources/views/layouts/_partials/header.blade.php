<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto " type="button" data-target="#sidebar"
                data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show"><span class="c-header-toggler-icon"></span></button>

        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link dropdown-toggle" data-toggle="dropdown"
                                                      href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class=" @if(session()->has('real_user'))  ko-color @endif">
                        <i class="far fa-user-circle"></i> {{ Auth::user()->name ?? ''}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-left pt-0" aria-labelledby="navbarDropdown">


                    <a class="dropdown-item not-text-decoration" href="{{route('users.profile')}}">
                        <i class="fas fa-user-edit"></i> {{trans('basics::basics.profile')}}
                    </a>

                    @if(session()->has('real_user'))
                        <a class="dropdown-item not-text-decoration ko-color" href="{{route('dev.users.logoutAs')}}">
                            <i class="fas fa-sign-out-alt ko-color"></i> {{trans('auth.logoutAs')}}
                        </a>
                    @else
                        <a class="dropdown-item not-text-decoration" href="#"
                           onclick="document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{trans('auth.logout')}}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </li>
        </ul>

        @yield('breadcrumb_list')

    </header>

{{-- div closed in menu blade --}}
