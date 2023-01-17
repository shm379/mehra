<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\ApiFormRequest;
use App\Services\CartService;
use Illuminate\Validation\Rule;

class SelectAddressRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_id'=>[
                'required',
                Rule::exists('user_addresses','id')
                    ->where('user_id',auth()->id())
            ],
        ];
    }

    public function messages()
    {
        return [
          'address.exists'=>'آدرسی که انتخاب کردید وجود ندارد'
        ];
    }
}
