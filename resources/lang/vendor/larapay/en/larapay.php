<?php

return [
	'error_999' => 'خطای هندل نشده!', // unofficial error code --- added by Tartan

	'canceled_by_user' => 'تراکنش بانکی توسط کاربر لغو شد',
	'could_not_request_payment' => 'امکان درخواست توکن برای این تراکنش وجود ندارد',
	'could_not_verify_transaction' => 'امکان تایید این تراکنش وجود ندارد',
	'could_not_inquiry_payment' => 'امکان استعلام این تراکنش وجود ندارد',
	'could_not_settle_payment' => 'امکان درخواست واریز وجه برای این تراکنش وجود ندارد',
	'could_not_reverse_payment' => 'انمان بازگشت این تراکنش وجود ندارد',
	'gate_not_ready' => 'درگاه پرداختی یا وجود ندارد یا آماده سرویس دهی نمی باشد',
	'gate_not_implemented_tartan' => 'دروازه پرداخت :name از Tartan\\Larapay\\Adapter\\AdapterInterface پیروی نمی کند',
	'goto_gate' => 'اتصال به درگاه پرداخت',
	'invalid_response' => 'پاسخ معتبر از سرور درگاه پرداخت دریافت نشد!',
	'reversed_failed' => 'بازگشت تراکنش با موفقیت انجام نشد!',
	'verification_failed' => 'تایید تراکنش با موفقیت انجام نشد!',
    'after_verification_failed' => 'تایید بعد از تراکنش با موفقیت انجام نشد!',
    'invalid_sharing_data' => 'اطلاعات تسهیم معتبر نیست',
    'transaction_not_found' => 'تراکنش پیدا نشد',

	'mellat' => [
		'errors' => [
			'error_11' => 'شماره کارت نامعتبر است',
			'error_12' => 'موجودی کافی نیست',
			'error_13' => 'رمز نادرست است',
			'error_14' => 'تعداد دفعات وارد کردن رمز بیش از حد مجاز است',
			'error_15' => 'کارت نامعتبر است',
			'error_16' => 'دفعات برداشت وجه بیش از حد مجاز است',
			'error_17' => 'کاربر از انجام تراکنش منصرف شده است',
			'error_18' => 'تاریخ انقضای کارت گذشته است',
			'error_19' => 'مبلغ برداشت وجه بیش از حد مجاز است',
			'error_21' => 'پذیرنده نامعتبر است',
			'error_23' => 'خطای امنیتی رخ داده است',
			'error_24' => 'اطلاعات کاربری پذیرنده نامعتبر است',
			'error_25' => 'مبلغ نامعتبر است',
			'error_31' => 'پاسخ نامعتبر است',
			'error_32' => 'فرمت اطلاعات وارد شده صحیح نمی‌باشد',
			'error_33' => 'حساب نامعتبر است',
			'error_34' => 'خطای سیستمی',
			'error_35' => 'تاریخ نامعتبر است',
			'error_41' => 'شماره درخواست تکراری است',
			'error_42' => 'تراکنش Sale یافت نشد',
			'error_43' => 'قبلا درخواست Verfiy داده شده است',
			'error_44' => 'درخواست Verfiy یافت نشد',
			'error_45' => 'تراکنش Settle شده است',
			'error_46' => 'تراکنش Settle نشده است',
			'error_47' => 'تراکنش Settle یافت نشد',
			'error_48' => 'تراکنش Reverse شده است',
			'error_49' => 'تراکنش Refund یافت نشد.',
			'error_51' => 'تراکنش تکراری است',
			'error_54' => 'تراکنش مرجع موجود نیست',
			'error_55' => 'تراکنش نامعتبر است',
			'error_61' => 'خطا در واریز',
			'error_111' => 'صادر کننده کارت نامعتبر است',
			'error_112' => 'خطای سوییچ صادر کننده کارت',
			'error_113' => 'پاسخی از صادر کننده کارت دریافت نشد',
			'error_114' => 'دارنده این کارت مجاز به انجام این تراکنش نیست',
			'error_412' => 'شناسه قبض نادرست است',
			'error_413' => 'شناسه پرداخت نادرست است',
			'error_414' => 'سازمان صادر کننده قبض نامعتبر است',
			'error_415' => 'زمان جلسه کاری به پایان رسیده است',
			'error_416' => 'خطا در ثبت اطلاعات',
			'error_417' => 'شناسه پرداخت کننده نامعتبر است',
			'error_418' => 'اشکال در تعریف اطلاعات مشتری',
			'error_419' => 'تعداد دفعات ورود اطلاعات از حد مجاز گذشته است',
			'error_421' => 'IP نامعتبر است',

			'invalid_response' => 'پاسخ معتبر از سرور درگاه پرداخت دریافت نشد!',
		]
	],
	'parsian' => [
		'errors' => [
			'error_20' => 'پین فروشنده درست نمی باشد',
			'error_22' => 'پین فروشنده درست نمی باشد',
			'error_30' => 'عملیات قبلا با موفقیت انجام شده است',
			'error_34' => 'شماره تراکنش فرونشده درست نمی باشد',

			'could_not_continue_with_non0_rs' => 'امکان تایید این تراکنش از سمت درگاه پرداخت وجود ندارد',
			'invalid_response' => 'پاسخ معتبر از سرور درگاه پرداخت دریافت نشد!',
		]
	],
	'pasargad' => [
		'errors' => [

		]
	],
	'saderat' => [
		'errors' => [
			'error_1' => 'وجود خطا در فرمت اطلاعات ارسالی',
			'error_2' => 'عدم وجود پذیرنده و ترمینال مورد درخواست در سیستم',
			'error_3' => 'رد درخواست به علت دریافت درخواست توسط آدرس آی پی نامعتبر',
			'error_4' => 'پذیرنده مورد نظر امکان استفاده از سیستم را ندارد',
			'error_5' => 'برخورد با مشکل در انجام درخواست مورد نظر',
			'error_6' => 'خطا در پردازش درخواست',
			'error_7' => 'بروز خطا در تشخیص اصالت اطلاعات (امضای دیجیتالی نامعتبر است)',
			'error_8' => 'شماره خرید ارائه شده توسط پذیرنده (CRN) تکراری است',
			'error_9' => 'سیستم در حال حاضر قادر به سرویس دهی نمی باشد (این پیام هنگام بروزرسانی سرور برگردانده می شود)',
			'error_102' => 'تراکنش مورد نظر برگشت خورده است',
			'error_103' => 'تایید انجام نشد',
			'error_106' => 'پیامی از سوییچ پرداخت دریافت نشد',
			'error_107' => 'تراکنش درخواستی موجود نیست',
			'error_111' => 'مشکل در ارتباط با سوییچ',
			'error_112' => 'مقادیر ارسالی در درخواست معتبر نیستند',
			'error_113' => 'خطای سمت سرور (مربوط به واحد فنی PSP)',
			'error_200' => 'تراکنش بانکی توسط کاربر لغو شد',
			'error__1' => 'امضای دیجیتال مشکل دارد و با اطلاعات ارسالی همخوانی ندارد',
			'error__2' => 'دسترسی از IP غیر مجاز است',

			'making_openssl_sign_error' => 'ایجاد امضای دیجیتال با استفاده از openssl موفقیت آمیز نبود',
			'invalid_verify_result' => 'اطلاعات دریافتی از درگاه پرداخت معتبر نمی باشد',
			'invalid_transaction' => 'تراکنش  شما معتبر نیست',
			'public_key_file_not_found' => 'فایل public key در مسیر مورد نظر وجود ندارد',
			'private_key_file_not_found' => 'فایل private key در مسیر مورد نظر وجود ندارد',
		]
	],
	'zarinpal' => [
		'errors' => [
			'error_101' => 'عملیات پرداخت موفق بوده و قبلا PaymentVerification تراکنش انجام شده است',

			'error__1' => 'اطلاعات ارسال شده ناقص است', //-1
			'error__2' => 'IP و یا مرچنت کد پذیرنده صحیح نیست', //-1
			'error__3' => 'با توجه به محدودیت‌های شاپرک امکان پرداخت با رقم درخواست شده میسر نمی باشد',
			'error__4' => 'سطح تایید پذیرنده پایین تز از سطح نقره است',
			'error__11' => 'درخواست مورد نظر یافت نشد',
			'error__12 '=> 'امکان ویرایش درخواست میسر نمی باشد',
			'error__21 '=> 'هیچ نوع عملیات مالی برای این تراکنش یافت نشد',
			'error__22 '=> 'تراکنش ناموفق می باشد',
			'error__33 '=> 'رقم تراکنش با رقم پرداخت شده مطابقت ندارد',
			'error__34 '=> 'سقف تقیسم تراکنش از لحاظ تعداد یا رقم عبور نموده است',
			'error__40 '=> 'اجازه دسترسی به متد مربوطه وجود ندارد',
			'error__41 '=> 'اطلاعات ارسال شده به AdditionalData غیر معتبر می باشد',
			'error__42 '=> 'مدت زمان معتبر طول عمر شناسه پرداخت باید بین ۳۰ دقیقه تا ۴۵ روز باشد',
			'error__54 '=> 'درخواست مورد نظر آرشیو شده است',
		]
	],
    'idpay' => [
        'errors' => [
            "error_1" => "پرداخت انجام نشده است.",
            "error_2" => "پرداخت ناموفق بوده است.",
            "error_3" => "خطا رخ داده است.",
            "error_4" => "بلوکه شده.",
            "error_5" => "برگشت به پرداخت کننده.",
            "error_6" => "برگشت خورده سیستمی.",
            "error_10" => "در انتظار تایید پرداخت.",
            "error_100" => "پرداخت تایید شده است.",
            "error_101" => "پرداخت قبلا تایید شده است.",
            "error_200" => "به دریافت کننده واریز شد.",
            "error_11" => "کاربر مسدود شده است.",
            "error_12" => "API Key یافت نشد.",
            "error_13" => "درخواست شما از {ip} ارسال شده است. این IP با IP های ثبت شده در وب سرویس همخوانی ندارد.",
            "error_14" => "وب سرویس تایید نشده است.",
            "error_21" => "حساب بانکی متصل به وب سرویس تایید نشده است.",
            "error_31" => "کد تراکنش id نباید خالی باشد.",
            "error_32" => "شماره سفارش order_id نباید خالی باشد.",
            "error_33" => "مبلغ amount نباید خالی باشد.",
            "error_34" => "مبلغ amount باید بیشتر از {min-amount} ریال باشد.",
            "error_35" => "مبلغ amount باید کمتر از {max-amount} ریال باشد.",
            "error_36" => "مبلغ amount بیشتر از حد مجاز است.",
            "error_37" => "آدرس بازگشت callback نباید خالی باشد.",
            "error_38" => "درخواست شما از آدرس {domain} ارسال شده است. دامنه آدرس بازگشت callback با آدرس ثبت شده در وب سرویس همخوانی ندارد.",
            "error_51" => "تراکنش ایجاد نشد.",
            "error_52" => "استعلام نتیجه ای نداشت.",
            "error_53" => "تایید پرداخت امکان پذیر نیست.",
            "error_54" => "مدت زمان تایید پرداخت سپری شده است.",
        ]
    ],
    'zibal' => [
        'errors' => [
            "error_-1" => "در انتظار پردخت.",
            "error_-2" => "خطای داخلی.",
            "error_1" => "پرداخت شده - تاییدشده.",
            "error_2" => "پرداخت شده - تاییدنشده.",
            "error_3" => "لغوشده توسط کاربر.",
            "error_4" => "‌شماره کارت نامعتبر می‌باشد.",
            "error_5" => "‌موجودی حساب کافی نمی‌باشد.",
            "error_6" => "رمز واردشده اشتباه می‌باشد.",
            "error_8" => "‌تعداد درخواست‌ها بیش از حد مجاز می‌باشد.",
            "error_9" => "‌مبلغ پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد.",
            "error_10" => "‌صادرکننده‌ی کارت نامعتبر می‌باشد.",
            "error_11" => "‌خطای سوییچ",
            "error_12" => "کارت قابل دسترسی نمی‌باشد.",
            "error_102" => "merchant یافت نشد.",
            "error_104" => "merchant نامعتبر",
            "error_103" => "merchant غیرفعال",
            "error_201" => "پرداخت قبلا تایید شده است.",
            "error_202" => "سفارش پرداخت نشده یا ناموفق بوده است. جهت اطلاعات بیشتر جدول وضعیت‌ها را مطالعه کنید.",
            "error_203" => "trackId نامعتبر می‌باشد.",
        ]
    ],
    'payir' => [
        'errors' => [
            'error_0' => 'درحال حاضر درگاه بانکی قطع شده و مشکل بزودی برطرف می شود',
            'error_-1' => 'API Key ارسال نمی شود',
            'error_-2' => 'Token ارسال نمی شود',
            'error_-3' => 'API Key ارسال شده اشتباه است',
            'error_-4' => 'امکان انجام تراکنش برای این پذیرنده وجود ندارد',
            'error_-5' => 'تراکنش با خطا مواجه شده است',
            'error_-6' => 'تراکنش تکراریست یا قبلا انجام شده',
            'error_-7' => 'مقدار Token ارسالی اشتباه است',
            'error_-8' => 'شماره تراکنش ارسالی اشتباه است',
            'error_-9' => 'زمان مجاز برای انجام تراکنش تمام شده',
            'error_-10' => 'مبلغ تراکنش ارسال نمی شود',
            'error_-11' => 'مبلغ تراکنش باید به صورت عددی و با کاراکترهای لاتین باشد',
            'error_-12' => 'مبلغ تراکنش می بایست عددی بین 10,000 و 500,000,000 ریال باشد',
            'error_-13' => 'مقدار آدرس بازگشتی ارسال نمی شود',
            'error_-14' => 'آدرس بازگشتی ارسالی با آدرس درگاه ثبت شده در شبکه پرداخت پی یکسان نیست',
            'error_-15' => 'امکان وریفای وجود ندارد. این تراکنش پرداخت نشده است',
            'error_-16' => 'یک یا چند شماره موبایل از اطلاعات پذیرندگان ارسال شده اشتباه است',
            'error_-17' => 'میزان سهم ارسالی باید بصورت عددی و بین 1 تا 100 باشد',
            'error_-18' => 'فرمت پذیرندگان صحیح نمی باشد',
            'error_-19' => 'هر پذیرنده فقط یک سهم میتواند داشته باشد',
            'error_-20' => 'مجموع سهم پذیرنده ها باید 100 درصد باشد',
            'error_-21' => 'Reseller ID ارسالی اشتباه است',
            'error_-22' => 'فرمت یا طول مقادیر ارسالی به درگاه اشتباه است',
            'error_-23' => 'سوییچ PSP ( درگاه بانک ) قادر به پردازش درخواست نیست. لطفا لحظاتی بعد مجددا تلاش کنید',
            'error_-24' => 'شماره کارت باید بصورت 16 رقمی، لاتین و چسبیده بهم باشد',
            'error_-25' => 'امکان استفاده از سرویس در کشور مبدا شما وجود نداره',
            'error_-26' => 'امکان انجام تراکنش برای این درگاه وجود ندارد',
            'error_-27' => 'در انتظار تایید درگاه توسط شاپرک',
            'error_-28' => 'امکان تسهیم تراکنش برای این درگاه وجود ندارد',
        ]
    ],
    'nextpay' => [
        'errors' => [
            'error_0' => "تراکنش تکمیل و موفق است",
            'error_-1' => "حالت پیش فرض تراکنش",
            'error_-2' => "خطای بانکی یا انصراف از پرداخت",
            'error_-3' => "در انتظار پرداخت بانکی",
            'error_-4' => "انصراف در درگاه بانک",
            'error_-20' => "کلید مجوزدهی ارسال نشده است",
            'error_-21' => "شماره تراکنش ارسال نشده است",
            'error_-22' => "مبلغ ارسال نشده است",
            'error_-23' => "مسیر بازگشت ارسال نشده است",
            'error_-24' => "مبلغ اشتباه است",
            'error_-25' => "شماره تراکنش تکراریست و قادر به ادامه کار نیستید",
            'error_-26' => "توکن ارسال نشده است",
            'error_-30' => "مقدار مبلغ کمتر از ۱۰۰ تومان است",
            'error_-32' => "مسیر بازگشت خطا دارد",
            'error_-33' => "ساختار کلید مجوز دهی صحیح نیست",
            'error_-34' => "شماره تراکنش صحیح نیست",
            'error_-35' => "نوع کلید مجوز دهی صحیح نیست",
            'error_-36' => "شماره سفارش ارسال نشده است",
            'error_-37' => "تراکنش یافت نشد",
            'error_-38' => "توکن یافت نشد",
            'error_-39' => "کلید مجوز دهی یافت نشد",
            'error_-40' => "کلید مجوز دهی مسدود شده است",
            'error_-41' => "پارامتر های ارسالی از بانک مورد تایید نیست",
            'error_-42' => "سیستم پرداخت دچار مشکل شده است",
            'error_-43' => "درگاهی برای پرداخت یافت نشد",
            'error_-44' => "پاسخ بانک صحیح نیست",
            'error_-45' => "سیستم پرداخت غیر فعال شده است",
            'error_-46' => "درخواست اشتباه",
            'error_-48' => "نرخ کمیسیون تعیین نشده است",
            'error_-49' => "تراکنش تکراریست",
            'error_-50' => "حساب کاربری یافت نشد",
            'error_-51' => "کاربر یافت نشد",
            'error_-60' => "ایمیل صحیح نیست",
            'error_-61' => "کد ملی صحیح نیست",
            'error_-62' => "کد پستی صحیح نیست",
            'error_-63' => "آدرس پستی صحیح نیست",
            'error_-64' => "توضیحات صحیح نیست",
            'error_-65' => "نام و نام خانوادگی صحیح نیست",
            'error_-66' => "شماره تلفن صحیح نیست",
            'error_-67' => "نام کاربری صحیح نیست",
            'error_-68' => "نام محصول صحیح نیست",
            'error_-69' => "مسیر بازگشت برای حالت موفق صحیح نیست",
            'error_-70' => "مسیر بازگشت برای حالت ناموفق صحیح نیست",
            'error_-71' => "شماره موبایل صحیح نیست",
            'error_-72' => "بانک عامل پاسخ گو نیست"
        ]
    ]

];