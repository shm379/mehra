<?php

namespace App\Http\Requests\Api\Auth;

use App\Enums\UserGender;
use App\Enums\UserType;
use App\Helpers\Helpers;
use App\Http\Requests\Api\ApiFormRequest;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdateMeRequest extends ApiFormRequest
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
        return [
            "first_name"=> ['nullable','persian_alpha'],
            "last_name"=> ['nullable','persian_alpha'],
            "state_id"=> ['nullable','exists:App\Models\State,id'],
            "city_id"=> ['nullable','exists:App\Models\City,id'],
            "national_number"=> ['nullable','ir_national_code','unique:App\Models\User,national_number'],
            "email"=> ['nullable','email:rfc,dns'],
            "mobile"=> ['nullable','ir_mobile'],
            "password" => ['nullable'],
            "type"=> [
                'nullable',
            ],
            "gender"=> [
                'nullable',
            ],
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "national_number"=> 'کد ملی نامعتبر است',
        ];
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation(); // TODO: Change the autogenerated stub
        $this->merge([
            'mobile'=> Helpers::mobileNumberNormalize($this->mobile)
        ]);
    }


}
