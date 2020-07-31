<?php

namespace App\Http\Requests\Admin;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required'],
            'social_name' => ['required', 'min:3', 'max:191'],
            'alias_name' => ['max:191'],
            'document_company' => ['max:18'],
            'document_company_secondary' => ['max:30'],
            
            #Address
            'zipcode' => ['required', 'min:8', 'max:9'],
            'street' => ['required', 'max:191'],
            'number' => ['required', 'max:50'],
            'complement' => ['max:191'],
            'neighborhood' => ['required', 'max:191'],
            'state' => ['required', 'max:191'],
            'city' => ['required', 'max:191'],
        ];
    }
}
