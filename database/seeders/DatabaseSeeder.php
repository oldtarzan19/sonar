<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Track;
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
        $this->seedTracks();
    }


    protected function seedTracks(): void
    {
        $users = User::all();
        $tracks = Track::all();

        foreach ($users as $user) {
            $user->favorites()->saveMany($tracks->random(fake()->numberBetween(1, min($tracks->count(), 300))));
        }
    }
}
