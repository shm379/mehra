<?php

namespace App\Http\Requests\Api\Cart;

use App\Enums\OrderStatus;
use App\Helpers\Helpers;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Discount;
use App\Models\Product;
use App\Rules\AddToCartRule;
use App\Rules\SetDiscountRule;
use App\Services\CartService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use \App\Models\Cart;
use Illuminate\Validation\ValidationException;

class SetDiscountRequest extends ApiFormRequest
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
            'code'=> [
                Rule::exists('discounts','code'),
                'required',
//                new SetDiscountRule::class
            ],
        ];
    }

    public function messages()
    {
        return [
          'code.exists'=>'کد تخفیف مورد نظر وجود ندارد',
        ];
    }

    protected function passedValidation()
    {
        $cart = (new CartService());
        if(!is_null($cart->getCart())) {
            if ($cart->getCart()->doesntExist() || count($cart->getCart()->items) <= 0) {
                throw ValidationException::withMessages(['cart_is_empty' => 'سبد خرید شما خالی است!']);
            }
            $discount = Discount::query()->where('code', $this->request->get('code'));
            if ($discount->exists() && $discount->first()->is_active) {
                if ($discount->where('expire_at', '>', now())->doesntExist()) {
                    throw ValidationException::withMessages(['expired' => 'کد تخفیف شما منقضی شده است!']);
                }
                if ($discount->first()->end_time !== null && $discount
                        ->whereNotNull('end_time')
                        ->where('end_time', '>', now())
                        ->doesntExist()) {
                    throw ValidationException::withMessages(['ended_time' => 'مهلت استفاده از تخفیف به پایان رسیده است!']);
                }
                if ($discount->first()->start_time !== null && $discount
                        ->whereNotNull('start_time')
                        ->where('start_time', '<', now())
                        ->doesntExist()) {
                    throw ValidationException::withMessages(['not_started' => 'تاریخ استفاده از کد تخفیف فرا نرسیده است!']);
                }

                $minCartTotal = $discount->first()->min_cart_total;
                $minCartRemindedTotal = $minCartTotal - $cart->getCartTotal();

                if ($minCartTotal !== null && $discount
                        ->whereNotNull('min_cart_total')
                        ->where('min_cart_total', '<', $cart->getCartTotal())
                        ->doesntExist()) {

                    throw ValidationException::withMessages(['min_cart_total' => 'مجموع سبد خرید شما باید ' . Helpers::toman($minCartRemindedTotal) . ' افزایش یابد!' . ' تا بتوانید از این کدتخفیف استفاده کنید ']);
                }

                $maxCartTotal = $discount->first()->max_cart_total;

                if ($maxCartTotal !== null && $discount
                        ->whereNotNull('max_cart_total')
                        ->where('max_cart_total', '>', $cart->getCartTotal())
                        ->doesntExist()) {

                    throw ValidationException::withMessages(['max_cart_total' => 'سبد خرید شما بیش تر از مبلغ پر شده است - برای استفاده از تخفیف باید مجموع سبد خرید برابر با ' . Helpers::toman($maxCartTotal) . ' باشد.']);
                }

                $firstBuy = $discount->first()->first_buy;
                if ($firstBuy !== null) {
                    $ordersCount = auth()->user()->orders->whereNotIn('status', [OrderStatus::CART, OrderStatus::CANCELED])->count();

                    if ($firstBuy !== null && $discount
                            ->whereNotNull('first_buy')
                            ->where('first_buy', '=', 0)
                            ->doesntExist()
                        && $ordersCount > 0) {


                        throw ValidationException::withMessages(['first_buy' => 'این کد تخفیف فقط برای خرید اول قابل استفاده است.']);
                    }
                }
                $capacity = $discount->first()->capacity;
                $usedCount = $discount->first()->used_count;

                if ($usedCount !== null && $capacity !== null && $discount
                        ->whereNotNull('capacity')
                        ->where('capacity', '>=', $usedCount)
                        ->doesntExist()) {

                    throw ValidationException::withMessages(['capacity' => 'ظرفیت تعداد استفاده از کد تخفیف به پایان رسیده است!']);
                }

                $limitUsers = $discount->first()->limit_users;
                if ($limitUsers) {
                    $isLimitUser = in_array(auth()->id(), $discount->first()->users->pluck('id')->toArray());
                    if (!$isLimitUser && $discount
                            ->whereNotNull('limit_users')
                            ->where('limit_users', '=', 0)
                            ->doesntExist()) {

                        throw ValidationException::withMessages(['limit_users' => 'این کد تخفیف برای حساب کاربری شما قابل استفاده نمی باشد!']);
                    }
                }

                $perUser = $discount->first()->per_user;
                if ($perUser) {
                    $discountOrdersCount = $discount->first()->orders->whereIn('status', OrderStatus::getPaidOrderStatuses())->pluck('id')->count();
                    if ($discountOrdersCount >= $perUser)
                        if ($discount
                            ->whereNotNull('per_user')
                            ->where('per_user', '<=', 0)
                            ->doesntExist()) {

                            throw ValidationException::withMessages(['per_user' => 'شما قبلا از این کد تخفیف در سفارشات دیگر خود استفاده کرده اید!']);
                        }
                }
            }
        }
    }


}
