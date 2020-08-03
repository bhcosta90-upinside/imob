<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $fillable = [
        'user_id',
        'social_name',
        'alias_name',
        'document_company',
        'document_company_secondary',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city'
    ];

    public function setDocumentCompanyAttribute($value)
    {
        $this->attributes['document_company'] = $this->clearField($value);
    }

    public function getDocumentCompanyAttribute($value)
    {
        #11.111.111/1111-11

        if ($value) return sprintf("%s.%s.%s/%s.%s", 
            substr($value, 0, 2), 
            substr($value, 2, 3), substr($value, 5, 3), substr($value, 8, 4), substr($value, 12, 2));
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
            ' ',
            '/'
        ], '', $value);
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
