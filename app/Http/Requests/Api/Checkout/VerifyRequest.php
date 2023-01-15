<?php

namespace App\Http\Requests\Api\Checkout;

use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;

class VerifyRequest extends ApiFormRequest
{
    protected $stopOnFirstFailure = true;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Authority'=> 'required|numeric|exists:App\Models\Payment,transaction_id',
//            'Status'=> 'required|ends_with:OK',
            'payment'=> 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        $payment = Payment::query()->where('transaction_id',$this->request->get('Authority'));
        if($payment->exists()) {
            $this->merge([
                'payment' => $payment->first()
            ]);
        } else {
            throw ValidationException::withMessages(['authority' => 'مقدار ارسال شده صحیح نمی باشد']);
        }
    }
}
