<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Additional;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Report;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use PDF;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ==========ROOM==========//

    public function indexRoom()
    {
      $rooms = Room::orderBy('status')->get();
      return view('room.index', compact('rooms'));
    }

    public function addRoom()
    {
      return view('room.add');
    }

    public function createRoomData(Request $req)
    {
      $this->validate($req, [
        'name'   => 'required|max:50',
        'price' => 'required|integer',
      ]);

      if (Room::where('name', $req->name)->get()->count()) {
        return redirect()->back()->with('error', 'Room already registered!');
      }

      $room = new Room;
      $room->name = $req->name;
      $room->price = $req->price;
      $room->status = false;
      $room->save();

      return redirect()->back()->with('message', 'Room successfully added!');
    }

    public function deleteRoom($id)
    {
      $room = Room::find($id)->name;
      $reservations = Reservation::where('room_id', $id);
      foreach ($reservations as $reservation) {
        $reservation->rooms()->detach(Room::find($id));
      }

      Room::where('id', $id)->delete();
      $message = 'Room ' . $room . ' successfully deleted!';
      return redirect()->back()->with('message', $message);
    }

    public function editRoom($id){
      $room = Room::find($id);
      return view('room.edit', compact('room'));
    }

    public function editRoomData(Request $req){
      $room = Room::find($req->id);
      $room->name = $req->name;
      $room->price = $req->price;
      $room->save();
      return redirect('/room/')->with('message', 'Additional has been edited!');
    }

    //=========RESERVATION==========

    public function indexReservation()
    {
      $reservations = Reservation::where('checkout', null)->get();
      return view('reservation.index', compact('reservations'));
    }

    public function createReservation()
    {
      $rooms = Room::where('status', 0)->get();
      return view('reservation.create', compact('rooms'));
    }



    public function createReservationData(Request $req)
    {
      $this->validate($req, [
        'name'   => 'required|max:50',
        'no_ktp' => 'required|regex:/[0-9]*/',
        'no_hp' => 'required|regex:/[0-9]*/',
        'dp' => 'required|integer',
        'address' => 'required|max:200',
        'room' => 'required'
      ]);

      $customer = new Customer;
      $customer->name = $req->name;
      $customer->no_ktp = $req->no_ktp;
      $customer->no_hp = $req->no_hp;
      $customer->address = $req->address;
      $customer->save();

      $reservation = new Reservation;
      $reservation->customer_id = $customer->id;
      $reservation->checkin = date("Y-m-d");
      $reservation->total = 0;
      $reservation->dp = $req->dp;

      $reservation->user_id = Auth::id();
      $reservation->save();

      foreach ($req->room as $room) {
        $room = Room::find($room);
        $room->status = 1;
        $room->save();
        $reservation->rooms()->attach($room);
        $reservation->total += $room->price;
        $reservation->save();
      }

      return redirect('/reservation')->with('message', 'Reservation Created!');
    }

    public function checkoutReservation($id)
    {
      $reservation = Reservation::find($id);
      $additionals = Additional::all();
      return view('reservation.checkout', compact('reservation', 'additionals'));
    }

    public function checkoutReservationData(Request $req)
    {
      // dd($req);
      // dd($reports = Report::where('month', date('m'))->where('year', date('Y'))->first());
      // dd(Report::where('month', (int)date('m'))->where('year', (int)date('Y'))->first());
      $report = Report::where('month', (int)date('m'))->where('year', (int)date('Y'))->first();
      // dd($report);
      if ($report == null) {
        $report = new Report;
        $report->month = date('m');
        $report->year = date('Y');
        if ((int)date('m') == 1) {
          $lastdate = Report::where('month', 12)->where('year', (int)date('Y') - 1)->first();
        } else {
          $lastdate = Report::where('month', (int)date('m') - 1)->where('year', (int)date('Y'))->first();
        }
        if ($lastdate != null) {
          $report->total = $lastdate->total;
        }

        $report->save();
      }

      $reservation = Reservation::find($req->reservation_id);
      $reservation->checkout = date('Y-m-d');
      $datediff = date_diff(date_create($reservation->checkin), date_create($reservation->checkout));
      $days = (int)$datediff->format("%a");
      if ($days == 0) {
        $days = 1;
      }
      // dd($datediff->format("%a"));
      $reservation->total *= $days;
      // dd($reservation->total);
      $reservation->save();

      $invoice = new Invoice;
      $invoice->reservation_id = $req->reservation_id;
      $total = $reservation->total;

      if ($req->additionals != null) {
        foreach ($req->additionals as $kadd => $additional) {
            $add = Additional::find($additional);
            $total += $add->price * $req->quantities[$kadd];
          }
      }



    //   for ($i=0; $i < count($req->additionals); $i++) {
    //     $additional = Additional::find($req->additionals[$i]);
    //     $total += $additional->price * $req->quantities[$i];
    //   }

      $invoice->total = $total;
      $invoice->report_id = $report->id;
      $invoice->save();

      $report->total += $invoice->total;
      $report->save();

      // dd($req->quantities);
      if ($req->additionals != null) {
      foreach ($req->additionals as $kadd => $additional) {
        $add = Additional::find($additional);
        // $invoice->additionals()->save($additional, ['quantity' => $req->quantites[$i]]);
        $invoice->additionals()->attach(
          [$additional => ['quantity' => $req->quantities[$kadd]]]
        );
      }
      }

    //   for ($i=0; $i < count($req->additionals); $i++) {
    //     $additional = Additional::find($req->additionals[$i]);
    //     // $invoice->additionals()->save($additional, ['quantity' => $req->quantites[$i]]);
    //     $invoice->additionals()->attach(
    //       [$req->additionals[$i] => ['quantity' => $req->quantities[$i]]]
    //     );
    //   }
      foreach ($reservation->rooms as $room) {
        $room->status = 0;
        $room->save();
      }



      return redirect('/invoice/')->with('message', 'Checkout Success!');
    }

    //==========CUSTOMER==========//

    public function indexCustomer()
    {
      $customers = Customer::orderBy('created_at', 'desc')->get();
      return view('customer.index', compact('customers'));
    }


    public function deleteCustomer($id)
    {
      $customer = Customer::find($id)->name;
      $reservations = Reservation::where('customer_id', $id)->get();
      foreach ($reservations as $reservation) {
        foreach ($reservation->rooms as $room) {
          $room->status = 0;
          $room->save();
        }
      }
      Reservation::where('customer_id', $id)->delete();
      Customer::where('id', $id)->delete();
      $message = 'Customer ' . $customer . ' successfully deleted!';
      return redirect()->back()->with('message', $message);
    }

    public function editCustomer($id){
      $customer = Customer::find($id);
      return view('customer.edit', compact('customer'));
    }

    public function editCustomerData(Request $req){
      $customer = Customer::find($req->id);
      $customer->name = $req->name;
      $customer->no_ktp = $req->no_ktp;
      $customer->no_hp = $req->no_hp;
      $customer->address = $req->address;
      $customer->save();
      return redirect('/customer/')->with('message', 'Customer has been edited!');
    }

    //==========ADDITIONAL==========//

    public function indexAdditional()
    {
      $additionals = Additional::all();
      return view('additional.index', compact('additionals'));
    }

    public function addAdditional()
    {
      return view('additional.add');
    }

    public function createAdditionalData(Request $req)
    {
      $this->validate($req, [
        'name'   => 'required|max:50',
        'price' => 'required|integer',
      ]);

      if (Additional::where('name', $req->name)->get()->count()) {
        return redirect()->back()->with('error', 'Additional already registered!');
      }



      $additional = new Additional;
      $additional->name = $req->name;
      $additional->price = $req->price;
      $additional->save();

      return redirect('/additional/')->with('message', 'Additional successfully added!');
    }

    public function deleteAdditional($id){
      $additional = Additional::find($id)->name;
      Additional::find($id)->delete();
      $message = "Additional " . $additional . " has been deleted!";
      return redirect()->back()->with('message', $message);
    }

    public function editAdditional($id){
      $additional = Additional::find($id);
      return view('additional.edit', compact('additional'));
    }

    public function editAdditionalData(Request $req){
      $additional = Additional::find($req->id);
      $additional->name = $req->name;
      $additional->price = $req->price;
      $additional->save();
      return redirect('/additional/')->with('message', 'Additional has been edited!');
    }

    //==========INVOICE==========//

    public function indexInvoice()
    {
      $invoices = Invoice::orderBy('created_at', 'DESC')->get();
      return view('invoice.index', compact('invoices'));
    }

    public function printInvoice($id)
    {
      $invoice = Invoice::find($id);
      $pdf = PDF::loadView('invoice.pdf', ['invoice' => $invoice]);
      return $pdf->stream('invoice-' . $invoice->reservation->customer->name . '.pdf');
    }

    //==========REPORT==========//

    public function indexReport()
    {
      $reports = Report::orderBy('created_at', 'DESC')->get();
      return view('report.index', compact('reports'));
    }

    public function printReport($id)
    {
      $report = Report::find($id);
      $roomtotal = 0;
      $additionaltotal = 0;
      foreach ($report->invoices as $invoice) {
        $roomtotal += $invoice->reservation->total;
        foreach ($invoice->additionals as $additional) {
          $additionaltotal += $additional->price * $additional->pivot->quantity;
        }
      }
      $pdf = PDF::loadView('report.pdf', ['report' => $report, 'additionaltotal' => $additionaltotal, 'roomtotal' => $roomtotal]);
      return $pdf->stream('report-' . date('F', strtotime($report->created_at)) . '-' . $report->year . '.pdf');
    }
}
