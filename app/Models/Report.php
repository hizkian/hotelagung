<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $fillable = [
      'month', 'year', 'invoices_id', 'total'
  ];

  public function invoices(){
    return $this->hasMany('App\Models\Invoice');
  }
}
