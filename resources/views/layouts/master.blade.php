<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>halaman registrasi</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  </head>
  <body>
    <div class="w3-panel w3-green" style="margin-top:0">
      <h3>Hotel Agung</h3>
      <a class="w3-button w3-blue" href="/registrasi">Deposit</a>
      <a class="w3-button w3-blue" href="/checkout">Invoice</a>
      <a class="w3-button w3-blue" href="/others">Others</a>

      <div class="w3-dropdown-click w3-right">
        <button onclick="myFunction()" class="w3-button w3-black">{{ Auth::user()->name }} <span class="caret"></span></button>
        <div id="Demo" class="w3-dropdown-content">
          <a class="w3-btn w3-red" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>

    </div>
    @if(session()->has('message'))
    <div class="w3-panel w3-green">
      <span class="fa-stack fa-lg close-button">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
      </span>
        <strong>Success! </strong>{{ session()->get('message') }}
    </div>
    @endif

    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        <div class="w3-panel w3-red">
          <span class="fa-stack fa-lg close-button">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
          </span>
            <strong>Failed!</strong> {{$error}}
        </div>
      @endforeach
    @endif

    @yield('content')
  </body>
</html>
