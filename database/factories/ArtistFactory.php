<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_name' => $this->generateStageName(),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'logo_url' => $this->randomLogoUrl(),
            'cover_url' => $this->randomLogoUrl(),
        ];
    }

    private function generateStageName(): string
    {
        $prefix = fake()->randomElement([
            'DJ', 'MC', 'Lil', 'Big', 'Young', 'Saint', 'Professor'
        ]);

        $core = fake()->randomElement([
            fake()->firstName(),
            fake()->userName(),
            fake()->word(),
            fake()->colorName(),
        ]);

        $suffix = fake()->optional()->randomElement([
            'Beats', 'Wave', 'X', 'Official', 'Music', 'Lab'
        ]);

        return trim("$prefix $core $suffix");
    }

    private function randomLogoUrl(): string
    {
        $first = fake()->numberBetween(190, 250);
        $second = fake()->numberBetween(290, 350);
        return 'https://picsum.photos/' . $first . '/' . $second;
    }
}
