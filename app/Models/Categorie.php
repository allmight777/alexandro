<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
     protected $fillable = ['nom'];

    // Relation AU PLURIEL car une catégorie peut avoir PLUSIEURS équipements
    public function equipement()
    {
        return $this->hasMany(Equipement::class);
    }
}
