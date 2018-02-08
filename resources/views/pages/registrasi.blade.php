@extends('layouts.master')
@section('content')
  <div>
    <div>
      <form id="reg" class="" style="width:600px;margin:0 auto" action="/reg" method="POST">
        <input id="counter" type="text" name="count" value="0" class="w3-hide">
        <label class="w3-text-green"><b>Nama Lengkap</b></label>
        <input name="nama" class="w3-input w3-border w3-round-large" type="text">
        <br>
        <label class="w3-text-green"><b>Nomor KTP</b></label>
        <input name="no_ktp" class="w3-input w3-border w3-round-large" type="text">
        <br>
        <label class="w3-text-green"><b>Alamat</b></label>
        <input name="alamat" class="w3-input w3-border w3-round-large" type="text">
        <br>
        <label class="w3-text-green"><b>Nomor Telepon</b></label>
        <input name="no_telp" class="w3-input w3-border w3-round-large" type="text">
        <br>
        <label class="w3-text-green"><b>Add Room</b></label>
        <div class="w3-border w3-round-large w3-padding">
          <select id="room" class="w3-select" style="margin-bottom:10px;margin-top:10px">
            <option value="" disabled selected>Pilih Kamar</option>

            @foreach ($rooms as $room)
              <option value="{{$room->nomor}}">{{ $room->kamar }}</option>
            @endforeach
          </select>
          <label class="w3-text-green"><b>Check In</b></label>
          <input id="in" class="w3-round-large" type="date" min="{{$ldate = date('Y-m-d')}}" value="{{$ldate = date('Y-m-d')}}" onchange="handler(event);"/>
          <label class="w3-text-green"><b>Check Out</b></label>
          <input id="out" class="w3-round-large" type="date" min="{{$ldate = date('Y-m-d')}}" value="{{$ldate = date('Y-m-d')}}">
          <br>
          <button type="button" id="add" class="w3-btn w3-blue w3-round-large" style="margin-top:10px">Add room</button>
        </div>
        <br>
        <br>
        <label class="w3-text-green"><b>Added Room</b></label>
        <div id="container" name="rooms" class="">

        </div>
        <br>
        <label class="w3-text-green"><b>Total</b></label>
        <br>
        <label class="w3-text-green"><b>Payment Deposit</b></label>
        <input name="no_telp" class="w3-input w3-border w3-round-large" type="text">
        <br>
        <button type="submit" name="submit" class="w3-btn w3-green w3-right w3-round-large">Submit</button>

        {{ csrf_field() }}
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">

  function handler(e){
    document.getElementById('out').setAttribute('min', e.target.value);
    document.getElementById('out').setAttribute('value', e.target.value);
  }

  $(document).ready(function(){
    var count = 1;
    $("#add").click(function(){
      var a = document.getElementById("room");
      var room = a.options[a.selectedIndex].text;
      var checkin = document.getElementById("in").value;
      var checkout = document.getElementById("out").value;

      var ci = " <b>CheckIn</b> : ";
      var co = " <b>CheckOut</b> : ";

      //close button
      var close = "<div class='w3-btn w3-red w3-round-xlarge w3-right close'>cancel</div>"

      var string = room + " " + ci + checkin + co + checkout + close;

      //added rooms detail
      $("#container").append("<div class='w3-panel w3-light-gray w3-padding w3-round-xlarge'><p class='w3-left' style='margin-top:5px'>" + string + "</p></div>");

      $('#reg').append("<input class='w3-hide' type='text' value='" + room + "' name='room[" + count + "]'>");
      $('#reg').append("<input class='w3-hide' type='date' value='" + checkin + "' name='checkin[" + count + "]'>");
      $('#reg').append("<input class='w3-hide' type='date' value='" + checkout + "' name='checkout[" + count + "]'>");
      $('#counter').attr('value', count);
      count++;
    });


    $(document).on('click','.close',function(){
        $(this).parent().remove();
    });
  });

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
