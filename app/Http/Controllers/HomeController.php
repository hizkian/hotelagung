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
      $rooms = Room::all();
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
        'no_ktp' => 'required|min:16|max:16|regex:/[0-9]*/',
        'no_hp' => 'required|min:9|max:16|regex:/[0-9]*/',
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
      dd($req->room);

      foreach ($req->rooms as $room) {
        $room = Room::find($room);
        $room->status = 1;
        $room->save();
        $reservation->rooms()->attach($room);
        $reservation->total += $room->price;
        $reservation->save();
      }

      for ($i=0; $i < count($req->room); $i++) {
        $room = Room::find($req->room[$i]);
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
      $reservation = Reservation::find($req->reservation_id);
      $reservation->checkout = date('Y-m-d');
      $reservation->save();

      $invoice = new Invoice;
      $invoice->reservation_id = $req->reservation_id;
      $total = $reservation->total;
      for ($i=0; $i < count($req->additionals); $i++) {
        $additional = Additional::find($req->additionals[$i]);
        $total += $additional->price * $req->quantities[$i];
      }
      $invoice->total = $total;
      $invoice->save();

      // dd($req->quantities);

      for ($i=0; $i < count($req->additionals); $i++) {
        $additional = Additional::find($req->additionals[$i]);
        // $invoice->additionals()->save($additional, ['quantity' => $req->quantites[$i]]);
        $invoice->additionals()->attach(
          [$req->additionals[$i] => ['quantity' => '2']]
        );
      }
      foreach ($reservation->rooms as $room) {
        $room->status = 0;
        $room->save();
      }

      return redirect('/reservation')->with('message', 'Checkout Success!');
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

      return redirect()->back()->with('message', 'Additional successfully added!');
    }
}
