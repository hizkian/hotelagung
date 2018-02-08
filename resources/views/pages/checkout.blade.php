@extends('layouts.master')

@section('content')
  <div class="w3-content">

    {{-- mewakili 1 kamar --}}
    @foreach ($rooms as $room)
      <div class="w3-blue w3-round-xlarge w3-display-container w3-padding w3-margin" style="height:100px">
        <p class="w3-xlarge w3-left">{{$room->kamar}}</p>
        <form class="" action="/out" method="post">
          <button type="submit" class="w3-button w3-round-large w3-right w3-red" name="button" style="margin-top:23px" value="{{$room->kamar}}">Check Out </button>
          {{ csrf_field()}}
        </form>

      </div>
    @endforeach

  </div>

  <script type="text/javascript">
  function myFunction() {
      var x = document.getElementById("Demo");
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }
  </script>
@endsection
