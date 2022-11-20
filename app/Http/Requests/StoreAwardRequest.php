<?php

namespace App\Http\Requests;

use App\Enums\AwardType;
use BenSampo\Enum\Rules\Enum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

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
           'award_type'=> 'required',
           'is_active'=> 'boolean',
           'parent_id'=> 'nullable|exists:App\Models\Award,id',
        ];
    }
}
