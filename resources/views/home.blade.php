@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        @if (is_null(\Illuminate\Support\Facades\Auth::user()->activeDesk))

            <div class="d-flex col-md-9  justify-content-center align-items-center">
                <div class="card w-50 bg-danger ">
                    <div class="card-body">
                        <p class="card-title text-light">
                            ابتدا یک میزکار ایجاد کنید یا از مدیر درخواست کنید شما را به میزکار دعوت کند
                        </p>
                    </div>
                </div>
            </div>
        @else

            <div class="col-md-9">
                <div class="d-flex flex-column">
                    <div class="card bg-transparent">
                        <div class="card-body">
                            <h4 class="card-title m-3">
                                میزکار (({{\Illuminate\Support\Facades\Auth::user()->activeDesk->name}} ))
                            </h4>
                            <div class="d-flex m-5 justify-content-start align-items-center">
                                <div class="card shadow project-item col-md-2 border-success">
                                    <div class="card-body p-4">
                                        <a href="{{route('projects.index')}}" class="text-decoration-none text-dark">

                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <i class="bi bi-calendar-check text-success"
                                                   style="font-size: x-large"></i>
                                                <p class="card-text">
                                                    پروژه های فعال
                                                </p>
                                                <p class="card-text">
                                                    {{\Illuminate\Support\Facades\Auth::user()->activeDesk->projectsCount(\Illuminate\Support\Facades\Auth::user())}}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="card shadow project-item col-md-2 border-info mx-4">
                                    <a href="{{route('task.index')}}" class="text-decoration-none text-dark">

                                        <div class="card-body p-4">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <i class="bi bi-list-task text-info" style="font-size: x-large"></i>
                                                <p class="card-text">
                                                    کارهای من
                                                </p>
                                                <p class="card-text">
                                                    {{\Illuminate\Support\Facades\Auth::user()->activeDesk->userTasksCount(\Illuminate\Support\Facades\Auth::user())}}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="card project-item shadow col-md-2 border-danger">
                                    <a href="{{route('task.index')}}" class="text-decoration-none text-dark">

                                        <div class="card-body p-4">
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <i class="bi bi-alarm text-danger" style="font-size: x-large"></i>
                                                <p class="card-text">
                                                    کارهای دارای تاخیر
                                                </p>
                                                <p class="card-text p-0">
                                                    {{\Illuminate\Support\Facades\Auth::user()->activeDesk->delayTasksCount()}}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <h6 class="card-title mx-2">
                                همکاران من :
                            </h6>
                            <div class="d-flex mt-4 justify-content-start align-items-center">
                                @foreach(\Illuminate\Support\Facades\Auth::user()->activeDesk->users as $user)
                                    <div class="m-2 d-flex flex-column justify-content-center align-items-center">
                                        {{--                                        <img src="{{$user->getAvatar()}}" alt="" class="rounded-circle" width="40px"--}}
                                        {{--                                             height="40px">--}}
                                        <p>{{$user->name}}</p>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="col-md-3">
            <div class="card bg-transparent">
                <div class="card-body">

                    <div class="d-flex flex-column justify-content-start align-items-center">
                        {{--                        <img src="{{\Illuminate\Support\Facades\Auth::user()->getAvatar()}}"--}}
                        {{--                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"--}}
                        {{--                             class="rounded-circle m-2 shadow"--}}
                        {{--                             width="200px" height="200px">--}}
                        <h5 class="card-title mt-4">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                        <hr>
                        <p class="card-title">
                            میزکار های شما
                        </p>
                        <div class="mt-3 w-100">
                            <div class="accordion bg-white accordion-flush" id="accordionFlushExample">
                                @foreach(\Illuminate\Support\Facades\Auth::user()->desks as $desk)
                                    <div class="accordion-item bg-white">
                                        <h2 class="accordion-header bg-white" id="flush-headingOne">
                                            <button class="accordion-button bg-white collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse{{$desk->id}}"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                {{$desk->name}}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{$desk->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="flush-headingOne"
                                             data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body bg-white">
                                                <div class="d-flex justify-content-start align-items-center">
                                                    @foreach($desk->users as $user)
                                                        {{--                                                        <img src="{{$user->getAvatar()}}" title="{{$user->name}}"--}}
                                                        {{--                                                             alt=""--}}
                                                        {{--                                                             width="40px"--}}
                                                        {{--                                                             height="40px" class="rounded-circle">--}}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{route('desks.create')}}" class="btn btn-outline-dark mt-4">
                            <i class="bi bi-plus-lg"></i>
                            میزکار جدید
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
