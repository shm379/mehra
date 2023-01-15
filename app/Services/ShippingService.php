<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ShippingService extends CheckoutService
{
    /**
     * Free shipping if order total is grater than free fee
     *
     * @var string
     */
    public string $free_fee = '';

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

    public function isAvailable( $package ): bool {

        $available = $this->is_enabled() && $this->is_available;

        if ( empty( $package ) ) {
            $available = false;
        }

        if ( $package['destination']['country'] != 'IR' ) {
            $available = false;
        }

        if ( is_null( PWS()->get_state( $package['destination']['state'] ) ) ) {
            $available = false;
        }

        if ( is_null( PWS()->get_city( $package['destination']['city'] ) ) ) {
            $available = false;
        }

        if ( $this->minimum_fee > $this->cart_total ) {
            $available = false;
        }

        $available = apply_filters( 'woocommerce_shipping_pws_methods_is_available', $available, $package, $this );

        return apply_filters( 'woocommerce_shipping_' . $this->id . '_is_available', $available, $package, $this );
    }

    public function freeShipping( $package = [] ): bool {

        $has_free_shipping = $this->free_fee !== '' && $this->free_fee <= $this->cart_total;
        $has_free_shipping = apply_filters( 'pws_has_free_shipping', $has_free_shipping, $package, $this );

        if ( $has_free_shipping ) {

            $this->add_rate_cost( 0, $package );

            return true;
        }

        return false;
    }

    public function addRateCost( $cost, $package ) {

        $rate = apply_filters( 'pws_add_rate', [
            'id'    => $this->get_rate_id(),
            'label' => $this->title,
            'cost'  => $cost,
        ], $package, $this );

        $this->add_rate( $rate );
    }

    public function getDestination( array $package ) {

        if ( ! isset( $package['destination']['district'] ) || empty( $package['destination']['district'] ) ) {
            return $package['destination']['city'];
        }

        return intval( $package['destination']['district'] );
    }


}
