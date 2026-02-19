<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Inertia\Inertia;

class CollectionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $count = $user->favorites()->count();

        return Inertia::render('FavoriteSongs/Index', [
            'tracks' => Inertia::scroll(fn() =>
                $user->favorites()
                    ->with('artist')
                    ->orderByPivot('created_at', 'desc')
                    ->paginate(20)
                    ->through(function (Track $track) {
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
                            'liked_date' => optional($track->favorites?->created_at)?->format('Y-m-d H:i:s'),
                        ];
                    })
            ),
            'tracks_count' => $count,
        ]);
    }
}
