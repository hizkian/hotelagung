<!DOCTYPE html>
{{-- {{dd($invoice)}} --}}
<html>
  <head>
    <meta charset="utf-8">
    <title>invoice</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style media="screen">

    </style>
  </head>
  <body>
    <div class="w3-display-container">
      <h1 class="w3-left">Hotel Agung</h1>
      <h3 class="w3-text-grey w3-right">Hotel Invoice</h3>

    </div>

    <div class="w3-container">
     {{-- {{print_r($harga->where('kamar', 'Anggrek 2')[1]['harga'])}} --}}
      <ul style="list-style:none;margin-left:-40px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
      </ul>
    </div>
    <p>invoice No : ha/res/0{{$invoice->id}}</p>
    <hr>
    <ul style="list-style:none;margin-left:-40px">
      <li style="font-weight:bold">Atas Nama:</li>
      <li>{{$invoice->reservation->customer->name}}</li>
    </ul>

    <table class="w3-striped" style="width:100%">
        {{-- table head --}}
        <tr>
          <th style="width:250px">Nama Kamar</th>
          <th>Jumlah menginap</th>
          <th>Harga</th>
          <th>Total</th>
        </tr>
        {{-- table body --}}
        {{-- {{$count=0}}
        @foreach ($data as $d)
          <tr>
            <td>{{$d->room}}</td>
            <td>@if (round((strtotime($d->checkout) - strtotime($d->checkin)) / (60 * 60 * 24)) == 0)
              {{1}}
            @else
              {{round((strtotime($d->checkout) - strtotime($d->checkin)) / (60 * 60 * 24))}}
            @endif
            </td>
            <td>Rp. {{$harga->where('kamar', 'Anggrek 2')[1]['harga']}}</td>
            <td>Rp. @if (round((strtotime($d->checkout) - strtotime($d->checkin)) / (60 * 60 * 24)) == 0)
              {{$harga->where('kamar', 'Anggrek 2')[1]['harga'] * 1}}
              <div class="w3-hide">{{$count = $count + $harga->where('kamar', 'Anggrek 2')[1]['harga'] * 1}}</div>
            @else
              {{round((strtotime($d->checkout) - strtotime($d->checkin)) / (60 * 60 * 24)) * $harga->where('kamar', 'Anggrek 2')[1]['harga']}}
              <div class="w3-hide">{{$count = $count + round((strtotime($d->checkout) - strtotime($d->checkin)) / (60 * 60 * 24)) * $harga->where('kamar', 'Anggrek 2')[1]['harga']}}</div>
            @endif</td>
          </tr>

        @endforeach--}}
        <tr>
          <td></td>
          <td></td>
          <td class="w3-right" style="font-weight:bold">Jumlah</td>
          <td></td>
        </tr>
    </table>
  </body>
</html>
