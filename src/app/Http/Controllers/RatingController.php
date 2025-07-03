<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'media_id' => 'required|string',
            'media_type' => 'required|in:movie,tv',
            'adult' => 'required|in:0,1',
            'rating' => 'required|integer|min:1|max:10',
        ]);
        Rating::updateOrCreate([
            'user_id' => auth()->id(),
            'media_id' => $data['media_id'],
            'media_type' => $data['media_type'],
            'adult' => $data['adult'],
            ],
            ['rating' => $data['rating']]
        );

        return back()->with('success', 'Rating saved.');
    }
}
