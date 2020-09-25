@if(Session::has('successMessage'))

    <div class="alert alert-success">
        {{Session::get('successMessage')}}
    </div>

@elseif(Session::has('errorMessage'))

    <div class="alert alert-danger">
        <p>{!! Session::get('errorMessage') !!}</p>
    </div>

@endif
