<?php

namespace App\Http\Requests\Api;

use App\Helpers\Helpers;
use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ApiFormRequest extends FormRequest
{
//    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guard('sanctum')->check();
    }

    protected function prepareForValidation()
    {
        foreach ($this->all() as $key=> $item) {
//            if(Helpers::isArabicOrPersianNumber($item))
            if(!is_array($item)) {
                $this->merge([
                    $key => Helpers::toEnglishNumber($item)
                ]);
            } else {

            }
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => count($validator->errors()->all())?$validator->errors()->all()[0]:$validator->errors()->all(),

            'rules'      => $validator->failed()

        ]));

    }
}
