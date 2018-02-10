<!DOCTYPE html>
{{-- {{dd($invoice)}} --}}
<html>
  <head>
    <meta charset="utf-8">
    <title>invoice</title>
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
      .collapse{
        border-collapse: collapse;
      }
      .border-top{
        border-top: 1px solid black;
      }
      .border-right td{
        border-right: 1px solid black;
      }
      .border-bottom{
        border-bottom: 1px solid black;
      }
      .border-left{
        border-left: 1px solid black;
      }
      .border-all{
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <div class="w3-display-container">
      <h1 class="w3-left">Hotel Agung</h1>
      <h3 class="w3-text-light-gray w3-right">Hotel Invoice</h3>
    </div>

    <div class="w3-container">
     {{-- {{print_r($harga->where('kamar', 'Anggrek 2')[1]['harga'])}} --}}
      <ul style="list-style:none;margin-left:-40px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
      </ul>
    </div>
    <p>Invoice No : ha/res/0{{$invoice->id}}</p>
    <hr>
    <ul style="list-style:none;margin-left:-40px">
      <li style="font-weight:bold">Atas Nama:</li>
      <li>{{$invoice->reservation->customer->name}}</li>
    </ul>

    <table class="collapse" style="width:100%;">
        {{-- table head kamar --}}
        <tr class="tengah w3-light-gray">
          <th class="kiri border-right" >Nama Kamar</th>
          <th>Jumlah menginap</th>
          <th>Harga</th>
          <th class="kanan">Total</th>
        </tr>
        {{-- End of table head kamar --}}
        @foreach ($invoice->reservation->rooms as $rooms)
        <tr>
          <td>{{$rooms->name}}</td>
          <td class="tengah">@if ((int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a") == 0)
            {{1}}
          @else
            {{(int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a")}}
          @endif</td>
          <td class="tengah">{{$rooms->price}}</td>
          <td class="kanan">@if ((int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a") == 0)
            {{$rooms->price}}
          @else
            {{$rooms->price * (int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a")}}
          @endif</td>
        </tr>
        @endforeach

        {{-- Bagian additional --}}
        {{-- head --}}
        <tr class="tengah w3-light-gray">
          <th class="kiri">Nama Tambahan</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th class="kanan">Subtotal</th>
        </tr>
        {{-- End of head --}}
        @foreach ($invoice->additionals as $additionals)
        <tr>
          <td>{{$additionals->name}}</td>
          <td class="tengah">{{$additionals->pivot->quantity}}</td>
          <td class="tengah">{{$additionals->price}}</td>
          <td class="kanan">{{$additionals->pivot->quantity * $additionals->price}}</td>
        </tr>
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <td class="tengah" style="font-weight:bold">Total</td>
          <td class="kanan">Rp. {{$invoice->total}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="tengah" style="font-weight:bold">DP</td>
          <td class="kanan">Rp. {{$invoice->reservation->dp}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="tengah" style="font-weight:bold">Tagihan</td>
          <td class="kanan w3-light-gray">Rp. {{$invoice->total - $invoice->reservation->dp}}</td>
        </tr>
    </table>
  </body>
</html>
