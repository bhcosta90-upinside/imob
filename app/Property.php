<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    public $fillable = [
        'sale',
        'rent',
        'category',
        'type',
        'user_id',
        'sale_price',
        'rent_price',
        'tribute',
        'condominium',
        'description',
        'bedrooms',
        'suites',
        'bathrooms',
        'rooms',
        'garage',
        'garage_covered',
        'area_total',
        'area_util',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'air_conditioning',
        'bar',
        'library',
        'barbecue_grill',
        'american_kitchen',
        'fitted_kitchen',
        'pantry',
        'edicule',
        'office',
        'bathtub',
        'fireplace',
        'lavatory',
        'furnished',
        'pool',
        'steam_room',
        'view_of_the_sea',
        'status',
        'title',
        'slug',
        'headline',
        'experience'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function($obj){
            $obj->slug = str_slug($obj->title) . "-" . $obj->id;
            $obj->save();
        });
    }

    public function setSaleAttribute($value)
    {
        $this->attributes['sale'] = ($value == true || $value == 'on' ? true : false);
    }

    public function setRentAttribute($value)
    {
        $this->attributes['rent'] = ($value == true || $value == 'on' ? true : false);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == '1' ? true : false);
    }

    public function setSalePriceAttribute($value)
    {
        if(empty($value)){
            $this->attributes['sale_price'] = null;
        } else {
            $this->attributes['sale_price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getSalePriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setRentPriceAttribute($value)
    {
        if(empty($value)){
            $this->attributes['rent_price'] = null;
        } else {
            $this->attributes['rent_price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getRentPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setTributeAttribute($value)
    {
        if(empty($value)){
            $this->attributes['tribute'] = null;
        } else {
            $this->attributes['tribute'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getTributeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setCondominiumAttribute($value)
    {
        if(empty($value)){
            $this->attributes['condominium'] = null;
        } else {
            $this->attributes['condominium'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getCondominiumAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Mutator Air Conditioning
     *
     * @param $value
     */
    public function setAirConditioningAttribute($value)
    {
        $this->attributes['air_conditioning'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Bar
     *
     * @param $value
     */
    public function setBarAttribute($value)
    {
        $this->attributes['bar'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Library
     *
     * @param $value
     */
    public function setLibraryAttribute($value)
    {
        $this->attributes['library'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Barbecue Grill
     *
     * @param $value
     */
    public function setBarbecueGrillAttribute($value)
    {
        $this->attributes['barbecue_grill'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator American Kitchen
     *
     * @param $value
     */
    public function setAmericanKitchenAttribute($value)
    {
        $this->attributes['american_kitchen'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Fitted Kitchen
     *
     * @param $value
     */
    public function setFittedKitchenAttribute($value)
    {
        $this->attributes['fitted_kitchen'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Pantry
     *
     * @param $value
     */
    public function setPantryAttribute($value)
    {
        $this->attributes['pantry'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Edicule
     *
     * @param $value
     */
    public function setEdiculeAttribute($value)
    {
        $this->attributes['edicule'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Office
     *
     * @param $value
     */
    public function setOfficeAttribute($value)
    {
        $this->attributes['office'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Bathtub
     *
     * @param $value
     */
    public function setBathtubAttribute($value)
    {
        $this->attributes['bathtub'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Fire Place
     *
     * @param $value
     */
    public function setFirePlaceAttribute($value)
    {
        $this->attributes['fireplace'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Lavatory
     *
     * @param $value
     */
    public function setLavatoryAttribute($value)
    {
        $this->attributes['lavatory'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Furnished
     *
     * @param $value
     */
    public function setFurnishedAttribute($value)
    {
        $this->attributes['furnished'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Pool
     *
     * @param $value
     */
    public function setPoolAttribute($value)
    {
        $this->attributes['pool'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator Pool
     *
     * @param $value
     */
    public function setSteamRoomAttribute($value)
    {
        $this->attributes['steam_room'] = (($value === true || $value === 'on') ? true : false);
    }

    /**
     * Mutator View Of The Sea
     *
     * @param $value
     */
    public function setViewOfTheSeaAttribute($value)
    {
        $this->attributes['view_of_the_sea'] = (($value === true || $value === 'on') ? true : false);
    }

    public function cover()
    {
        $images = $this->images();
        $imagesClone = clone $images;

        $cover = $images->where('cover', 1)->first(['path']);

        if(!$cover) {
            $cover = $imagesClone->first(['path']);
        }

        if(empty($cover['path']) || !File::exists('../public/storage/' . $cover['path'])) {
            \Log::info(['../public/storage/' . $cover['path']]);
            return url(asset('backend/assets/images/realty.jpeg'));
        }

        return Storage::url(Cropper::thumb($cover['path'], 1366, 768));
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Company::class, 'user_id', 'id');
    }

    public function scopeAvailable(Builder $builder)
    {
        return $builder->where('status', true);
    }

    public function scopeUnavailable(Builder $builder)
    {
        return $builder->where('status', false);
    }

    public function scopeSale(Builder $builder)
    {
        return $builder->where('sale', 1);
    }

    public function scopeRent(Builder $builder)
    {
        return $builder->where('rent', 1);
    }

    public function getUrlExperienceAttribute()
    {
        return str_slug($this->experience);
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }
}
