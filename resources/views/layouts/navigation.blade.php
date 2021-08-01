<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class=" ms-5">
            <a class="navbar-brand" href="{{ url('/') }}">
                میز کار
            </a>
        </div>

        @auth
            <div class=" nav-item dropdown pr-3 ">
                <button class="btn btn-dark dropdown-toggle" type="button" id="deskDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <span class="p-2">میزکار 1 </span>
                </button>
                <ul class="dropdown-menu text-right dropdown-menu-dark dropdown-menu-end"
                    aria-labelledby="deskDropdown">
                    <li class=" text-right"><a class="dropdown-item" href="#">میزکار</a></li>
                    <li><a class="dropdown-item" href="#">میزکار</a></li>
                    <li><a class="dropdown-item" href="#">میزکار</a></li>
                </ul>
            </div>
        @endauth


        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            @auth
                <ul class="navbar-nav flex-grow-1 d-flex justify-content-center">
                    <li class=" nav-item"><a href="#" class="nav-link">داشبورد</a></li>
                    <li class=" nav-item"><a href="#" class="nav-link">پروژه ها</a></li>
                    <li class=" nav-item"><a href="#" class="nav-link">وظایف</a></li>
                    <li class=" nav-item"><a href="#" class="nav-link">نامه ها</a></li>
                    <li class=" nav-item"><a href="#" class="nav-link">یادداشت ها</a></li>
                </ul>

        @endauth

        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav flex-grow-0 ">


                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ورود</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">ثبت نام</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item py-0 ">
                        <a class="nav-link py-0" href="#">
                            <i class="bi bi-gear-wide" style="font-size: 1.5rem;"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown text-right">
                        <a id="navbarDropdown" class="nav-link py-0 dropdown-toggle align-baseline" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>

                        </a>

                        <div class="dropdown-menu text-right dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">پروفایل({{ Auth::user()->name }})</a>
                            <a class="dropdown-item " href="#"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                خروج
                            </a>

                            <form id="logout-form" action="{{route('logout')}}"
                                  method="post" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
