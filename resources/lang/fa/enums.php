<?php declare(strict_types=1);

return [
    'App\Enums\CommentStatus'=>[
        1 => 'در انتظار تایید',
        2 => 'تایید شده',
    ],
    'App\Enums\UserCity'=>[
        'قم' => 'قم',
        2 => 'خانم',
    ],
    'App\Enums\UserGender'=>[
        1 => 'آقا',
        2 => 'خانم',
    ],
    'App\Enums\AwardType'=>[
        1 => 'جایزه',
    ],
    'App\Enums\ProducerType'=>[
        1 => 'ناشر',
        2 => 'برند',
        3 => 'تولیدکننده',
    ],
    'App\Enums\ProductType'=>[
        1 => 'فیزیکی',
        2 => 'مجازی',
    ],
    'App\Enums\AttributeType'=>[
        1 => 'چند انتخابی',
        2 => 'تک انتخابی',
        3 => 'بله یا خیر',
        4 => 'شماره',
        5 => 'رنگ',
        6 => 'متن طولانی',
        7 => 'متن',
        8 => 'وزن',
        9 => 'ابعاد'
    ],
    'App\Enums\PaymentGateway'=>[
         'SAMAN' => 'درگاه پرداخت بانک سامان',
         'MELLAT' => 'درگاه پرداخت بانک ملت',
         'PARSIAN' => 'درگاه پرداخت بانک پارسیان',
         'PASARGAD' => 'درگاه پرداخت بانک پاساردگاد',
         'PAYIR' => 'درگاه پرداخت پی دات آی آر',
         'SADERAT' => 'درگاه پرداخت بانک صادرات',
         'ZARINPAL' => 'درگاه پرداخت زرین پال',
         'IDPAY' => 'درگاه پرداخت آیدی پی',
         'ZIBAL' => 'درگاه پرداخت زیبال',
         'NEXTPAY' => 'درگاه پرداخت نکست پی'
    ]
];
