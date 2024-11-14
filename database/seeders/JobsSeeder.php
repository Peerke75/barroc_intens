<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('jobs')->insert([
            'queue' => 'default',
            'payload' => json_encode(['data' => 'sample_payload']),
            'attempts' => 1,
            'reserved_at' => now()->timestamp,
            'available_at' => now()->addMinutes(5)->timestamp,
            'created_at' => now()->timestamp,
        ]);

        DB::table('job_batches')->insert([
            'id' => Str::uuid(),
            'name' => 'Batch 1',
            'total_jobs' => 10,
            'pending_jobs' => 5,
            'failed_jobs' => 0,
            'failed_job_ids' => '[]',
            'options' => json_encode(['retry' => true]),
            'cancelled_at' => null,
            'created_at' => now()->timestamp,
            'finished_at' => null,
        ]);

        DB::table('failed_jobs')->insert([
            'uuid' => Str::uuid(),
            'connection' => 'database',
            'queue' => 'default',
            'payload' => json_encode(['data' => 'failed_payload']),
            'exception' => 'Exception details...',
            'failed_at' => now(),
        ]);
    }
}
