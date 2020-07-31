<?php

namespace App;

use App\Support\Cropper;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'document',
        'document_secondary',
        'document_secondary_complement',
        'date_of_birth',
        'place_of_birth',
        'civil_status',
        'cover',
        'occupation',
        'income',
        'company_work',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'telephone',
        'cell',
        'type_of_communion',
        'spouse_name',
        'spouse_genre',
        'spouse_document',
        'spouse_document_secondary',
        'spouse_document_secondary_complement',
        'spouse_date_of_birth',
        'spouse_place_of_birth',
        'spouse_occupation',
        'spouse_income',
        'spouse_company_work',
        'lessor',
        'lessee',
        'admin',
        'client',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setLessorAttribute($value)
    {
        $this->attributes['lessor'] = (bool) ($value === "on");
    }

    public function setLesseeAttribute($value)
    {
        $this->attributes['lessee'] = (bool) ($value === "on");
    }

    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = (bool) ($value === "on");
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = (bool) ($value === "on");
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = $this->clearField($value);
    }

    public function getDocumentAttribute($value)
    {
        if ($value) return sprintf("%s.%s.%s-%s", 
            substr($value, 0, 3), substr($value, 3, 3), substr($value, 6, 3), substr($value, 9, 2));
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = $this->convertStringToDouble($value);
    }

    public function getIncomeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $this->convertStringToDate($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        if ($value) return Carbon::createFromFormat("Y-m-d", $value)->format('d/m/Y');
        return null;
    }

    public function setSpouseDocumentAttribute($value)
    {
        $this->attributes['spouse_document'] = $this->clearField($value);
    }

    public function getSpouseDocumentAttribute($value)
    {
        if ($value) return sprintf("%s.%s.%s-%s", 
            substr($value, 0, 3), substr($value, 3, 3), substr($value, 6, 3), substr($value, 9, 2));
    }

    public function setSpouseIncomeAttribute($value)
    {
        $this->attributes['spouse_income'] = $this->convertStringToDouble($value);
    }

    public function getSpouseIncomeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setSpouseDateOfBirthAttribute($value)
    {
        $this->attributes['spouse_date_of_birth'] = $this->convertStringToDate($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = $this->clearField($value);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = $this->clearField($value);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = $this->clearField($value);
    }

    public function getUrlCoverAttribute()
    {
        if(!empty($this->cover)){
            return Storage::url(Cropper::thumb($this->cover, 500, 500));
        }

        return '';
    }

    private function convertStringToDate(?string $value, $format="d/m/Y"){
        if(empty($value)){
            return null;
        }

        return Carbon::createFromFormat($format, $value)->format('Y-m-d');
    }

    private function clearField(?string $value){
        if(empty($value)){
            return "";
        }
        return str_replace([
            '.',
            '-',
            '(',
            ')',
            ' '
        ], '', $value);
    }

    private function convertStringToDouble(?string $value){
        if(empty($value)){
            return null;
        }

        return (float) str_replace(['.', ','], ['', '.'], $value);
    }
}
