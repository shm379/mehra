<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiFormRequest;

class StoreCommentRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "i_suggest"=> 'required|boolean',
            "features.*.id"=> [
                'required',
                'exists:App\Models\Rate,id'
            ],
            "features.*.user_vote"=> [
                'required',
                'int',
                'min:1',
                'max:5'
            ],
            "advantages"=> [
                'nullable'
            ],
            "advantages.*.title"=> [
                'required',
                'persian_alpha_eng_num'
            ],
            "disadvantages"=> [
                'nullable'
            ],
            "disadvantages.*.title"=> [
                'required',
                'persian_alpha_eng_num'
            ],
            "body"=> 'required|persian_alpha_eng_num',
            "media.*"=> 'required|file|mimes:mp4,jpg,jpeg,png',
            "is_anonymous"=> 'required|boolean',
            "product_id"=> 'nullable|exists:App\Models\Product,id',
            "order_id"=> 'nullable|exists:App\Models\Order,id',
        ];
    }

    public function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge([
            'product_id'=> $this->route()->parameter('product')->id
        ]);
    }
}
