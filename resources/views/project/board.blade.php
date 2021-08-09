@extends('layouts.app')

@section('content')
    @include('project.navigation')
    <livewire:project.board :project="$project"/>
@endsection
