<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    //

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class,"equipement_demandés")
            ->withPivot('nbr_equipement')  // Important pour accéder à la quantité
            ->withTimestamps();      // Si tu utilises les timestamps sur ta table pivot
    }
}
