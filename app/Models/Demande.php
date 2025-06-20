<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Demande extends Model
{
    // protected $fillable = ['lieu', 'motif', 'statut', 'user_id','created_at','updated_at'];

    // Relation avec l'employé (celui qui a fait la demande)
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    // Relation avec les équipements demandés (via la table pivot)
    // public function equipements()
    // {
    //     return $this->belongsToMany(Equipement::class, 'equipements_demandes')
    //         ->withPivot('nbr_equipement')
    //         ->withTimestamps();
    // }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class,"equipement_demandés")
            ->withPivot('nbr_equipement')  // Important pour accéder à la quantité
            ->withTimestamps();      // Si tu utilises les timestamps sur ta table pivot
    }






    public function user()
    {   
    return $this->belongsTo(User::class);
    }

// public function equipements()
// {
//     return $this->hasMany(EquipementDemandé::class);
// }

 }