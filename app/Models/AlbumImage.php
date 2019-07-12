<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AlbumImage extends Model
{
    protected $fillable = [
        'path', 'active', 'item_id'
    ];
//    public $timestamps = false;

    public function scopeActive($query){
        return $query->whereActive(1);
    }
}
