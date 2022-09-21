@extends('layouts.app')

@section('content')
    @include('project.navigation')
    <livewire:project.task-page :project="$project"/>
@endsection
