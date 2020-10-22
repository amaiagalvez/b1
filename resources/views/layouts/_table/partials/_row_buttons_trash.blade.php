<div class="btn-group" role="group">
    <a class="btn btn-table" href="{{ $restore_route }}" title="{{trans('basics::action.restore')}}"
       onclick="return confirm('{{trans('basics::action.restore_confirmation')}}'); ">
        <span class="fa fa-sync-alt"></span>
    </a>

    <form action="{{ $destroy_route }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-table btn-delete" title="{{trans('basics::action.destroy')}}"
                onclick="return confirm('{{trans('basics::action.destroy_confirmation')}}'); "><span
                    class="fa fa-ban"></span></button>
    </form>
</div>
