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
            @if (count($additionals) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No additionals registered!
              </div>
            @endif

            <div class="">
              <a href="/additional/add" class="btn btn-primary btn-block">New Additional</a>
            </div><br>

            @foreach ($additionals as $additional)
              <div class="panel panel-default">
                  <div class="panel-heading">
                    {{$additional->name}}
                    <span class="pull-right">Rp. {{$additional->price}}</span>
                  </div>

                  <div class="panel-footer">
                    <a class="btn btn-warning" href="/additional/edit/{{$additional->id}}">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$additional->id}}">
                      Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{$additional->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm animated shake" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="mySmallModalLabel">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete this additional?

                              <table>
                                <tbody>
                                  <tr>
                                    <td>Additional name </td>
                                    <td>: {{$additional->name}}</li></td>
                                  </tr>
                                  <tr>
                                    <td>Additional price </td>
                                    <td>: Rp. {{$additional->price}}</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                          <div class="modal-footer">

                            <form class="" action="/additional/delete/{{$additional->id}}" method="get">
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
