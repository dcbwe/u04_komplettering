<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model {
    protected $table = 'lists';

    protected $fillable = [
        'title',
        'user_id',
        'visibility'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(ListMedia::class, 'list_id');
    }

    public function media() {
        return $this->hasMany(ListMedia::class);
    }
}
