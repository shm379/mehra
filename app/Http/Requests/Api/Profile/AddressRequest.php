<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiFormRequest;

class AddressRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=>'required_if:for_me,0',
            'last_name'=>'required_if:for_me,0',
            'address'=>'required',
//            'district'=>'nullable',
            'national_number'=>'nullable|ir_national_code|unique:App\Models\UserAddress,national_number',
//            'plaque'=>'required|numeric',
            'state_id'=>'required|exists:App\Models\State,id',
            'city_id'=>'required|exists:App\Models\City,id',
//            'unit'=>'required',
            'postal_code'=>'nullable|ir_postal_code',
            'mobile'=>'nullable|ir_mobile',
            'phone'=>'nullable|ir_phone_with_code',
        ];
    }

    protected function prepareForValidation(): void
    {
        if($this->for_me==1) {
            $this->merge([
                'first_name' => $this->user() ? $this->user()->first_name : '',
                'last_name' => $this->user() ? $this->user()->last_name : '',
            ]);
        }
    }


}
