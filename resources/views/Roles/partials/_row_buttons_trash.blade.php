<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('roles.restore', $role->id) }}" title="{{trans('basics::basics.restore')}}"
       onclick="return confirm('{{trans('basics::action.restore_confirmation')}}'); ">
        <span class="fa fa-sync-alt"></span>
    </a>

    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-table btn-delete" title="{{trans('basics::action.destroy')}}"
                onclick="return confirm('{{trans('basics::action.destroy_confirmation')}}'); "><span
                    class="fa fa-ban"></span></button>
    </form>
</div>
