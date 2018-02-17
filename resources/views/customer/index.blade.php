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
            <a href="/customer/dailyreport/" class="btn btn-primary form-control">Download Daily Report</a>
          </div>
          <br>
            @if (count($customers) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No Customers registered!
              </div>
            @endif

            @foreach ($customers as $customer)
              <div class="panel panel-default">
                  <div class="panel-heading">
                    {{$customer->name}}
                  </div>

                  <div class="panel-footer">
                    <a class="btn btn-warning" href="/customer/edit/{{$customer->id}}/">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$customer->id}}">
                      Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm animated shake" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="mySmallModalLabel">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure to delete this customer?

                              <table>
                                <tbody>
                                  <tr>
                                    <td>Customer name </td>
                                    <td>: {{$customer->name}}</li></td>
                                  </tr>
                                  <tr>
                                    <td>KTP Number </td>
                                    <td>: Rp. {{$customer->no_ktp}}</td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                          <div class="modal-footer">

                            <form class="" action="/customer/delete/{{$customer->id}}/" method="get">
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
