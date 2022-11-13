<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SAMAN()
 * @method static static MELLAT()
 * @method static static PARSIAN()
 * @method static static PASARGAD()
 * @method static static PAYIR()
 * @method static static SADERAT()
 * @method static static ZARINPAL()
 * @method static static IDPAY()
 * @method static static ZIBAL()
 * @method static static NEXTPAY()
 */
final class PaymentGateway extends Enum
{
    const WALLET = 'کیف پول';
    const SAMAN = 'درگاه پرداخت بانک سامان';
    const MELLAT = 'درگاه پرداخت بانک ملت';
    const PARSIAN = 'درگاه پرداخت بانک پارسیان';
    const PASARGAD = 'درگاه پرداخت بانک پاسارگاد';
    const PAYIR = 'درگاه پرداخت پی دات آی آر';
    const SADERAT = 'درگاه پرداخت بانک صادرات';
    const ZARINPAL = 'درگاه پرداخت زرین پال';
    const IDPAY = 'درگاه پرداخت آیدی پی';
    const ZIBAL = 'درگاه پرداخت زیبال';
    const NEXTPAY = 'درگاه پرداخت نکست پی';
}
