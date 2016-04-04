<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoInitLog extends Model
{
    //
  protected $table  = 'info_init_logs';
  protected $guarded = ['id'];
  
  public function user()
  {
    return $this->belongsTo('App\User');
  }


}
