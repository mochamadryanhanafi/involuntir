<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Event::factory(20)->create()->each(function ($event) use ($users) {
            $event->users()->attach(
                $users->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
