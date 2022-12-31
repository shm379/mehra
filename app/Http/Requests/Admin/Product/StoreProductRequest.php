<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\CategoryTemplate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        if($this->has('')){
            $products = [
                "volume_id"=> "nullable|exists:App\Models\Volume,id",
                "order_volume"=> "nullable",
                "producer_id"=> "nullable",
                "creator_id"=> "nullable",
                "creator_id"=> "nullable"
            ];
        }
        return [
            "title"=> "required",
            "sub_title"=> "nullable",
            "description"=> "required",
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