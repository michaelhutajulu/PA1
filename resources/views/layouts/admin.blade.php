@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>@yield('header')</h1>
@stop

@section('content')
    @yield('content-admin')
@stop
