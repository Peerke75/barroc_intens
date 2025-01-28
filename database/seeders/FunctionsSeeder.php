<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('functions')->insert([
            'name' => 'admin',
            'description' => 'doet alles beheeren.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'sales',
            'description' => 'die zorgt voor de verkoop van producten en diensten.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'finance',
            'description' => 'regelt alle financiële zaken.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'maintenance',
            'description' => 'regelt alle reparaties die gedaan moeten worden.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'stocker',
            'description' => 'zorgt voor de promotie van producten en diensten.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'sales head',
            'description' => 'de baas van de afdeling verkoop.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'finance head',
            'description' => 'de baas van de afdeling financien.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'maintenance head',
            'description' => 'de baas van de afdeling onderhoud.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'stocker head',
            'description' => 'de baas van de afdeling inkoop.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
