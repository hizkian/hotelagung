<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{

  protected $fillable = [
      'name', 'price',
  ];

  public function invoices(){
    return $this->belongsToMany('App\Models\Invoice')
    ->withPivot('invoice_id', 'additional_id', 'quantity')
      ->withTimestamps();
  }
}
