<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    // protected $fillable = ['lieu', 'motif', 'statut', 'user_id','created_at','updated_at'];

    // Relation avec l'employé (celui qui a fait la demande)
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    // // Relation avec les équipements demandés (via la table pivot)
    // public function equipements()
    // {
    //     return $this->belongsToMany(Equipement::class, 'equipements_demandes')
    //         ->withPivot('nbr_equipement')
    //         ->withTimestamps();
    // }
    public function user()
{
    return $this->belongsTo(User::class);
}

public function equipements()
{
    return $this->hasMany(EquipementDemandé::class);
}

}