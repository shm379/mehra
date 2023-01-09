<?php

namespace App\Http\Requests\Admin\Product;

use App\Enums\AwardType;
use App\Http\Requests\Admin\AdminFormRequest;
use BenSampo\Enum\Rules\Enum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAwardRequest extends AdminFormRequest
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
           'slug'=> 'required|string|unique:App\Models\Award,slug',
           'description'=> 'required|string',
           'award_type'=> ['required',Rule::in(AwardType::asArray())],
           'is_active'=> 'boolean',
           'parent_id'=> 'nullable|exists:App\Models\Award,id',
//           'media'=> 'required|array|required_array_keys:image'
        ];
    }
}
