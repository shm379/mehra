<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Helpers;
use App\Models\Product;
use App\Rules\AddToCartRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AdminFormRequest extends FormRequest
{
//    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    protected function prepareForValidation()
    {
        foreach ($this->all() as $key=> $item) {
//            if(Helpers::isArabicOrPersianNumber($item))
            if(!is_array($item) && !is_null($item)) {
                $this->merge([
                    $key => Helpers::toEnglishNumber($item)
                ]);
            } else {

            }
        }
    }

    public function failedValidation(Validator $validator)
    {
        session()->flash('error',$validator->errors()->first());
        parent::failedValidation($validator);
    }
}
