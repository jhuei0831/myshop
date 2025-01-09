<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $is_open
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
