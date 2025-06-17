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
    public function demandes(){

            return $this->belongsToMany(Demande::class,"equipement_demandés")
                       ->withPivot('nbr_equipement'); 
        
    }
}
