<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ route('roles.restore', $role->id) }}" title="{{trans('basics::users.restore')}}"
       onclick="return confirm('{{trans('basics::users.restore_confirmation')}}'); ">
        <span class="fa fa-sync-alt"></span>
    </a>

    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-table btn-delete" title="{{trans('basics::users.destroy')}}"
                onclick="return confirm('{{trans('basics::users.destroy_confirmation')}}'); "><span
                    class="fa fa-ban"></span></button>
    </form>
</div>
