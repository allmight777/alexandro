<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['nom' => 'Matériel Informatique', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Matériel Réseau & Télécom', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Outils d’Intervention Terrain', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Équipements de Sécurité', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Appareils de Communication', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Logiciels & Licences', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Équipements de Mobilité', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Mobilier de Bureau', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
