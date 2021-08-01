@extends('layouts.app')
@section('title' , 'Panel')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-3 mt-5">
            @include('panel.menu')
        </div>
        <div class="col-md-9 mt-5">
            @include('layouts.alert')
            @yield('panel')
        </div>
@endsection
