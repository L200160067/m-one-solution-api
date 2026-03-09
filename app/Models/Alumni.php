<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Alumni extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'school', 'batch_period', 'order_column',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }
}
