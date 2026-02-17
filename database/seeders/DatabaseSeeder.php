<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TrackFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(100)
            ->create()
            ->each(function ($user) {
                if (fake()->boolean(40)) {
                    Artist::factory()->for($user)
                        ->has(TrackFactory::new()->count(fake()->numberBetween(1, 17)))
                        ->create();
                }
            });
    }
}
