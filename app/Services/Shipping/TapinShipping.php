<?php
namespace App\Services\Shipping;

use App\Enums\ShippingType;
use App\Exceptions\MehraApiException;
use App\Helpers\Helpers;
use App\Services\ShippingService;

/**
 *
 */
class TapinShipping extends ShippingService
{

    public function __construct($guard = 'sanctum')
    {
        parent::__construct($guard);
    }

    /*
     * Check Shipping Methods
     * Attach Shipping To Order And Cart
     * Attach Shipping To Order Item
     * Send Request To Check Price To Tapin
     * Return Price To Api In Json
     */

    public function calculateShipping()
    {
        $this->url = 'http://api.posteketab.com/api/v2/public/order/post/check-price/';
        $cart = $this->getCart();
        // check if cart not exists
        if(!$cart && !$cart->exists()){
            throw new \Exception('سبد خرید شما خالی می باشد');
        }

        //check if free shipping
        if ( $this->freeShipping() ) {
            return true;
        }

        $this->prepareFormDataToCheckPrice();
        $this->prepareFormDataFromAddress($cart->address);

        foreach ($cart->items as $item)
        {
            if($item->is_virtual)
                return;

            if($item->is_cod)
                $this->setIsCod();

            $this->form_data['products'][] = [
                "count"=> $item->quantity,
                "discount"=> 0,
                "price"=> $item->price * config('shipping.types.type.'.ShippingType::TAPIN.'.is_rial',1),
                "title"=> $item->line_item->title,
                "weight"=> $item->line_item->weight,
                "product_id"=> null
            ];

        }
        $this->setOrderType();

        $request = $this->sendRequest();
        if($request) {
            if($request['send_price']){
                $cart->items()->updateOrCreate([

                ]);
            }
            return $request;
        }
        else
            return 0;
    }

    public function sendRequest()
    {
        try {
            $request = \Http::withHeaders([
                'Authorization'=> config('shipping.types.type.'.ShippingType::TAPIN.'.token')
            ])->post($this->url,$this->form_data);
            if($request->ok()){
                $body = $request->json();
                if($body['returns']['status']==200)
                    return $body['entries'];

                return false;
            }
        } catch (MehraApiException $exception){
            return false;
        }
    }

    /**
     * @param bool $is_cod
     */
    public function setIsCod(bool $is_cod=true): void
    {
        $this->is_cod = $is_cod;
        $this->form_data['pay_type'] = $is_cod;
    }

    /**
     * @param bool $is_virual
     */
    public function setOrderType(bool $is_pishtaz=true): void
    {
        $is_pishtaz = config('shipping.types.type.'.ShippingType::TAPIN.'.is_pishtaz',$is_pishtaz);
        $this->is_pishtaz = $is_pishtaz;
        $this->form_data['order_type'] = $is_pishtaz;
    }

    private function prepareFormDataFromAddress($address)
    {
        if ($address) {
            $this->form_data['first_name'] = $address->first_name;
            $this->form_data['last_name'] = $address->last_name;
            $this->form_data['phone'] = $address->phone;
            $this->form_data['mobile'] = Helpers::mobileNumberNormalize($address->mobile,false,true);
            $this->form_data['postal_code'] = $address->postal_code;
            $this->form_data['address'] = $address->address;
            $this->form_data['city_code'] = (int)$address->city_id;
            $this->form_data['province_code'] = (int)$address->state_id;
        }
    }
    private function prepareFormDataToCheckPrice()
    {
        // prepare form data
        $this->form_data = [
            "shop_id"=> config('shipping.types.type.'.ShippingType::TAPIN.'.shop_id'),
            "address"=> null,
            "city_code"=> null,
            "province_code"=> null,
            "description"=> null,
            "email"=> null,
            "employee_code"=> "-1",
            "first_name"=> null,
            "last_name"=> null,
            "mobile"=> null,
            "phone"=> null,
            "postal_code"=> null,
            "pay_type"=> config('shipping.types.type.'. ShippingType::TAPIN . '.pay_type'),
            "order_type"=> null,
            "package_weight"=> config('shipping.types.type.'. ShippingType::TAPIN . '.package_weight'),
            "products"=> [
//                [
//                    "count"=> 1,
//                    "discount"=> 0,
//                    "price"=> 50000,
//                    "title"=> "my product title",
//                    "weight"=> 60,
//                    "product_id"=> null
//                ]
            ]
        ];
    }

}
