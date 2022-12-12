<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiFormRequest;

class UpdateUserAddressRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=>'nullable',
            'last_name'=>'required',
            'address'=>'required',
            'district'=>'nullable',
            'national_number'=>'nullable|ir_national_code|unique:App\Models\UserAddress,national_number',
            'plaque'=>'required|numeric',
            'state_id'=>'required|exists:App\Models\State,id',
            'city_id'=>'required|exists:App\Models\City,id',
            'unit'=>'required',
            'postal_code'=>'required|ir_postal_code',
            'mobile'=>'required|ir_mobile',
            'phone'=>'required|ir_phone_with_code',
        ];
    }
}
