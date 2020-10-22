<div class="btn-group" role="group">
    @if($variable->canEdit())
        <a class="btn btn-table" href="{{ route('variables.edit', $variable->id) }}"
           title="{{trans('basics::action.edit')}}">
            <span class="fa fa-edit"></span>
        </a>
    @endif
</div>
