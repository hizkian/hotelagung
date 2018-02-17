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
            <div class="">
              <a href="/room/add/" class="btn btn-primary form-control">New Room</a>
            </div>
            <br>

            @if (count($rooms) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No additionals registered!
              </div>
            @endif

            @foreach ($rooms as $room)
              @if ($room->status == 0)
                <div class="panel panel-default panel-success">
              @else
                <div class="panel panel-default panel-danger">
              @endif

                  <div class="panel-heading">
                    {{$room->name}}
                    <span class="pull-right">Rp. {{$room->price}}</span>
                  </div>

                  <div class="panel-footer">

                      <a class="btn btn-warning" href="/room/edit/{{$room->id}}/">Edit</a>

                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$room->id}}">
                        Delete
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="deleteModal{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm animated shake" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="mySmallModalLabel">Warning</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete this room?

                                <table>
                                  <tbody>
                                    <tr>
                                      <td>Room name </td>
                                      <td>: {{$room->name}}</li></td>
                                    </tr>
                                    <tr>
                                      <td>Room price </td>
                                      <td>: Rp. {{$room->price}}</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">

                              <form class="" action="/room/delete/{{$room->id}}/" method="get">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                              </form>

                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
              </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
