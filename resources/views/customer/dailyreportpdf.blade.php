<!DOCTYPE html>
{{-- {{dd($invoice)}} --}}
<html>
  <head>
    <meta charset="utf-8">
    <title>Customer Report</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style media="screen">
      .kanan{
        text-align: right;
      }
      .tengah{
        text-align: center;
      }
      .kiri{
        text-align: left;
      }

      table,th,td{
        border: 1px solid black;
      }
      table{
        border-collapse: collapse;
        width: 100%;
      }
      .page-break {
          page-break-after: always;
      }
    </style>
  </head>
  <body>
    <div class="w3-display-container">
      <h1 class="w3-left">Hotel Agung</h1>
      <h3 class="w3-text-grey w3-right">Customer Report</h3>
    </div>

    <div class="w3-container">
     {{-- {{print_r($harga->where('kamar', 'Anggrek 2')[1]['harga'])}} --}}
      <ul style="list-style:none;margin-left:-54px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
      </ul>
    </div>
    <hr>
    <ul style="list-style:none;margin-left:-54px">
      <li style="font-weight:bold;margin-left:14px">{{date('d F Y')}}</li>
      <li></li>
    </ul>

    <table>
        {{-- table head laporan --}}
        <tr class="w3-light-gray tengah">
          <th style="width:25px">No</th>
          <th class="tengah">Customer Name</th>
          <th class="tengah">Customer ID</th>
          <th class="tengah">Customer Address</th>
        </tr>

        {{-- Table Content --}}
        {{$count = 1}}
        @foreach ($reservations as $reservation)
          <tr>
            <td class="tengah">{{$count}}</td>
            <td>{{$reservation->customer->name}}</td>
            <td>{{$reservation->customer->no_ktp}}</td>
            <td>{{$reservation->customer->address}}</td>
          </tr>
          {{$count++}}
        @endforeach

        {{-- End of table content --}}
    </table>
  </body>
</html>
