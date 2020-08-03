<?php

namespace App\Http\Requests\Admin;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');

        if ($id instanceof User) {
            $id = $id->id;
        } else {
            $id = "NULL";
        }

        $typeCommunion = [
            "Comunhão Universal de Bens",
            "Comunhão Parcial de Bens",
            "Separação Total de Bens",
            "Participação Final de Aquestos",
        ];

        $rules  = [
            'name' => ['required', 'max:191', 'min:3'],
            'genre' => ['required', 'in:male,female,other'],
            'document' => ['required', 'min:11', 'max:14', 'unique:users,document,{$id},id'],
            'document_secondary' => ['required', 'min:8', 'max:12'],
            'document_secondary_complement' => ['required'],
            'date_of_birth' => ['required', 'date_format:d/m/Y'],
            'place_of_birth' => ['required'],
            'civil_status' => ['required', 'in:married,separated,single,divorced,widower'],
            'cover' => ['image'],

            #Income
            'occupation' => ['required', 'max:191'],
            'income' => ['required'],
            'company_work' => ['max:191'],

            #Address
            'zipcode' => ['required', 'min:8', 'max:9'],
            'street' => ['required', 'max:191'],
            'number' => ['required', 'max:50'],
            'complement' => ['max:191'],
            'neighborhood' => ['required', 'max:191'],
            'state' => ['required', 'max:191'],
            'city' => ['required', 'max:191'],

            #Contact
            'telephone' => ['max:20'],
            'cell' => ['required', 'max:20'],

            #Access
            'email' => ['required', 'email', 'max:191', "unique:users,email,{$id},id"],

            #Spouse
            'type_of_communion' => [
                'required_if:civil_status,married,separated',
                'in:' . implode(',', $typeCommunion)
            ],
            'spouse_name' => ['required_if:civil_status,married,separated', 'max:191'],
            'spouse_genre' => ['required_if:civil_status,married,separated', 'in:male,female,other'],
            'spouse_document' => ['required_if:civil_status,married,separated', 'max:14'],
            'spouse_document_secondary' => ['required_if:civil_status,married,separated', 'max:12'],
            'spouse_document_secondary_complement' => ['required_if:civil_status,married,separated'],
            'spouse_date_of_birth' => ['required_if:civil_status,married,separated'],
            'spouse_place_of_birth' => [],
            'spouse_occupation' => ['required_if:civil_status,married,separated', 'max:191'],
            'spouse_income' => ['required_if:civil_status,married,separated'],
            'spouse_company_work' => ['max:191'],
        ];

        if(in_array($this->request->get('civil_status'), ["married", "separated"])) {
            $rules["spouse_name"] += ['min:3'];
            $rules["spouse_document"] += ['min:8'];
            $rules["spouse_document_secondary"] += ['min:8'];
            $rules["spouse_date_of_birth"] += ['date_format:d/m/Y'];
        }

        if($id == null ){
            $rules += ['password' => ['required', 'max:20', 'min:6']];
        }

        return $rules;
    }
}
