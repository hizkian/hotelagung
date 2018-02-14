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
              <div class="panel-heading">Checkout Summary</div>

              <div class="panel-body">
                <ul>
                  <li>Customer name : {{$reservation->customer->name}}</li>

                  <li>Customer KTP Number : {{$reservation->customer->no_ktp}}</li>

                  <li>Customer Phone Number : {{$reservation->customer->no_hp}}</li>

                  <li>Customer Address : {{$reservation->customer->address}}</li>

                  <li>Checkin date : {{date('l, d F Y', strtotime($reservation->checkin))}}</li>

                  <li>Checkout date : {{date('l, d F Y')}}</li>

                  <li>Rooms:</li>
                    <ol>
                      @foreach ($reservation->rooms as $room)
                        <li>{{$room->name}} @Rp. {{$room->price}},-</li>
                      @endforeach
                    </ol>

                  <li>Down Payment : Rp. {{$reservation->dp}},-</li>

                  <li>Total room price per night: Rp. {{$reservation->total}},-</li>
                </ul>

                <form class="" action="/reservation/checkout" method="post" onsubmit="return checkForm(this);">
                  <input type="text" name="reservation_id" value="{{$reservation->id}}" class="hidden">
                  <div class="form-group">
                    <label for="additional">Additional</label>
                    <select id="additional" class="form-control">
                      <option value="" disabled selected></option>
                      @foreach ($additionals as $additional)
                        <option id="{{$additional->id}}" value="{{$additional->price}}">{{ $additional->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input id="quantity" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <button id="add" type="button" name="button" class="form-control btn btn-default pull-right">Add Additional</button>
                  </div>

                  <div id="container" class="form-group">
                    <label>Added Additionals</label>
                  </div>

                  <div class="form-group">
                    <label>Total Additionals: Rp. <span id="total">0</span>,-</label>
                  </div>

                  <div class="form-group">
                    <label>Total invoice: Rp. <span id="totalinvoice">@if ((int)date_diff(date_create($reservation->checkin), date_create(date('Y-m-d')))->format("%a") == 0)
                      {{$reservation->total}}
                    @else
                      {{$reservation->total * (int)date_diff(date_create($reservation->checkin), date_create(date('Y-m-d')))->format("%a")}}
                    @endif</span>,-</label>
                  </div>

                  {{csrf_field()}}
                  <div class="form-group">
                    <button type="submit" name="submit" class="form-control btn btn-primary">Submit</button>
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
      var a = document.getElementById("additional");
      var additional = a.options[a.selectedIndex].text;
      var additionalid = a.options[a.selectedIndex].id;

      var quantity = document.getElementById("quantity").value;
      var additionalprice = parseInt(a.options[a.selectedIndex].value) * parseInt(quantity);

      var find = '#additional' + additionalid;


      if ($('#container').find(find).length !== 0) {
        alert('Additional has been added!');
      } else if(additional === "" || quantity === ""){
        alert('Please choose first!');
      } else {
        //close button
        var close = "<button type='button' class='close pull-right' aria-label='close' value='" + additionalprice + "'><span aria-hidden='true'>&times;</span></button>"

        var quantitystr = "<span class='pull-right'> Quantity : " + quantity + "</span>"

        var string = additional + " " + quantitystr + " " + close;

        //added rooms detail
        $("#container").append("<div id='additional" + additionalid + "' class='alert alert-success'><p>" + string + "</p><input class='hidden' type='text' value='" + additionalid + "' name='additionals[" + count + "]'><input class='hidden' type='text' value='" + quantity + "' name='quantities[" + count + "]'>");
        count++;


        $("#total").html(parseInt($("#total").html()) + additionalprice);
        $("#totalinvoice").html(parseInt($("#totalinvoice").html()) + additionalprice);
      }


      // $('#cekcek').append("<input class='w3-hide' type='text' value='" + room + "' name='room[" + count + "]'>");
      // $('#cekcek').append("<input class='w3-hide' type='date' value='" + checkin + "' name='checkin[" + count + "]'>");
      // $('#cekcek').append("<input class='w3-hide' type='date' value='" + checkout + "' name='checkout[" + count + "]'>");
    });


    $(document).on('click','.close',function(){
      $("#total").html(parseInt($("#total").html()) - parseInt($(this).val()));
      $("#totalinvoice").html(parseInt($("#totalinvoice").html()) - parseInt($(this).val()));
        $(this).parent().parent().remove();
    });
  });
  </script>
@endsection
