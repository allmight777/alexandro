<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;


// class GestionnaireSeeder extends Seeder
// {
//     public function run()
//     {
//         if (!User::where('email', 'aden@gmail.com')->exists()) {
//             User::create([
//                 'nom' => 'Aden',
//                 'prenom' => 'Gest',
//                 'email' => 'aden@gmail.com',
//                 'password' => Hash::make('aden123@'), // mot de passe clair: aden123@
//                 'role' => 'gestionnaire',
//                 'poste' => 'Gestionnaire',
//             ]);
//         }
//     }
// }


class GestionnaireSeeder extends Seeder
{
    public function run()
    {
        // Solution recommandée : updateOrCreate
        User::updateOrCreate(
            ['email' => 'aden@gmail.com'],
            [
                'nom' => 'Aden',
                'prenom' => 'Gest',
                'password' => bcrypt('aden123@'),
                'role' => 'gestionnaire',
                'service' => 'Informatique',
                'poste' => 'Responsable IT',
                'email_verified_at' => now()
            ]
        );
    }
}