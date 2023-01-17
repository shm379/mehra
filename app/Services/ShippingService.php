<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\ShippingType;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\Shipping\TapinShipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ShippingService extends CheckoutService
{
    /**
     * Check Price Url For Tapin Or Another
     *
     * @var string|int
     */
    public string $url = '';
    /**
     * Form Data Send To Tapin Or Another
     *
     * @var string|int
     */
    public array $form_data = [];
    /**
     * Cart total
     *
     * @var string|int
     */
    public string|int $cart_total = 0;

    /**
     * Cart weight
     *
     * @var string|int
     */
    public string|int $cart_weight = 0;

    private int $type = 2;
    private bool $is_cod = false;
    private bool $is_pishtaz = false;

    /**
     * @return bool
     */
    public function getIsCod(): bool
    {
        return $this->is_cod;
    }

    /**
     * @param bool $is_cod
     */
    public function setIsCod(bool $is_cod): void
    {
        $this->is_cod = $is_cod;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function isAvailable(): bool {

        return true;

    }

    public function freeShipping(): bool {

        return false;
    }

    public function calculateShipping()
    {
        if($this->getType()==ShippingType::TAPIN)
            return (new TapinShipping())->calculateShipping();
    }

}
