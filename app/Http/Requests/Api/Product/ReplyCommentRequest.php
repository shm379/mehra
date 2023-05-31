<?php

namespace App\Http\Requests\Api\Product;

use App\Enums\CommentPointStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Support\Facades\DB;

class ReplyCommentRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "body"=> 'required|persian_alpha_eng_num',
            "media.*"=> 'nullable|exists:App\Models\Media,uuid|distinct',
            "is_anonymous"=> 'nullable|boolean',
            "product_id"=> 'nullable|exists:App\Models\Product,id',
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
