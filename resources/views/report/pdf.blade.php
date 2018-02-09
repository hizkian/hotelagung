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
          <th>Nomor</th>
          <th>Nomor Invoice</th>
          <th>Subtotal</th>
        </tr>

        {{-- Table Content --}}
        {{$count = 1}}
        @foreach ($report->invoices as $invoice)
          <tr>
            <td>{{$count}}</td>
            <td>ha/res/0{{$invoice->id}}</td>
            <td>Rp. {{$invoice->total}},-</td>
          </tr>
          {{$count++}}
        @endforeach

        {{-- End of table content --}}



        {{-- Total Invoice --}}
        <tr>
          <td style="border:0px"></td>
          <th class="kanan">Total</th>
          <td>Rp. {{$report->total}},-</td>
        </tr>
    </table>

    <br>
    {{-- Table Detail rooms & Additionals --}}
    <table>
      {{-- Table Head --}}
      <tr>
        <th>Nomor</th>
        <th>Nama</th>
        <th>Subtotal</th>
      </tr>
      {{-- End of table head --}}

      {{-- Table Content --}}
      <tr>
        <td>1</td>
        <td>Rooms</td>
        <td>Rp. {{$roomtotal}},-</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Additional</td>
        <td>Rp. {{$additionaltotal}},-</td>
      </tr>

      {{-- Table Footer --}}
      <tr>
        <td></td>
        <th>Total</th>
        <td></td>
      </tr>
    </table>

    <br>
    {{-- Table Additonal details --}}
    <table>
      <tr>
        <th>Nomor </th>
        <th>Nomor Invoice</th>
        <th>Nama Barang</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      {{-- Table Content --}}
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      {{-- End of Table Content --}}
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <th>Total</th>
        <td></td>
      </tr>

    </table>


  </body>
</html>
