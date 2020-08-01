<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'sale',
        'rent',
        'owner_id',
        'owner_spouse',
        'owner_company_id',
        'acquirer_id',
        'acquirer_spouse',
        'acquirer_company_id',
        'property_id',
        'sale_price',
        'rent_price',
        'price',
        'tribute',
        'condominium',
        'due_date',
        'deadline',
        'start_at',
        'status'
     ];     

     public function setSaleAttribute($value)
     {
         if($value === true || $value === 'on') {
             $this->attributes['sale'] = 1;
             $this->attributes['rent'] = 0;
         }
     }
 
    public function setRentAttribute($value)
    {
        if($value === true || $value === 'on') {
            $this->attributes['rent'] = 1;
            $this->attributes['sale'] = 0;
        }
    }

    public function setOwnerSpouseAttribute($value)
    {
        $this->attributes['owner_spouse'] = ($value === '1' ? 1 : 0);
    }

    public function setOwnerCompanyAttribute($value)
    {
        if($value == '0'){
            $this->attributes['owner_company'] = null;
        } else {
            $this->attributes['owner_company'] = $value;
        }
    }

    public function setAcquirerSpouseAttribute($value)
    {
        $this->attributes['acquirer_spouse'] = ($value === '1' ? 1 : 0);
    }

    public function setAcquirerCompanyAttribute($value)
    {
        if($value == '0'){
            $this->attributes['acquirer_company'] = null;
        } else {
            $this->attributes['acquirer_company'] = $value;
        }
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setSalePriceAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function setRentPriceAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getTributeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setTributeAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['tribute'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getCondominiumAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setCondominiumAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['condominium'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getStartAtAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function setStartAtAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['start_at'] = $this->convertStringToDate($value);
        }
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function acquirer()
    {
        return $this->belongsTo(User::class, 'acquirer_id');
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
    }

    private function convertStringToDate(?string $value, $format="d/m/Y"){
        if(empty($value)) {
            return null;
        }

        return Carbon::createFromFormat($format, $value)->format('Y-m-d');
    }
}
