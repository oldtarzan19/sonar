<?php

namespace Database\Factories;

use App\Models\Track;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'duration' => fake()->numberBetween(120, 300),
            'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-'. fake()->numberBetween(1,17) .'.mp3',
            'cover_image_url' => $this->randomLogoUrl(),
            'video_url' => fake()->randomElement([
                'https://samplelib.com/lib/preview/mp4/sample-5s.mp4',
                'https://samplelib.com/lib/preview/mp4/sample-10s.mp4',
                'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            ]),
        ];
    }

    private function randomLogoUrl(): string
    {
        $first = fake()->numberBetween(190, 250);
        $second = fake()->numberBetween(290, 350);
        return 'https://picsum.photos/' . $first . '/' . $second;
    }
}
