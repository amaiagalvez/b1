<div class="btn-group" role="group">
    @if($variable->isEditable())
        <a class="btn btn-table" href="{{ route('variables.edit', $variable->id) }}"
           title="{{trans('users::users.edit')}}">
            <span class="fa fa-edit"></span>
        </a>
    @endif
</div>
