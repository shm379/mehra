<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\ProductStructure;
use App\Exceptions\MehraApiException;
use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class CheckoutService extends CartService
{
    use ApiResponse;
    public function __construct($guard = 'sanctum')
    {
        parent::__construct($guard);
    }

    public function attachAddress($addressId)
    {
        try {
            return $this->getCart()->address_id = $addressId;
        } catch (Exception $exception) {
            return null;
        }
    }

    private function validateCartBeforeCheckout($cart)
    {
        foreach ($cart->items as $item) {
            $product = $item->line_item;
            $min_purchases_per_user = $product->min_purchases_per_user;
            $max_purchases_per_user = $product->max_purchases_per_user;
            if($item->quantity<$min_purchases_per_user){
                throw new MehraApiException('حداقل تعداد خرید برای ' . ($product->structure==ProductStructure::BOOK ? 'کتاب ':'محصول '). $product->title . ' برابر با ' . $min_purchases_per_user. ' عدد می باشد.');
            }
//            if( ($max_purchases_per_user!==0 || $max_purchases_per_user!=null)){
//                throw new MehraApiException('حداکثر تعداد خرید برای ' . ($product->structure==ProductStructure::BOOK ? 'کتاب ':'محصول '). $product->title . ' برابر با ' . $product->max_purchases_per_user. ' عدد می باشد.');
//            }
        }
        return true;

    }

    public function pay()
    {
        $cart = $this->getCart();
        if ($this->getCartTotal() !== 0 && !is_null($this->user_id)) {
            try {
                $validate = $this->validateCartBeforeCheckout($cart);
                if($validate) {
                    $user = User::find($this->user_id);
                    // Create new invoice.
                    $invoice = new Invoice;
                    // Set invoice amount.
                    $invoice->amount($this->getCartTotal());
                    // Add invoice details
                    $invoice->detail('mobile', $user->mobile)
                        ->detail('description', 'پرداخت سفارش شماره ' . $cart->id);
                    // Purchase the given invoice.
                    $payment = Payment::purchase($invoice, function ($driver, $transactionId) use ($cart) {
                        $gateway = isset(config('payment.drivers')[strtolower(class_basename($driver))]) ? strtolower(class_basename($driver)) : '';
                        $cart->payments()->create([
                            'amount' => $cart->total_final_price,
                            'transaction_id' => $transactionId,
                            'gateway' => $gateway
                        ]);
                    })->pay()->toJson();

                    return $this->successResponseWithData(json_decode($payment, true));
                }
            } catch (MehraApiException $exception){
                return $this->errorResponse($exception->getMessage());
            }
        }
        return $this->errorResponse('سبد خرید خالی است');
    }

    public function verify($data)
    {
        $payment = $data['payment'];
        // You need to verify the payment to ensure the invoice has been paid successfully.
        // We use transaction id to verify payments
        // It is a good practice to add invoice amount as well.
        try {
            $receipt = Payment::amount($payment->amount)->transactionId($data['Authority'])->verify();

            // You can show payment referenceId to the user.
            $payment->update([
                'is_paid'=> 1,
                'reference_id'=> $receipt->getReferenceId()
            ]);
            $this->getCart()->update([
                'status'=> OrderStatus::COMPLETED,
            ]);
            return $this->successResponse('پرداخت با موفقیت انجام شد!');

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified, it will throw an exception.
            We can catch the exception to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            return $this->errorResponse($exception->getMessage());
        }
    }

}
