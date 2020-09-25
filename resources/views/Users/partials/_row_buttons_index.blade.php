<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('users.edit', $user->id) }}" title="{{trans('users::users.edit')}}">
        <span class="fa fa-edit"></span>
    </a>

    @if($user->canDelete())
        <form action="{{ route('users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-table btn-delete" title="{{trans('users::users.delete')}}"
                    onclick="return confirm('{{trans('users::users.delete_confirmation')}}'); "><span
                        class="fa fa-trash"></span></button>
        </form>
    @else
        <a class="btn btn-table" href="{{ route('users.deactivate', $user->id) }}"
           title="{{trans('users::users.deactivate')}}"
           onclick="return confirm('{{trans('users::users.deactivate_confirmation')}}'); ">
            <span class="fa fa-times"></span>
        </a>
    @endif

    @isDeveloper
    <a class="btn btn-table" href="{{ route('dev.users.loginAs', $user->id) }}"
       title="{{trans('auth.loginAs')}}">
        <span class="fa fa-user-secret"></span>
    </a>
    @endisDeveloper

    @if(!$user->isActivated())
        <a class="btn btn-table" href="#"
           title="{{trans('auth.resend_activation_email')}}"
           onclick='document.getElementById("resend-form-{{$user->id}}").submit();'>
            <i class="fas fa-envelope"></i>
        </a>

        <form id="resend-form-{{$user->id}}" action="{{ route('verification.resend', ['user_id' => $user->id]) }}"
              method="POST"
              style="display: none;">
            @csrf
        </form>
    @endif
</div>
