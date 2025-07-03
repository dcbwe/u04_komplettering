<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',
        'username',
        'email', 
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function id() {
        return Auth::id();
    }

    public function hasInWatchlist($item): bool {
        $watchlist = $this->lists()->where('title', 'watchlist')->first();
    
        if (!$watchlist) {
            return false;
        }
    
        return $watchlist->items()
            ->where('media_type', $item->type())
            ->where('media_id', $item->id)
            ->exists();
    }
    

    public function lists() {
        return $this->hasMany(ListModel::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function views() {
        return $this->hasMany(MediaView::class);
    }
    
    public function reviewReports() {
        return $this->hasMany(ReviewReport::class);
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }
}
