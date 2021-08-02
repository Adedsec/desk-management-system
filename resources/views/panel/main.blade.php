@extends('layouts.app')
@section('title' , 'Panel')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-2 mt-5">
            @include('panel.menu')
        </div>
        <div class="col-md-10 mt-5">
            @yield('panel')
        </div>
@endsection
