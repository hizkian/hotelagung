<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hotel Agung Management System</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style media="screen">
    .btn.btn-primary[disabled] {
      background-color: #70bae1;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Hotel Agung
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        @if (Auth::id() == 1)
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/register/">Register New User</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/room/">Rooms</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/additional/">Additionals</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                  Reports<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a href="/report/monthly">Monthly Reports</a></li>
                                  <li><a href="/report/daily">Daily Reports</a></li>
                                  <li><a href="/report/customer" target="_blank">Customer Reports</a></li>
                                </ul>
                              </li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/customer/">Customers</a></li>
                          {{-- </ul> --}}

                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/reservation/">Reservations</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/invoice/">Invoices</a></li>
                          {{-- </ul> --}}
                        @elseif (Auth::id() == 2)
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/room/">Rooms</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li class="dropdown"><a href="/report/">Reports<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                  <li><a href="/report/monthly">Monthly Reports</a></li>
                                  <li><a href="/report/daily">Daily Reports</a></li>
                                </ul>
                              </li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/invoice/">Invoices</a></li>
                          {{-- </ul> --}}
                        @else
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/customer/">Customers</a></li>
                          {{-- </ul> --}}

                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/reservation/">Reservations</a></li>
                          {{-- </ul> --}}
                          {{-- <ul class="nav navbar-nav navbar-right"> --}}
                              <li><a href="/invoice/">Invoices</a></li>
                          {{-- </ul> --}}
                        @endif




                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/master.js') }}"></script>
</body>
</html>
