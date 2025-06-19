<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panne extends Model
{
    //
  public function equipement(){
   return $this->belongsTo(Equipement::class);

  }
  public function user(){

    return $this->BelongsTo(User::class);
  }

}
