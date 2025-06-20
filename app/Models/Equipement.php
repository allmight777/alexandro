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
    public function demandes()
    {

        return $this->belongsToMany(Demande::class, "equipement_demandés")
            ->withPivot('nbr_equipement');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, "affectations")
            ->withPivot('date_retour');
    }
    public function pannes()
    {
        return $this->hasMany(Panne::class);
    }
    public function affectations(){
        return   $this->hasMany(Affectation::class);
    }
}
