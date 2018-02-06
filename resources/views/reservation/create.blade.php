@extends('layouts.app')

@section('content')
  @if(session()->has('message'))
    <div class="alert alert-success">
      <span class="fa-stack fa-lg close-button">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
      </span>
        <strong>Success! </strong>{{ session()->get('message') }}
    </div>
    @endif

    @if(session()->has('error'))
      <div class="alert alert-danger">
        <span class="fa-stack fa-lg close-button">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-check fa-stack-1x fa-inverse"></i>
        </span>
          <strong>Failed! </strong>{{ session()->get('error') }}
      </div>
      @endif

    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
          <span class="fa-stack fa-lg close-button">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
          </span>
            <strong>Failed!</strong> {{$error}}
        </div>
      @endforeach
    @endif
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">New Reservation</div>

              <div class="panel-body">
                <form class="" action="/reservation/create" method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="no_ktp">KTP Number</label>
                    <input type="text" name="no_ktp" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="no_hp">Phone Number</label>
                    <input type="text" name="no_hp" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" rows="3" cols="80" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="room">Choose Room</label>
                    <select id="room" class="form-control" name="room">
                      <option value="" disabled selected></option>
                      @foreach ($rooms as $room)
                        <option id="{{$room->id}}" value="{{$room->price}}">{{ $room->name }}</option>
                      @endforeach
                    </select>

                  </div>
                  <div class="form-group">
                    <button id="add" type="button" name="button" class="form-control btn btn-default pull-right">Add Room</button>
                  </div>

                  <div id="container" class="form-group">
                    <label>Added Room</label>
                  </div>

                  <div class="form-group">
                    <label>Total per night: Rp. <span id="total">0</span>,-</label>
                  </div>

                  <div class="form-group">
                    <label for="dp">Down Payment</label>
                    <input type="text" name="dp" class="form-control">
                  </div>

                  {{csrf_field()}}
                  <div class="form-group">
                    <button type="submit" name="submit" class="form-control btn btn-primary pull-right">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript">

  $(document).ready(function(){
    var count = 0;
    $("#add").click(function(){
      var a = document.getElementById("room");
      var room = a.options[a.selectedIndex].text;
      var roomid = a.options[a.selectedIndex].id;
      var roomprice = parseInt(a.options[a.selectedIndex].value);

      var find = '#room' + roomid;


      if ($('#container').find(find).length !== 0) {
        alert('Room has been added!');
      } else if(room === ""){
        alert('Please choose the Room first!');
      } else {
        //close button
        var close = "<button type='button' class='close' aria-label='close' value='" + roomprice + "'><span aria-hidden='true'>&times;</span></button>"

        var string = room + " " + close;

        //added rooms detail
        $("#container").append("<div id='room" + roomid + "' class='alert alert-success'><p>" + string + "</p><input class='hidden' type='text' value='" + roomid + "' name='room[" + count + "]'>");
        count++;


        $("#total").html(parseInt($("#total").html()) + roomprice);
      }


    });


    $(document).on('click','.close',function(){
        $("#total").html(parseInt($("#total").html()) - parseInt($(this).val()));
        $(this).parent().parent().remove();
    });
  });
  </script>
@endsection
