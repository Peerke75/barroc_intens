<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('cache')->insert([
            'key' => 'sample_cache_key',
            'value' => json_encode(['data' => 'sample_cache_value']),
            'expiration' => now()->addMinutes(10)->timestamp,
        ]);

        DB::table('cache_locks')->insert([
            'key' => 'sample_lock_key',
            'owner' => 'system_user',
            'expiration' => now()->addMinutes(5)->timestamp,
        ]);
    }
}
