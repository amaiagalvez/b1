@section ('form_right')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title theme-color"><i class="fas fa-sign-out-alt"></i> {{trans_choice('users.session', 2)}}
            </h5>
        </div>

        <div class="card-body">
            <ul style="list-style-type:none;">
                @foreach($user->sessions->sortByDesc('login_at') AS $usession)
                    <li class="text-decoration-none">
                        {{getDataTime($usession->login_at)}}
                        @if(!empty($usession->logout_at))
                            / {{getDataTime($usession->logout_at)}}
                            [ {{$usession->total}} ]
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
