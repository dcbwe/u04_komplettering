<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\ListModel;

class UserController extends Controller {
    public function loginForm() {
        return view('users.login');
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'login' => 'Incorrect, please try again!',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function signupForm() {
        return view('users.signup');
    }

    public function signup(SignupRequest $request) {
        $newUser = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        $newUser->lists()->createMany([
            ['title' => 'favorites'],
            ['title' => 'watchlist'],
        ]);

        return redirect()->route('users.login');
    } 

    public function toggle($mediaId, $type) {
        $user = auth()->user();
    
        $watchlist = $user->lists()->firstOrCreate([
            'title' => 'watchlist'
        ]);
    
        $item = $watchlist->items()
            ->where('media_type', $type)
            ->where('media_id', $mediaId)
            ->first();
    
        if ($item) {
            $item->delete();
        } else {
            $watchlist->items()->create([
                'media_type' => $type,
                'media_id'   => $mediaId,
            ]);
        }
    
        return back();
    }
    
}
