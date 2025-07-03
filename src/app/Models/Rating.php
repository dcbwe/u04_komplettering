<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {
    protected $fillable = [
        'user_id',
        'media_id',
        'media_type',
        'adult',
        'rating'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
