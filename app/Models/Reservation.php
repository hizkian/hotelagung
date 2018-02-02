<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $fillable = [
      'customer_id', 'checkin', 'checkout', 'dp', 'total', 'user_id',
  ];

  public function customer(){
    return $this->belongsTo('App\Models\Customer');
  }

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function rooms(){
    return $this->belongsToMany('App\Models\Room')
      ->withTimestamps();
  }
}
