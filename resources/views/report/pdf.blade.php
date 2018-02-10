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
      <h3 class="w3-text-grey w3-right">Laporan Invoice</h3>
    </div>

    <div class="w3-container">
     {{-- {{print_r($harga->where('kamar', 'Anggrek 2')[1]['harga'])}} --}}
      <ul style="list-style:none;margin-left:-40px">
        <li>Jl. Diponegoro No.9, Genteng Kulon,</li>
        <li>Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</li>
        <li>(0333) 845844</li>
      </ul>
    </div>
    <hr>
    <ul style="list-style:none;margin-left:-40px">
      <li style="font-weight:bold">Bulan : {{date('F Y', strtotime($report->created_at))}}</li>
      <li></li>
    </ul>

    <table>
        {{-- table head laporan --}}
        <tr>
          <th>No</th>
          <th>Nomor Invoice</th>
          <th>Subtotal</th>
        </tr>

        {{-- Table Content --}}
        {{$count = 1}}
        @foreach ($report->invoices as $invoice)
          <tr>
            <td>{{$count}}</td>
            <td>ha/res/0{{$invoice->id}}</td>
            <td>Rp. {{number_format($invoice->total, 0, '', '.')}},-</td>
          </tr>
          {{$count++}}
        @endforeach

        {{-- End of table content --}}



        {{-- Total Invoice --}}
        <tr>
          <td style="border:0px"></td>
          <th class="kanan">Total</th>
          <td>Rp. {{number_format($report->total, 0, '', '.')}},-</td>
        </tr>
    </table>

    <div class="page-break"></div>
    {{-- Table Detail rooms & Additionals --}}
    <table>
      {{-- Table Head --}}
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Subtotal</th>
      </tr>
      {{-- End of table head --}}

      {{-- Table Content --}}
      <tr>
        <td>1</td>
        <td>Rooms</td>
        <td>Rp. {{number_format($roomtotal, 0, '', '.')}},-</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Additional</td>
        <td>Rp. {{number_format($additionaltotal, 0, '', '.')}},-</td>
      </tr>

      {{-- Table Footer --}}
      <tr>
        <td></td>
        <th class="kanan">Total</th>
        <td>Rp. {{number_format($roomtotal + $additionaltotal, 0, '', '.')}},-</td>
      </tr>
    </table>

    <div class="page-break"></div>
    {{-- Table Additonal details --}}
    <table>
      <tr>
        <th>No</th>
        <th>Nomor Invoice</th>
        <th>Nama Customer</th>
        <th>Nama Barang</th>
        <th>Harga Satuan</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      {{-- Table Content --}}
      {{$count = 1}}
      @foreach ($report->invoices as $invoice)
        @foreach ($invoice->additionals as $additional)
          <tr>
            <td>{{$count}}</td>
            <td>ha/res/0{{$invoice->id}}</td>
            <td>{{$invoice->reservation->customer->name}}</td>
            <td>{{$additional->name}}</td>
            <td>Rp. {{number_format($additional->price, 0, '', '.')}},-</td>
            <td>{{$additional->pivot->quantity}}</td>
            <td>Rp. {{number_format($additional->pivot->quantity * $additional->price, 0, '', '.')}},-</td>
          </tr>
          {{$count++}}
        @endforeach
      @endforeach
      {{-- End of Table Content --}}
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <th>Total</th>
        <td>Rp. {{number_format($additionaltotal, 0 , '', '.')}},-</td>
      </tr>

    </table>

    <div class="page-break"></div>

    <table>
      <tr>
        <th>No</th>
        <th>Nomor Invoice</th>
        <th>Nama Customer</th>
        <th>Nama Kamar</th>
        <th>Harga Per Malam</th>
        <th>Jumlah Hari</th>
        <th>Subtotal</th>
      </tr>
      {{-- Table Content --}}
      {{$count = 1}}
      {{$days = (int)date_diff(date_create($invoice->reservation->checkin), date_create(date('Y-m-d')))->format("%a")}}
      @if ($days == 0)
        {{$days = 1}}
      @endif
      @foreach ($report->invoices as $invoice)
        @foreach ($invoice->reservation->rooms as $room)
          <tr>
            <td>{{$count}}</td>
            <td>ha/res/0{{$invoice->id}}</td>
            <td>{{$invoice->reservation->customer->name}}</td>
            <td>{{$room->name}}</td>
            <td>Rp. {{number_format($room->price, 0, '', '.')}},-</td>
            <td>{{$days}}</td>
            <td>Rp. {{number_format($days * $room->price, 0, '', '.')}},-</td>
          </tr>
          {{$count++}}
        @endforeach
      @endforeach
      {{-- End of Table Content --}}
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <th>Total</th>
        <td>Rp. {{number_format($roomtotal, 0, '', '.')}},-</td>
      </tr>

    </table>


  </body>
</html>
