<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConfigService;
use App\Managers\MediaListManager;

class HomeController extends Controller {   
    protected MediaListManager $manager;

    public function __construct(MediaListManager $manager) {
        $this->manager = $manager;
    }

    public function index(Request $request) {
        $lists = [];
        $keys = ConfigService::pagelists('home');
        foreach ($keys as $v => $k) {
            $lists[$v] = [
                'title' => ConfigService::getTitle($k, $v),
                'subtitle' => ConfigService::getSubtitle($k, $v),
                'items' => $this->manager->handle($k, $v),
            ];
        }
        return view('home', compact('lists'));
    }
}    