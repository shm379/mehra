<?php
namespace App\Services\Shipping;

use App\Services\ShippingService;

class TapinShipping extends ShippingService
{

    public function calculateShipping($package = []) {

        if ( $this->freeShipping() ) {
            return;
        }

        $options = PWS()->get_terms_option( $this->getDestination( $package ) );
        $options = array_column( $options, $this->method == 'pishtaz' ? 'forehand_cost' : 'custom_cost' );

        foreach ( $options as $option ) {
            if ( $option != '' ) {
                $this->add_rate_cost( $option, $package );

                return;
            }
        }

        if ( $this->fixed_cost !== '' ) {
            $this->add_rate_cost( intval( $this->fixed_cost ) + intval( $this->extra_cost ), $package );

            return;
        }

        $weight = PWS_Cart::get_weight();

        $price = 0;

        foreach ( WC()->cart->get_cart() as $cart_item ) {

            if ( $cart_item['data']->is_virtual() ) {
                continue;
            }

            $price += $cart_item['data']->get_price() * $cart_item['quantity'];
        }

        $destination = $package['destination'];

        $payment_method = WC()->session->get( 'chosen_payment_method' );

        $is_cod = $payment_method === 'cod';

        if ( get_woocommerce_currency() == 'IRT' ) {
            $price *= 10;
        }

        if ( get_woocommerce_currency() == 'IRHR' ) {
            $price *= 1000;
        }

        if ( get_woocommerce_currency() == 'IRHT' ) {
            $price *= 10000;
        }

        $shop = PWS_Tapin::shop();

        $data = [
            'price'         => intval( $price ),
            'weight'        => ceil( $weight ),
            'method'        => $this->method,
            'is_cod'        => $is_cod,
            'to_province'   => intval( $destination['state'] ),
            'from_province' => intval( $shop->province_code ?? 1 ),
            'to_city'       => intval( $destination['city'] ),
            'from_city'     => intval( $shop->city_code ?? 1 ),
        ];

        $cost = $this->calculate_rates( $data );

        if ( $cost === false ) {
            return;
        }

        $shipping_total = $cost + ( $shop->total_price ?? 0 );

        if ( PWS()->get_option( 'tapin.roundup_price' ) ) {
            $shipping_total = ceil( $shipping_total / 1000 ) * 1000;
        }

        $shipping_total = PWS()->convert_currency( $shipping_total );

        $shipping_total += $this->extra_cost;

        $this->add_rate_cost( $shipping_total, $package );
    }

    public function calculate_rates( array $args ): int {

        $defaults = [
            'price'         => 50000,
            'weight'        => 100,
            'method'        => 'pishtaz',
            'is_cod'        => false,
            'to_province'   => 1,
            'to_city'       => 1,
            'from_province' => 1,
            'from_city'     => 1,
            'gateway'       => PWS()->get_option( 'tapin.gateway' ),
        ];

        $args = wp_parse_args( $args, $defaults );

        if ( $args['method'] == 'pishtaz' ) {

            $weight = $args['weight'];

            $state_center = [
                381,
                561,
                571,
                81,
                61,
                6931,
                941,
                791,
                751,
                971,
                51,
                1,
                681,
                41,
                981,
                451,
                481,
                351,
                661,
                881,
                71,
                341,
                371,
                31,
                761,
                671,
                491,
                91,
                651,
                7591,
                891,
                1011,
                1013,
                1014,
                1015,
                1016,
                1017,
                1018,
                1019,
            ];

            if ( $args['from_province'] == $args['to_province'] ) {
                $cost = 104550;
            } elseif ( in_array( $args['from_city'], $state_center ) && in_array( $args['to_city'], $state_center ) ) {
                $cost = 157250;
            } else {
                $cost = 160650;
            }

            // calculate
            if ( $weight > 1000 ) {
                $cost += 34850 * ceil( ( $weight - 1000 ) / 1000 );
            }

            // INSURANCE
            if ( $args['price'] >= 10000000 ) {
                $cost += $args['price'] * 0.002;
            } else {
                $cost += 10000;
            }

            // SERVICE
            $cost += 11000;

            if ( $args['is_cod'] ) {
                $cost += $args['price'] * 0.01;
            }

        } else {

            $weight_indicator = 9999;

            switch ( true ) {
                case $args['weight'] <= 500:
                    $weight_indicator = 500;
                    break;
                case $args['weight'] > 500 && $args['weight'] <= 1000:
                    $weight_indicator = 1000;
                    break;
                case $args['weight'] > 1000 && $args['weight'] <= 2000:
                    $weight_indicator = 2000;
                    break;
                case $args['weight'] > 2000 && $args['weight'] <= 3000:
                    $weight_indicator = 3000;
                    break;
                case $args['weight'] > 3000 && $args['weight'] <= 4000:
                    $weight_indicator = 4000;
                    break;
                case $args['weight'] > 4000 && $args['weight'] <= 5000:
                    $weight_indicator = 5000;
                    break;
            }

            $checked_state = PWS()->check_states_beside( $args['from_province'], $args['to_province'] );

            $rates = $this->rates( $args['gateway'] );

            if ( $rates === false ) {
                return false;
            }

            // calculate
            if ( $weight_indicator != 9999 ) {
                $cost = $rates[ $weight_indicator ][ $checked_state ];
            } else {
                $cost = $rates[5000][ $checked_state ] + ( $rates[ $weight_indicator ] * ceil( ( $args['weight'] - 5000 ) / 1000 ) );
            }

            if ( in_array( $args['to_city'], [ 1, 31, 51, 81, 71, 91, 61 ] ) ) {
                $cost += $cost * 0.1;
            }

            // insurance
            if ( $args['price'] <= 8000000 ) {
                $cost += 8000 + 11000;
            } else {
                $cost += $args['price'] * 0.002 + 11000;
            }

            if ( $args['is_cod'] ) {

                $_rate  = 0.015;
                $_price = 5000;

                if ( $checked_state != 'in' ) {

                    $_rate  = 0.03;
                    $_price = 10000;

                }

                $cost += min( 2000000, $args['price'] ) * $_rate;

                $cost += ceil( ( $args['price'] - 2000000 ) / 2000000 ) * $_price;

            }

        }

        $cost += $cost * 0.09;

        return $cost;
    }

    public function rates( $gateway ) {

        $rates = [
            'tapin'      => [
                500  => [
                    'in'     => 36800,
                    'beside' => 49000,
                    'out'    => 53000,
                ],
                1000 => [
                    'in'     => 48300,
                    'beside' => 67600,
                    'out'    => 72800,
                ],
                2000 => [
                    'in'     => 69000,
                    'beside' => 88000,
                    'out'    => 95000,
                ],
                3000 => [
                    'in'     => 66700,
                    'beside' => 108000,
                    'out'    => 116000,
                ],
                4000 => [
                    'in'     => 66700,
                    'beside' => 108000,
                    'out'    => 116000,
                ],
                5000 => [
                    'in'     => 66700,
                    'beside' => 108000,
                    'out'    => 116000,
                ],
                9999 => 10000,
            ],
            'posteketab' => [
                500  => [
                    'in'     => 27600,
                    'beside' => 36750,
                    'out'    => 39750,
                ],
                1000 => [
                    'in'     => 36225,
                    'beside' => 50700,
                    'out'    => 54600,
                ],
                2000 => [
                    'in'     => 51750,
                    'beside' => 66000,
                    'out'    => 71250,
                ],
                3000 => [
                    'in'     => 50025,
                    'beside' => 81000,
                    'out'    => 87000,
                ],
                4000 => [
                    'in'     => 50025,
                    'beside' => 81000,
                    'out'    => 87000,
                ],
                5000 => [
                    'in'     => 50025,
                    'beside' => 81000,
                    'out'    => 87000,
                ],
                9999 => 7500,
            ],
        ];

        return $rates[ $gateway ] ?? false;
    }

}
