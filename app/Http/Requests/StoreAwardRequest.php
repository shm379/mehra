<?php

namespace App\Http\Requests;

use App\Enums\AwardType;
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
           'name'=> 'required|string',
           'description'=> 'required|string',
           'award_type'=> 'integer'
        ];
    }
}
