<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
      'name', 'no_ktp', 'address', 'no_hp'
  ];

  public function reservations(){
    return $this->hasMany('App\Models\Reservation');
  }
}
