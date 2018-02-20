<!DOCTYPE html>
{{-- {{dd($invoice)}} --}}
<html>
  <head>
    <meta charset="utf-8">
    <title>Invoice {{$invoice->reservation->customer->name}}</title>
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
      <ul style="list-style:none;margin-left:-54px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
        <li><hr></li>
        <li>Check In: {{$invoice->reservation->user->name}}</li>
        <li>Check Out: {{$invoice->reservation->checkout_user->name}}</li>
      </ul>
    </div>
    <p style="font-weight:bold">Bill Number : {{$invoice->id}}</p>

    <hr>
    <ul style="list-style:none;margin-left:-40px">
      <li style="font-weight:bold">Customer Name:</li>
      <li class="w3-right" style="font-weight:bold">Address:</li>
      <li class="">{{$invoice->reservation->customer->name}}</li>
      <li class="w3-right" style="margin-right:-60px">{{trim(substr($invoice->reservation->customer->address,0,30))}}</li>
    </ul>

    <table class="collapse" style="width:100%;">
        {{-- table head kamar --}}
        <tr class="tengah w3-light-gray">
          <th class="kiri border-right" >Room(s)</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th class="kanan">Total</th>
        </tr>
        {{-- End of table head kamar --}}
        {{$days = (int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a")}}
        @if ($days == 0)
          {{$days = 1}}
        @endif
        @foreach ($invoice->reservation->rooms as $rooms)
        <tr>
          <td>{{$rooms->name}}</td>
          <td class="tengah">{{$days}}</td>
          <td class="kanan">Rp {{number_format($rooms->price, 0, '', '.')}}</td>
          <td class="kanan">Rp {{number_format($rooms->price * $days, 0, '', '.')}}</td>
        </tr>
        @endforeach

        {{-- Bagian additional --}}
        {{-- head --}}
        <tr class="tengah w3-light-gray">
          <th class="kiri">Additional(s)</th>
          <th>Quantity</th>
          <th class="tengah">Subtotal</th>
          <th class="kanan">Total</th>
        </tr>
        {{-- End of head --}}
        @foreach ($invoice->additionals as $additionals)
        <tr>
          <td>{{$additionals->name}}</td>
          <td class="tengah">{{$additionals->pivot->quantity}}</td>
          <td class="kanan">Rp {{number_format($additionals->price, 0, '', '.')}}</td>
          <td class="kanan">Rp {{number_format($additionals->price * $additionals->pivot->quantity, 0, '', '.')}}</td>
        </tr>
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <td class="kanan" style="font-weight:bold">Total</td>
          <td class="kanan">Rp {{number_format($invoice->total, 0, '', '.')}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="kanan" style="font-weight:bold">Paid</td>
          <td class="kanan">Rp {{number_format($invoice->reservation->dp, 0, '', '.')}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td class="kanan" style="font-weight:bold">Total Due</td>
          <td class="kanan w3-light-gray">Rp {{number_format($invoice->total - $invoice->reservation->dp, 0, '', '.')}}</td>
        </tr>
    </table>
  </body>
</html>
