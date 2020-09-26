@if (!Auth::check() || !\AdamTheHutt\LaravelDismissibleTips\DismissedTip::whereUserId(Auth::id())->whereTip($tip)->exists())
    <div style="float: {!! $align ?? 'left' !!}" class="alert-primary alert-dismissible" role="alert">
        {{--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="margin-left: -20px;">&times;</span></button>--}}
        <div class="row">
            <div class="col-2 col-lg-1 text-right">

            </div>
            <div class="col-9 col-lg-10">
                @if (\Illuminate\Support\Facades\Lang::has($tip))
                    @lang($tip)
                @else
                    @lang("dismissible-tips::tips.$tip")
                @endif
                @isset($link)
                    <a href="{!! $link !!}"><i class="fas fa-arrow-circle-right ml-2"></i></a>
                @endisset
            </div>
            <div class="col-1 col-lg-1 text-right">
                @auth
                    <a class="dismiss-tip not-text-decoration" data-tip="{{$tip}}" href="#">
                        <i class="fas fa-times"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
@endif


{{-- TODO:: vendorren hau aldatu dut

LaravelDismissibleTipsServiceProvider.php

$this->loadViewsFrom(public_path().'/../resources/views/partials', 'dismissible-tips');

--}}
