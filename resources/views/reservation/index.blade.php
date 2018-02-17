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
          <i class="fa fa-times fa-stack-1x fa-inverse"></i>
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
          <!-- Button trigger modal -->

            <div class="">
              <a href="/reservation/create/" class="btn btn-primary form-control">New Reservation</a>
            </div>
            <br>

            @if (count($reservations) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No reservations registered!
              </div>
            @endif

            @foreach ($reservations as $reservation)
              <div class="panel panel-default">
                  <div class="panel-heading">
                    {{$reservation->customer->name}}
                  </div>

                  <div class="panel-body">
                    <ul>
                      <li>Rooms: <ol>
                        @foreach ($reservation->rooms as $room)
                          <li>{{$room->name}} @Rp. {{$room->price}} per night</li>
                        @endforeach
                      </ol></li>
                      <li>Total Price: Rp. {{$reservation->total}}</li>
                      <li>Down Payment: Rp. {{$reservation->dp}}</li>
                    </ul>
                  </div>

                  <div class="panel-footer">
                    {{-- <a class="btn btn-warning" href="/reservation/manage/{{$reservation->id}}"><i class="fa fa-gear"></i> Manage</a> --}}
                    <a class="btn btn-danger" href="/reservation/checkout/{{$reservation->id}}/"><i class="fa fa-sign-out"></i> Checkout</a>
                  </div>
              </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
