<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
            aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
            @auth()
                <li class="nav-item dropdown @if(session()->has('real_user'))  ko-color @endif">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user-circle"></i> {{ Auth::user()->name ?? ''}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="{{route('users.profile')}}">
                            <i class="fas fa-user-edit"></i> {{trans('basics::basics.profile')}}
                        </a>
                    </div>
                </li>
            @else
                login
            @endif
        </ul>
    </div>
</nav>


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
                            <i class="fas fa-sign-out-alt ko-color"></i> {{trans('basics::auth.logoutAs')}}
                        </a>
                    @else
                        <a class="dropdown-item not-text-decoration" href="#"
                           onclick="document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{trans('basics::auth.logout')}}
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
