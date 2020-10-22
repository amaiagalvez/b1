<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('users.activate', $user->id) }}"
       title="{{trans('basics::action.activate')}}"
       onclick="return confirm('{{trans('basics::action.activate_confirmation')}}'); ">
        <span class="fa fa-check"></span>
    </a>
</div>
