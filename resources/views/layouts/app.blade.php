<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Peerless') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm plf_mrnu d-none">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!--{{ config('app.name', 'Laravel') }}-->
                    <img src="{{ asset('frontend/images/logo.png') }}" width="120px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if(Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('login') }}">{{ __('Credit Login') }}</a>
                                </li>
                            @endif
                            @if(Route::has('operation_login'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('operation_login') }}">{{ __('Opertaion Login') }}</a>
                                </li>
                            @endif
                            @if(Route::has('accountant_login'))
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('accountant_login') }}">{{ __('Accountent Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif--}}
                    @else
                        <!--<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
                                    </form>
                                </div>
                            </li>-->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <section class="log_body">
            <div class="container">
                <div class="row m-0 pt-2 pb-5">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <!--{{ config('app.name', 'Laravel') }}-->
                        <img src="{{ asset('frontend/images/logo.png') }}" width="120px">
                    </a>
                </div>
                <div class="row m-0  h-100 justify-content-center align-items-center">
                    <div class="col-12 col-lg-7 pt-5 mt-lg-5 text-center">
                        @guest
                            @if(Route::has('login'))
                                <a class="btn pl_btn"
                                    href="{{ route('login') }}">{{ __('Credit Login') }}</a>
                            @endif
                            @if(Route::has('operation_login'))
                                <a class="btn pl_btn"
                                    href="{{ route('operation_login') }}">{{ __('Operation Login') }}</a>
                            @endif
                            @if(Route::has('accountant_login'))
                                <a class="btn pl_btn"
                                    href="{{ route('accountant_login') }}">{{ __('Accounts Login') }}</a>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </section>
        <!--<main class="py-4">
@yield('content')
        </main>-->
    </div>
</body>

</html>
