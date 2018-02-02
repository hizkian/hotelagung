<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $fillable = [
      'name', 'status', 'price',
  ];

  public function reservations(){
    return $this->belongsToMany('App\Models\Reservation')
      ->withTimestamps();
  }
}
