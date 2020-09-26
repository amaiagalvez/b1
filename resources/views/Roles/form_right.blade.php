@section ('form_right')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title theme-color"><i
                        class="fas fa-project-diagram"></i> {{trans_choice('basics::basics.module', 2)}}
            </h5>
        </div>

        <div class="card-body">
            <ul style="list-style-type:none;">
                @foreach($modules AS $module)
                    <li class="text-decoration-none">
                        {!! label($module->name) !!} {{$module->present()->title}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
