@if(Session::has('successMessage'))

    <div class="alert alert-success" role="alert">
        {{Session::get('successMessage')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif(Session::has('errorMessage'))

    <div class="alert alert-danger" role="alert">
        <p>{!! Session::get('errorMessage') !!}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif
