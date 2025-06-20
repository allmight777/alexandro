<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Categorie extends Model
{
    //
    protected $fillable = ['nom'];
    protected $table = 'categories'; // Spécifie le nom de la table

    // Relation AU PLURIEL car une catégorie peut avoir PLUSIEURS équipements
    public function equipement()
    {
        return $this->hasMany(Equipement::class);
    }
}
