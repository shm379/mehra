<?php

namespace App\Http\Requests\Api\Product;

use App\Enums\CommentPointStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Support\Facades\DB;

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
            "features.*.rank_attribute_id"=> [
                'required',
                'exists:App\Models\RankAttribute,id',
            ],
            "features.*.score"=> [
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
            "media.*"=> 'nullable|file|mimes:mp4,jpg,jpeg,png,heic|max:1000',
            "is_anonymous"=> 'nullable|boolean',
            "product_id"=> 'nullable|exists:App\Models\Product,id',
            "order_id"=> 'nullable|exists:App\Models\Order,id',
        ];
    }

    public function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->commentPointStatus();
        $this->merge([
            'product_id'=> $this->route()->parameter('product')->id
        ]);
    }

    private function commentPointStatus()
    {
        if($this->has('advantages')){
            $advantages = [];
            foreach ($this->get('advantages') as $key => $advantage) {
                $advantages[$key] = $advantage;
                $advantages[$key]['status'] = CommentPointStatus::POSITIVE;
            }
            $this->merge(['advantages'=>$advantages]);
        }
        if($this->has('disadvantages')){
            $disadvantages = [];
            foreach ($this->get('disadvantages') as $key => $disadvantage) {
                $disadvantages[$key] = $disadvantage;
                $disadvantages[$key]['status'] = CommentPointStatus::NEGATIVE;
            }
            $this->merge(['disadvantages'=>$disadvantages]);
        }
    }
}
