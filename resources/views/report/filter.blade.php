<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Filtered Invoice Report</title>
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
      <h3 class="w3-text-grey w3-right">Filtered Invoice</h3>
    </div>

    <div class="w3-container">
     {{-- {{print_r($harga->where('kamar', 'Anggrek 2')[1]['harga'])}} --}}
      <ul style="list-style:none;margin-left:-54px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
      </ul>
      <ul style="list-style:none;margin-left:-54px">
        <li>From : {{$from}}</li>
        <li>Until : {{$until}}</li>
      </ul>
    </div>
    <hr>

    <table>
        {{-- table head laporan --}}
        <tr class="w3-light-gray tengah">
          <th style="width:25px">No</th>
          <th class="tengah">Invoice Number</th>
          <th class="tengah">Check Out Date</th>
          <th class="kanan" style="width:200px">Subtotal</th>
        </tr>

        {{-- Table Content --}}
        @php
          $count = 1;
          $total = 0;
        @endphp
        @foreach ($invoices as $invoice)
          <tr>
            <td>{{$count++}}</td>
            <td>0{{$invoice->id}}</td>
            <td class="tengah">{{date('d-m-Y',strtotime($invoice->reservation->checkout))}}</td>
            <td class="kanan">Rp. {{number_format($invoice->total, 0, '', '.')}}</td>
            @php
              $total += $invoice->total;
            @endphp
          </tr>
        @endforeach
        {{-- End of table content --}}

        {{-- Total --}}
        <tr>
          <td></td>
          <td></td>
          <td class="kanan"><strong>Total</strong></td>
          <td class="kanan">Rp. {{number_format($total, 0, '', '.')}}</td>
        </tr>
        {{-- Total Invoice --}}

    </table>

  </body>
</html>
