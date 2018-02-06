<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $fillable = [
      'total', 'status', 'additional_id', 'reservation_id'
  ];

  public function reservation(){
    return $this->belongsTo('App\Models\Reservation');
  }

  public function additionals()
  {
    return $this->belongsToMany('App\Models\Additional')
    ->withPivot('invoice_id', 'additional_id', 'quantity')
    ->withTimestamps();
  }

  public function report(){
    return $this->belongsTo('App\Models\Report');
  }
}
