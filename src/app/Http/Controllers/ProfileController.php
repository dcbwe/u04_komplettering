<?php

namespace App\Http\Controllers;

use App\Managers\MediaListManager;
use App\Services\ConfigService;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    protected MediaListManager $manager;

    public function __construct(MediaListManager $manager) {
        $this->manager = $manager;
    }

    public function index(Request $request) {
        $lists = [];
        $keys = ConfigService::pagelists('profile');
        foreach ($keys as $v => $k) {
            $lists[$v] = [
                'title' => ConfigService::getTitle($k, $v),
                'subtitle' => ConfigService::getSubtitle($k, $v),
                'items' => $this->manager->handle($k, $v),
            ];
        }
        $current = $request->input('listname') ?? array_key_first($lists);
        $list = $lists[$current] ?? null;
    
        return view('profile', compact('lists', 'list', 'current'));
    }
    
}   
