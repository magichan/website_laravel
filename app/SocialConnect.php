<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialConnect extends Model
{


  protected $table = 'social_connect';

  public function user()
  {
    return $this->belongsTo('App\User');
  }



}
