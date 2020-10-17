@if($role->canEdit())
    <div class="btn-group" role="group">

        <a class="btn btn-table" href="{{ route('roles.edit', $role->id) }}" title="{{trans('helpers::action.edit')}}">
            <span class="fa fa-edit"></span>
        </a>

        @if($role->canDelete())
            <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-table btn-delete" title="{{trans('helpers::action.delete')}}"
                        onclick="return confirm('{{trans('helpers::action.delete_confirmation')}}'); "><span
                            class="fa fa-trash"></span></button>
            </form>

        @else
            <a class="btn btn-table" href="{{ route('roles.deactivate', $user->id) }}"
               title="{{trans('helpers::action.deactivate')}}"
               onclick="return confirm('{{trans('helpers::action.deactivate_confirmation')}}'); ">
                <span class="fa fa-times"></span>
            </a>
        @endif

    </div>

@endif
