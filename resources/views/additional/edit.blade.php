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
            <div class="panel panel-default">
              <div class="panel-heading">Edit Additional</div>

              <div class="panel-body">
                <form class="" action="/additional/edit" method="post" onsubmit="return checkForm(this);">
                  <input type="text" name="id" value="{{$additional->id}}" class="hidden">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$additional->name}}" required autofocus>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" value="{{$additional->price}}" required>
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
