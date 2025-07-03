<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaView extends Model {
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'media_id',
        'media_type',
        'adult',
        'viewed_at'
    ];

    protected $dates = [
        'viewed_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
