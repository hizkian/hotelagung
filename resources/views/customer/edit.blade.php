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
    {{-- {{dd($customer)}} --}}
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Edit Customer Data</div>

              <div class="panel-body">
                <form class="" action="/customer/edit" method="post">
                  <input type="text" name="id" value="{{$customer->id}}" class="hidden">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$customer->name}}">
                  </div>
                  <div class="form-group">
                    <label for="price">KTP Number</label>
                    <input type="text" name="no_ktp" class="form-control" value="{{$customer->no_ktp}}">
                  </div>
                  <div class="form-group">
                    <label for="price">Phone Number</label>
                    <input type="text" name="no_hp" class="form-control" value="{{$customer->no_hp}}">
                  </div>
                  <div class="form-group">
                    <label for="price">Address</label>
                    <input type="text" name="address" class="form-control" value="{{$customer->address}}">
                  </div>
                  {{csrf_field()}}
                  <button type="submit" name="submit">Submit</button>
                </form>
              </div>
            </div>
          </div>
      </div>
  </div>
@endsection
