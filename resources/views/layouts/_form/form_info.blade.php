<div class="form-row">
    <div class="form-group col-md-12 card-accent-secondary">
        <span>{{ trans('basics::action.created') }}: {{date($register->created_at)}}</span>
        {{$register->createdBy->name ?? ''}}
        <br>
        <span>{{ trans('basics::action.updated') }}: {{date($register->updated_at)}}</span>
        {{$register->updatedBy->name ?? ''}}
    </div>
</div>
