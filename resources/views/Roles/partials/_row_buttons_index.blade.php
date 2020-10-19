@if($role->canEdit())
    <div class="btn-group" role="group">

        <a class="btn btn-table" href="{{ route('roles.edit', $role->id) }}" title="{{trans('basics::action.edit')}}">
            <span class="fa fa-edit"></span>
        </a>

        @if($role->canDelete())
            <form action="{{ route('roles.delete', $role->id) }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-table btn-delete" title="{{trans('basics::action.delete')}}"
                        onclick="return confirm('{{trans('basics::action.delete_confirmation')}}'); "><span
                            class="fa fa-trash"></span></button>
            </form>

        @else
            <a class="btn btn-table" href="{{ route('roles.deactivate', $user->id) }}"
               title="{{trans('basics::action.deactivate')}}"
               onclick="return confirm('{{trans('basics::action.deactivate_confirmation')}}'); ">
                <span class="fa fa-times"></span>
            </a>
        @endif

    </div>

@endif
