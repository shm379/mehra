<?php

namespace App\Http\Requests\Admin\Product;

use App\Enums\AwardType;
use App\Http\Requests\Admin\AdminFormRequest;
use BenSampo\Enum\Rules\Enum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStockRequest extends AdminFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'title'=> 'required|string',
           'type'=> 'required|int',
           'city_id'
        ];
    }
}
