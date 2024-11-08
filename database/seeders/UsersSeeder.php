<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([
            'function_id' => 1,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('password_reset_tokens')->insert([
            'email' => 'jane@example.com',
            'token' => Str::random(60),
            'created_at' => now(),
        ]);

        DB::table('sessions')->insert([
            'id' => Str::uuid(),
            'user_id' => 1,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'payload' => json_encode(['data' => 'example_payload']),
            'last_activity' => time(),
        ]);
    }
}
