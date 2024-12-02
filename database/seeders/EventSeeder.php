<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'user_id' => 1,
                'customer_id' => 1,
                'title' => 'Meeting with customer',
                'start' => '2024-11-04 10:00:00',
                'end' => '2024-11-04 11:00:00',
                'description' => 'Meeting with customer to discuss the new project.',
            ],
            [
                'user_id' => 1,
                'title' => 'Meeting with supplier',
                'start' => '2024-11-05 10:00:00',
                'end' => '2024-11-05 11:00:00',
                'description' => 'Meeting with supplier to discuss the new project.',
            ],
            [
                'user_id' => 1,
                'title' => 'Meeting with team',
                'start' => '2024-11-06 10:00:00',
                'end' => '2024-11-06 11:00:00',
                'description' => 'Meeting with team to discuss the new project.',
            ],
        ];

        foreach ($events as $event) {
            \App\Models\Event::create($event);
        }
    }
}
