<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
   protected $table = 'donate';
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
