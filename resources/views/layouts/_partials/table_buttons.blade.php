<div class="btn-group float-right" style="margin-top: -20px; margin-bottom: 10px">

    @tip(['tip' => 'table.buttons'])

    @if(isset($table_buttons['partial_route']))
        @if($table_buttons['list'] ?? false)
            <a class="btn btn-secondary btn-sm mr-2" href="{{route($table_buttons['partial_route'].'.index')}}"
               title="{{trans('helpers::action.list')}}">
                <span class="fa fa-bars"></span>
            </a>
        @endif

        @if($table_buttons['create'] ?? false)
            <a class="btn btn-secondary btn-sm  mr-2" href="{{route($table_buttons['partial_route'].'.create')}}"
               title="{{trans('helpers::action.create')}}">
                <span class="fa fa-plus-square"></span>
            </a>
        @endif

        @if($table_buttons['nonactive'] ?? false)
            <a class="btn btn-secondary btn-sm mr-2" href="{{route($table_buttons['partial_route'].'.nonactive')}}"
               title="{{trans('helpers::action.nonactive')}}">
                <span class="fa fa-times"></span>
            </a>
        @endif

        @if($table_buttons['trash'] ?? false)
            <a class="btn btn-secondary btn-sm mr-2" href="{{route($table_buttons['partial_route'].'.trash')}}"
               title="{{trans('helpers::action.trash')}}">
                <span class="fa fa-trash"></span>
            </a>
        @endif

        @if($table_buttons['back_list'] ?? false)
            <a class="btn btn-secondary btn-sm  mr-2" href="javascript:history.back()"
               title="{{trans('helpers::action.back')}}">
                <span class="fa fa-fast-backward"></span>
            </a>
        @endif
    @endif

</div>

<div class="btn-group float-left" style="margin-top: -20px; margin-bottom: 5px">

    @if(isset($table_buttons['years']))
        @foreach($table_buttons['years'] AS $year)
            <a class="btn {{ isUrlActive('search_year='.$year) ? ' btn-secondary' : ' btn-default' }}  btn-sm  mr-2"
               href="{{route($table_buttons['partial_route'].'.index').'/?search_year='.$year}}"
               title="{{$year}}">
                <span class="fa fa-bars"></span> {{$year}}
            </a>
        @endforeach
    @endif

    @if(isset($table_buttons['languages']))
        @foreach($table_buttons['languages'] AS $lang)
            <a class="btn {{ isUrlActive('search_lang='.$lang) ? ' btn-secondary' : ' btn-default' }}  btn-sm  mr-2"
               href="{{route($table_buttons['partial_route'].'.index').'/?search_lang='.$lang}}"
               title="{{$lang}}">
                <span class="fa fa-bars"></span> {{$lang}}
            </a>
        @endforeach
    @endif

    @if(isset($table_buttons['customs']))
        @foreach($table_buttons['customs'] AS $custom_button)
            <a class="btn btn-secondary btn-sm  mr-2" href="{{$custom_button['route']}}"
               title="{{$custom_button['title']}}">
                <span class="{{$custom_button['icon']}}"></span> {{$custom_button['title']}}
                @if(isset($custom_button['total']) && $custom_button['total'] > 0)
                    <strong>[{{$custom_button['total']}}]</strong>
                @endif
            </a>
        @endforeach
    @endif

    @if(isset($table_buttons['selects']))
        @foreach($table_buttons['selects'] AS $select)
            <select class="custom-select col-md-12" name="search_{{$select['name']}}"
                    id="search_{{$select['name']}}">
                <option value="0"> {{trans_choice('basics::basics.'.$select['name'], 1)}} </option>
                @foreach($select['options'] AS $key => $option)
                    <option value="{{$key}}" @if( $key === $select['value']) selected="selected" @endif >
                        - {{$option}}</option>
                @endforeach
            </select>
        @endforeach
    @endif
</div>
