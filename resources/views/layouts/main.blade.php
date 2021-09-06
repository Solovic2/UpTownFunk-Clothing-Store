<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/front/style.js') }}" defer></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{asset('assets/admin/dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <!-- Header -->
        <header>
            <nav id="topNav" class="navbar navbar-expand-md  navbar-light bg-white shadow-sm">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-lg-none mx-auto" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }}</a>
                <div class="navbar-collapse collapse padding-left">
                    <ul class="nav navbar-nav">
                        <!-- Base Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{  url('/') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#">Categories</a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <?php
                                foreach ( App\Models\Category::all() as $category) {
                                    echo' <li> <a class="dropdown-item" href="'.  route("category.show",$category->id)  .'"> '. $category->type . '</a> </li>' . "\n";
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">Frequently Asked Questions</a>
                        </li>
                    </ul>
                </div>
                
                <a class="navbar-brand mx-auto d-none d-lg-block"href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="navbar-collapse collapse padding-right ">
                    <ul class="nav navbar-nav ml-auto">
                        @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
                            @can('admin')
                                <li class="nav-item"><a class="nav-link"href="{{ route('admin.index') }}">Admin Settings</a>  </li>
                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @can('admin')
                                    <li><a class="dropdown-item"href="{{ route('admin.index') }}">Admin Settings</a> </li>
                                    @endcan
                                    <li><a class="dropdown-item"href="{{ route('profile.index') }}">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Page Body -->
        <main class="content-wrap">
            @yield('content')
        </main>
        <!-- Footer -->
        <footer class="footer text-center text-white "  style="background-color: #f1f1f1;">
            <!-- Grid container -->
            <div class="container pt-1">
              <!-- Section: Social media -->
              <section class="mb-1">      
                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg text-dark"
                    href="#!" role="button" data-mdb-ripple-color="dark">
                    <i class="fab fa-twitter"></i>
                </a>          
                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark"
                  href="https://www.instagram.com/up_town_funk/" target="_blank" role="button"data-mdb-ripple-color="dark">
                  <i class="fab fa-instagram"></i>
                </a>
              </section>
              <!-- Section: Social media -->
            </div>
            <!-- Copyright -->
            <div class=" text-center text-dark p-2" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2021 Copyright:
              <a class="text-dark" href="{{ url('/') }}">UpTownFunk</a>
            </div>
        </footer>
       
    </div>

    
</body>
</html>
