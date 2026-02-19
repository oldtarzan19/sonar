<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Inertia\Inertia;

class CollectionController extends Controller
{
    public function index()
    {
        $count = Track::whereHas('likedBy', fn($q) => $q->where('user_id', auth()->id()))
            ->count();

        return Inertia::render('FavoriteSongs/Index', [
            'tracks' => Inertia::optional(fn() =>
                Track::query()->with(['artist', 'likedBy' => fn ($q) => $q->where('user_id', auth()->id())->select('user_id')])->whereHas('likedBy', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                    ->get()
                    ->map(function ($track) {
                        return [
                            'id' => $track->id,
                            'name' => $track->name,
                            'artist' => [
                                'id' => $track->artist->id,
                                'artist_name' => $track->artist->artist_name,
                            ],
                            'duration' => $track->duration,
                            'audio_url' => $track->audio_url,
                            'cover_image_url' => $track->cover_image_url,
                            'video_url' => $track->video_url,
                            'liked_date' => optional($track->likedBy->first()?->pivot?->created_at)?->format('Y-m-d H:i:s'),
                        ];
                    })
                    ->values()
            ),
            'tracks_count' => $count
        ]);
    }
}
