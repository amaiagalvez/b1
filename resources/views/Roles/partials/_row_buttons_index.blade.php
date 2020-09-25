@if(!$role->isAdmin())
    <div class="btn-group" role="group">

        <a class="btn btn-table" href="{{ route('roles.edit', $role->id) }}" title="{{trans('users::users.edit')}}">
            <span class="fa fa-edit"></span>
        </a>

        @if($role->canDelete())
            <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-table btn-delete" title="{{trans('users::users.delete')}}"
                        onclick="return confirm('{{trans('users::users.delete_confirmation')}}'); "><span
                            class="fa fa-trash"></span></button>
            </form>
        @endif

    </div>

@endif
