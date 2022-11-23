<?php

namespace App\Http\Requests\Admin;

use App\Models\CategoryTemplate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            "title"=> "required",
            "slug"=> "required",
            "description"=> "required",
            "parent"=> "required",
            "gallery"=> "nullable|array",
            "template"=> ['required','exists:App\Models\CategoryTemplate,id'],
            "template_setting"=> [],
        ];
    }
}
