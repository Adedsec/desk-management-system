@extends('layouts.app')

@section('content')
    @include('letter.navigation')
    <livewire:letter.archive-page :letters="$letters"/>
@endsection
