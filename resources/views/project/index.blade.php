@extends('layouts.app')

@section('content')
    @include('project.navigation')
    <livewire:project.tasks-page :project="$project"/>
@endsection
