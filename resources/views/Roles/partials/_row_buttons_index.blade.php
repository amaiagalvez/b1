@if(!$role->isAdmin())
    <div class="btn-group" role="group">

        <a class="btn btn-table" href="{{ route('roles.edit', $role->id) }}" title="{{trans('helpers::action.edit')}}">
            <span class="fa fa-edit"></span>
        </a>

        @if($role->canDelete())
            <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-table btn-delete" title="{{trans('helpers::action.delete')}}"
                        onclick="return confirm('{{trans('basics::basics.delete_confirmation')}}'); "><span
                            class="fa fa-trash"></span></button>
            </form>
        @endif

    </div>

@endif
