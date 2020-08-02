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

     public static function boot()
     {
         parent::boot();
         parent::saved(function($obj){
             if($obj->property_id) {
                $objProperty = Property::find($obj->property_id);
                $objProperty->status = $obj->status == 'active' ? false : true;
                $objProperty->save();
             }
         });
     } 

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
        $this->attributes['owner_spouse'] = ($value === '1' ? true : false);
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
        $this->attributes['acquirer_spouse'] = ($value === '1' ? true : false);
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

    public function ownerCompany()
    {
        return $this->hasOne(Company::class, 'id', 'owner_company_id');
    }

    public function acquirerCompany()
    {
        return $this->hasOne(User::class, 'id', 'acquirer_id');
    }

    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function terms()
    {
        $parameters = [
            'purpouse' => '',
            'part' => '',
            'part_opposite' => '',
        ];

        // Finalidade [Venda/Locação]
        if ($this->sale == true) {
            $parameters = [
                'purpouse' => 'VENDA',
                'part' => 'VENDEDOR',
                'part_opposite' => 'COMPRADOR',
            ];
        }

        if ($this->rent == true) {
            $parameters = [
                'purpouse' => 'LOCAÇÃO',
                'part' => 'LOCADOR',
                'part_opposite' => 'LOCATÁRIO',
            ];
        }

        $terms[] = "<p style='text-align: center;'>{$this->id} - CONTRATO DE {$parameters['purpouse']} DE IMÓVEL</p>";

        // OWNER
        if (!empty($this->owner_company_id)) { // Se tem empresa
            if (!empty($this->owner_spouse)) { // E tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->ownerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->ownerCompany->document_company} e I. E. nº {$this->ownerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->ownerCompany->street}, nº {$this->ownerCompany->number}, {$this->ownerCompany->complement}, {$this->ownerCompany->neighborhood}, {$this->ownerCompany->city}/{$this->ownerCompany->state}, CEP {$this->ownerCompany->zipcode} tendo como responsável legal {$this->owner->name}, natural de {$this->owner->place_of_birth}, ".__($this->owner->civil_status).", {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, e cônjuge {$this->owner->spouse_name}, natural de {$this->owner->spouse_place_of_birth}, {$this->owner->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->owner->spouse_document_secondary} {$this->owner->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->spouse_document}, residentes e domiciliados à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->ownerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->ownerCompany->document_company} e I. E. nº {$this->ownerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->ownerCompany->street}, nº {$this->ownerCompany->number}, {$this->ownerCompany->complement}, {$this->ownerCompany->neighborhood}, {$this->ownerCompany->city}/{$this->ownerCompany->state}, CEP {$this->ownerCompany->zipcode} tendo como responsável legal {$this->owner->name}, natural de {$this->owner->place_of_birth}, ".__($this->owner->civil_status).", {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, residente e domiciliado à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            }
        } else { // Se não tem empresa

            if (!empty($this->owner_spouse)) { // E tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->owner->name}</b>, natural de {$this->owner->place_of_birth}, ".__($this->owner->civil_status).", {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, e cônjuge {$this->owner->spouse_name}, natural de {$this->owner->spouse_place_of_birth}, {$this->owner->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->owner->spouse_document_secondary} {$this->owner->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->spouse_document}, residentes e domiciliados à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>1. {$parameters['part']}: {$this->owner->name}</b>, natural de {$this->owner->place_of_birth}, ".__($this->owner->civil_status).", {$this->owner->occupation}, portador da cédula de identidade R. G. nº {$this->owner->document_secondary} {$this->owner->document_secondary_complement}, e inscrição no C. P. F. nº {$this->owner->document}, residente e domiciliado à {$this->owner->street}, nº {$this->owner->number}, {$this->owner->complement}, {$this->owner->neighborhood}, {$this->owner->city}/{$this->owner->state}, CEP {$this->owner->zipcode}.</p>";
            }
        }

        // ACQUIRER
        // Se tem empresa
        if (!empty($this->acquirer_company_id)) { // Se tem empresa
            if (!empty($this->acquirer_spouse)) { // E tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->acquirerCompany->document_company} e I. E. nº {$this->acquirerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->acquirerCompany->street}, nº {$this->acquirerCompany->number}, {$this->acquirerCompany->complement}, {$this->acquirerCompany->neighborhood}, {$this->acquirerCompany->city}/{$this->acquirerCompany->state}, CEP {$this->acquirerCompany->zipcode} tendo como responsável legal {$this->acquirer->name}, natural de {$this->acquirer->place_of_birth}, ".__($this->acquirer->civil_status).", {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, e cônjuge {$this->acquirer->spouse_name}, natural de {$this->acquirer->spouse_place_of_birth}, {$this->acquirer->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->spouse_document_secondary} {$this->acquirer->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->spouse_document}, residentes e domiciliados à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirerCompany->social_name}</b>, inscrito sob C. N. P. J. nº {$this->acquirerCompany->document_company} e I. E. nº {$this->acquirerCompany->document_company_secondary} exercendo suas atividades no endereço {$this->acquirerCompany->street}, nº {$this->acquirerCompany->number}, {$this->acquirerCompany->complement}, {$this->acquirerCompany->neighborhood}, {$this->acquirerCompany->city}/{$this->acquirerCompany->state}, CEP {$this->acquirerCompany->zipcode} tendo como responsável legal {$this->acquirer->name}, natural de {$this->acquirer->place_of_birth}, ".__($this->acquirer->civil_status).", {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, residente e domiciliado à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            }
        } else { // Se não tem empresa
            if (!empty($this->acquirer_spouse)) { // E tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirer->name}</b>, natural de {$this->acquirer->place_of_birth}, ".__($this->acquirer->civil_status).", {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, e cônjuge {$this->acquirer->spouse_name}, natural de {$this->acquirer->spouse_place_of_birth}, {$this->acquirer->spouse_occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->spouse_document_secondary} {$this->acquirer->spouse_document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->spouse_document}, residentes e domiciliados à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            } else { // E não tem conjuge
                $terms[] = "<p><b>2. {$parameters['part_opposite']}: {$this->acquirer->name}</b>, natural de {$this->acquirer->place_of_birth}, ".__($this->acquirer->civil_status).", {$this->acquirer->occupation}, portador da cédula de identidade R. G. nº {$this->acquirer->document_secondary} {$this->acquirer->document_secondary_complement}, e inscrição no C. P. F. nº {$this->acquirer->document}, residente e domiciliado à {$this->acquirer->street}, nº {$this->acquirer->number}, {$this->acquirer->complement}, {$this->acquirer->neighborhood}, {$this->acquirer->city}/{$this->acquirer->state}, CEP {$this->acquirer->zipcode}.</p>";
            }
        }

        $terms[] = "<p style='font-style: italic; font-size: 0.875em;'>A falsidade dessa declaração configura crime previsto no Código Penal Brasileiro, e passível de apuração na forma da Lei.</p>";

        $terms[] = "<p><b>5. IMÓVEL:</b> {$this->property->category}, {$this->property->type}, localizada no endereço {$this->property->street}, nº {$this->property->number}, {$this->property->complement}, {$this->property->neighborhood}, {$this->property->city}/{$this->property->state}, CEP {$this->property->zipcode}</p>";

        $terms[] = "<p><b>6. PERÍODO:</b> {$this->deadline} meses</p>";

        $terms[] = "<p><b>7. VIGÊNCIA:</b> O presente contrato tem como data de início {$this->start_at} e o término exatamente após a quantidade de meses descrito no item 6 deste.</p>";

        $terms[] = "<p><b>8. VENCIMENTO:</b> Fica estipulado o vencimento no dia {$this->due_date} do mês posterior ao do início de vigência do presente contrato.</p>";

        $terms[] = "<p>Florianópolis, " . date('d/m/Y') . ".</p>";

        $terms[] = "<table width='100%' style='margin-top: 50px;'>
                           <tr>
                                <td>_________________________</td>
                                " . ($this->owner_spouse ? "<td>_________________________</td>" : "") . "
                           </tr>
                           <tr>
                                <td>{$parameters['part']}: {$this->owner->name}</td>
                                " . ($this->owner_spouse ? "<td>Conjuge: {$this->owner->spouse_name}</td>" : "") . "
                           </tr>
                           <tr>
                                <td>Documento: {$this->owner->document}</td>
                                " . ($this->owner_spouse ? "<td>Documento: {$this->owner->spouse_document}</td>" : "") . "
                           </tr>
                           
                    </table>";


        $terms[] = "<table width='100%' style='margin-top: 50px;'>
                           <tr>
                                <td>_________________________</td>
                                " . ($this->acquirer_spouse ? "<td>_________________________</td>" : "") . "
                           </tr>
                           <tr>
                                <td>{$parameters['part_opposite']}: {$this->acquirer->name}</td>
                                " . ($this->acquirer_spouse ? "<td>Conjuge: {$this->acquirer->spouse_name}</td>" : "") . "
                           </tr>
                           <tr>
                                <td>Documento: {$this->acquirer->document}</td>
                                " . ($this->acquirer_spouse ? "<td>Documento: {$this->acquirer->spouse_document}</td>" : "") . "
                           </tr>
                           
                    </table>";

        $terms[] = "<table width='100%' style='margin-top: 50px;'>
                           <tr>
                                <td>_________________________</td>
                                <td>_________________________</td>
                           </tr>
                           <tr>
                                <td>1ª Testemunha: </td>
                                <td>2ª Testemunha: </td>
                           </tr>
                           <tr>
                                <td>Documento: </td>
                                <td>Documento: </td>
                           </tr>
                           
                    </table>";

        return str_replace(', ,',',', implode('', $terms));
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
