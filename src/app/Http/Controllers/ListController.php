<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use App\Models\ListMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller {
    public function index() {
        $lists = Auth::user()->lists()->latest()->get();
        return view('lists.index', compact('lists'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required|string|max:255', 'visibility' => 'in:public,private']);

        Auth::user()->lists()->create($request->only('title', 'visibility'));

        return redirect()->route('lists.index');
    }

    public function show(ListModel $list) {
        if ($list->visibility === 'private' && $list->user_id !== Auth::id()) {
            abort(403);
        }

        $mediaItems = $list->media()->get();

        return view('lists.show', compact('list', 'mediaItems'));
    }

    public function destroy(ListModel $list) {
        $this->authorize('delete', $list); // optional policy
        $list->delete();

        return redirect()->route('lists.index');
    }

    public function addMedia(Request $request, ListModel $list)
    {
        $request->validate([
            'media_id' => 'required|string',
            'media_type' => 'required|in:movie,tv,person',
        ]);

        if ($list->user_id !== Auth::id()) abort(403);

        ListMedia::updateOrCreate([
            'list_id' => $list->id,
            'media_id' => $request->media_id,
            'media_type' => $request->media_type,
        ]);

        return back();
    }

    public function removeMedia(Request $request, ListModel $list) {
        $request->validate([
            'media_id' => 'required|string',
            'media_type' => 'required|in:movie,tv,person',
        ]);

        if ($list->user_id !== Auth::id()) abort(403);

        ListMedia::where([
            'list_id' => $list->id,
            'media_id' => $request->media_id,
            'media_type' => $request->media_type,
        ])->delete();

        return back();
    }
}
