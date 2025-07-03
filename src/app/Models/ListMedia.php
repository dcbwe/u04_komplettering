<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListMedia extends Model {
    protected $fillable = [
        'list_id',
        'media_id',
        'media_type'
    ];

    public function list() {
        return $this->belongsTo(ListModel::class);
    }
}
