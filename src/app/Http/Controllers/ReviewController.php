<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller {
    public function store(Request $request) {
        $data = $request->validate([
            'media_id' => 'required|string',
            'media_type' => 'required|in:movie,tv',
            'content' => 'required|string|min:5|max:3000',
        ]);

        Review::updateOrCreate([
                'user_id' => auth()->id(),
                'media_id' => $data['media_id'],
                'media_type' => $data['media_type'],
            ],[
                'content' => $data['content'],
                'approved' => true // NEED TO BE HANDLED
            ]
        );

        return back()->with('success', 'Review saved.');
    }
}
