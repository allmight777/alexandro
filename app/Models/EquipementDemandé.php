<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipementDemandé extends Model
{
    public function demande()
{
    return $this->belongsTo(Demande::class);
}

public function equipement()
{
    return $this->belongsTo(Equipement::class);
}

}
