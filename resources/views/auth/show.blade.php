@extends('layouts._base.app')

@section('title', trans('front.profile'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 bg-light shadow-sm">
                    <img src="{{$user->getAvatar()}}" alt="{{$user->name}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-tilte">
                            {{$user->name}}
                        </h5>

                        <div v-if="check && currentUser.id != {{ $user->id }}">
                            <friendship-request-btn status="{{ $friendshipStatus }}"
                                                    :recipient="{{ $user }}">
                            </friendship-request-btn>
                        </div>
                    </div>

                    <div class="card-title" v-if="check && currentUser.id === {{ $user->id }}">
                        <a href="{{route('front.friendships.index', Auth::user())}}" class="btn btn-secondary">
                            {{trans('front.my_friendship_list')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 bg-light shadow-sm">
                    <div class="card-body">
                        <status-list
                            url= {{route('front.users.index', $user)}}>
                        </status-list>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
