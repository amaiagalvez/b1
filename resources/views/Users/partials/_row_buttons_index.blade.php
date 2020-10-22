<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('users.edit', $user->id) }}" title="{{trans('basics::action.edit')}}">
        <span class="fa fa-edit"></span>
    </a>

    @if($user->canDelete())
        <form action="{{ route('users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-table btn-delete" title="{{trans('basics::action.delete')}}"
                    onclick="return confirm('{{trans('basics::action.delete_confirmation')}}'); "><span
                        class="fa fa-trash"></span></button>
        </form>
    @else
        <a class="btn btn-table" href="{{ route('users.deactivate', $user->id) }}"
           title="{{trans('basics::action.deactivate')}}"
           onclick="return confirm('{{trans('basics::action.deactivate_confirmation')}}'); ">
            <span class="fa fa-times"></span>
        </a>
    @endif

    @if(auth()->user()->isDeveloper())
        <a class="btn btn-table" href="{{ route('dev.users.loginAs', $user->id) }}"
           title="{{trans('basics::auth.loginAs')}}">
            <span class="fa fa-user-secret"></span>
        </a>
    @endif

    @if(!$user->isActivated())
        <a class="btn btn-table" href="#"
           title="{{trans('basics::auth.resend_activation_email')}}"
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
