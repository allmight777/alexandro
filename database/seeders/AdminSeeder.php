<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// class AdminSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         //
//         DB::table('users')->insert([
//             'nom' => 'Administrateur',
//             'prenom'=>'Jaspe',
//             'email' => 'admin@gmail.com',
//             'password' => Hash::make('admin123@'), // modifie le mot de passe !
//             'role' => 'admin',
//             'poste'=>'CEO'
//         ]);
//     }
// }

// <?php

// namespace Database\Seeders;



class AdminSeeder extends Seeder
{
    public function run()
    {
        // Solution recommandée : updateOrCreate
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nom' => 'Administrateur',
                'prenom' => 'Jaspe',
                'password' => bcrypt('admin123@'),
                'role' => 'admin',
                'poste' => 'CEO',
                'email_verified_at' => now(),
                'service'=>'JASPE_DIRECTION'
            ]
        );
    }
}