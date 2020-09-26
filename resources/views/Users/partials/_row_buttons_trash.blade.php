<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('users.restore', $user->id) }}" title="{{trans('helpers::action.restore')}}"
       onclick="return confirm('{{trans('helpers::action.restore_confirmation')}}'); ">
        <span class="fa fa-sync-alt"></span>
    </a>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-table btn-delete" title="{{trans('helpers::action.destroy')}}"
                onclick="return confirm('{{trans('helpers::action.destroy_confirmation')}}'); "><span
                    class="fa fa-ban"></span></button>
    </form>
</div>
