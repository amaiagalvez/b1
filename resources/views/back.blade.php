@extends('layouts._base.app')

@section('content')

    BASICS {{Auth::user()->name}}

@stop
