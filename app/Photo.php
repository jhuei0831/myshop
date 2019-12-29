<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Photo extends Model
{
    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }

        return Storage::disk('public')->url($this->attributes['image']);
    }

    protected $table = 'photos';

    protected $primaryKey = 'id';

    protected $fillable = [
        "title", "description", "image", "is_open",
    ];
}
