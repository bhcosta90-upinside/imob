<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PropertyImage extends Model
{
    public $fillable = [
        "property_id",
        "path",
        "cover",
    ];
    
    public function getUrlCroppedAttribute()
    {
        return Storage::url(Cropper::thumb($this->path, 1366, 768));
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('cover', 'DESC')->orderBy('id', 'DESC');
        });
    }
}
