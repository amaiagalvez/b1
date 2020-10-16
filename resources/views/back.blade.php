@extends('basics::layouts.app')

@section('content')

    BASICS {{Auth::user()->name}}

@stop
