<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    protected $fillable = [
        'user_id',
        'media_id',
        'media_type',
        'content',
        'approved'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reports() {
        return $this->hasMany(ReviewReport::class);
    }
}
