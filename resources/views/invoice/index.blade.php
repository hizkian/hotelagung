@extends('layouts.app')

@section('content')
  {{-- {{dd($invoices)}} --}}
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
            @if (count($invoices) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No invoices created!
              </div>
            @endif

            @foreach ($invoices as $invoice)
              <div class="panel panel-default">
                  <div class="panel-heading">
                    {{$invoice->reservation->customer->name}}
                    <span class="pull-right">Rp. {{$invoice->total}}</span>
                  </div>

                  <div class="panel-footer">
                    <a class="btn btn-warning" target="_blank" href="/invoice/print/{{$invoice->id}}/">Print</a>
                  </div>
              </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
