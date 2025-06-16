<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    //
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
