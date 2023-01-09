<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\Admin\AdminFormRequest;
use App\Models\CategoryTemplate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends AdminFormRequest
{

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
