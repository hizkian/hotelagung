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
            @if (count($reports) == 0)
              <div class="alert alert-danger">
                <span class="fa-stack fa-lg close-button">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                </span>
                  No report created!
              </div>
            @endif

            @foreach ($reports as $report)
              <div class="panel panel-default">
                  <div class="panel-heading">
                    {{-- {{dd(date('F', strtotime($report->month)))}} --}}
                    {{-- {{date('F', 3)}} --}}
                    {{date('F', strtotime($report->created_at)) . " " . $report->year}}
                    <span class="pull-right">Rp. {{$report->total}}</span>
                  </div>

                  <div class="panel-footer">
                    <a class="btn btn-warning" target="_blank" href="/report/print/{{$report->id}}">Print</a>
                  </div>
              </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
