<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $fillable = ['nom', 'etat', 'marque', 'description', 'date_acquisition', 'image_path', 'categorie_id'];

    // Relation avec les demandes (via la table pivot)
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
// <<<<<<< HEAD


//     // ---------------------------------------------------------------------
//     public function demandes()
//     {
//         return $this->belongsToMany(Demande::class, 'equipements_demandes')
//             ->withPivot('nbr_equipement')
//             ->withTimestamps();
//     }

//     public function equipementsDemandes()
//     {
//         return $this->hasMany(EquipementDemandé::class);
//     }


//     // app/Models/Equipement.php

//     public function scopeEnPanne($query)
//     {
//         return $query->where('etat', 'panne');
// =======
    public function demandes()
    {

        return $this->belongsToMany(Demande::class, "equipement_demandés")
            ->withPivot('nbr_equipement');
// >>>>>>> origin/xandrodev
    }
    public function users()
    {
        return $this->belongsToMany(User::class, "affectations")
            ->withPivot('date_retour');
    }
    public function pannes(){
        return $this->hasMany(Panne::class);
    }
   
}
