<?php

namespace App\Http\Requests\Admin\Product;

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
            "path"=> "nullable",
            "is_active"=> "nullable",
            "description"=> "required",
            "parent_id"=> ["required","exists:App\Models\Category,id"],
            "gallery"=> "nullable|array",
            "category_template_id"=> ['required','exists:App\Models\CategoryTemplate,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'path'=> $this->slug.'/',
            'is_active'=> 1
        ]);
    }
}
