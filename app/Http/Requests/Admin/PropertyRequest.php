<?php

namespace App\Http\Requests\Admin;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'sale' => [],
            'rent' => [],
            'user_id' => 'required',
            'category' => 'required',
            'type' => 'required',
            'sale_price' => 'required_if:sale,on',
            'rent_price' => 'required_if:rent,on',
            'tribute' => 'required',
            'condominium' => 'required',
            'description' => 'required',
            'bedrooms' => 'required',
            'suites' => 'required',
            'bathrooms' => 'required',
            'rooms' => 'required',
            'garage' => 'required',
            'garage_covered' => 'required',
            'area_total' => 'required',
            'area_util' => 'required',
            'status' => 'boolean',

            // Address
            'zipcode' => 'required|min:8|max:9',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
            'city' => 'required',

            #Structure
            "air_conditioning" => [],
            "bar" => [],
            "library" => [],
            "barbecue_grill" => [],
            "american_kitchen" => [],
            "fitted_kitchen" => [],
            "pantry" => [],
            "edicule" => [],
            "office" => [],
            "bathtub" => [],
            "fireplace" => [],
            "lavatory" => [],
            "furnished" => [],
            "pool" => [],
            "steam_room" => [],
            "view_of_the_sea" => [],
        ];
    }
}
