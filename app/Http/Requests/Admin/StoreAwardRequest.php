<?php

namespace App\Http\Requests\Admin;

use App\Enums\AwardType;
use BenSampo\Enum\Rules\Enum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAwardRequest extends FormRequest
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
