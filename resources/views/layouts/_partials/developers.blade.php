@if(auth()->user()->isDeveloper())
    <div class="col-6">
        <div class="card ml-5 ">
            <div class="card-title">
                <h4>Programatzaileak</h4>
            </div>
            <div class="card-body">
                <a target="_blank" class="btn btn-secondary btn-sm mr-2" href="/log-viewer"
                   title="Log Viewer">
                    <span class="fa fa-bars"></span> Log Viewer
                </a>
            </div>
        </div>
    </div>
@endif
