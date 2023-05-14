<?php

namespace App\Http\Requests\Api\Product;


use App\Http\Requests\Api\ApiFormRequest;

class ReplyCommentRequest extends ApiFormRequest
{

    public function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge([
            'product_id'=> $this->route()->parameter('product')->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "body" => 'required|persian_alpha_eng_num',
            "is_anonymous" => 'nullable|boolean',
            "product_id"=> 'nullable|exists:App\Models\Product,id',
        ];
    }
}
