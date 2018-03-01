@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row text-center">
    <div class="col-md-8 col-md-offset-2">
      <form class="" action="/report/filter" method="GET" target="_blank">
        <label for="from">From:</label>
        <input type="date" name="from">
        <label for="until">Until:</label>
        <input type="date" name="until">
        <button type="submit" class="btn btn-primary">View</button>
      </form>

    </div>
  </div>
</div>

@endsection
