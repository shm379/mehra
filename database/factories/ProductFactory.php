<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $titles = ['حساس' , 'ترافیک' , 'فروش', 'سایت', 'ارگانیک' ,'افزایش', 'نرخ' , 'سئو' , 'کاربردی' , 'ابزار' , 'بهبود' ,'تجربه' , 'بهبود' , 'فروشگاه' , 'سرعت' , 'جستجو' , 'موتورهای جستجو' , 'موبایل' ,'آن ین' ,'لینک' , 'حرفه', 'کلیک' ,'مخاطب' , 'صفحه' ,'تصاویر' ,'اشتراک' ,' شبکه ها اجتماعی' ,'محصول' ,' آن ین' ,'توسعه دهنده' ,'حرفه ای' ,'فاکتور' ,'بهینه سازی' ,'ترافیک' ,'پروتکل' , 'امنیت', 'محتوا' ,'دانلود' ,'رایگان' ,'استاندارد' , 'خرید' , 'رتبه بندی' ,'الگوریتم های گوگل' ,'وب گردی' , 'وب گ نوس' , 'مخاطب' ,'رپورتاژ خبری' ,'مقایسه' ,' اط عات' ,'نقشه' ,'برچسب' ,'بانک' , 'چشمپوشی' ,'اینترنت' ,'پیامرسان' ,'دولت' , 'حمایت' ,'هیولا' , 'یادداشت' , 'لینوکس' , 'هوشمند' , 'عروسک' ,'رباتیک' , 'کودکان' ,'کتاب', 'روزرسانی' , 'وبمستر' , 'آنالیتیکس'];
        return [
            'title' => $titles[array_rand($titles)],
            'sub_title' => $this->faker->title(),
            'slug' => $this->faker->unique()->slug(),
            'sku' => $this->faker->unique()->randomNumber(6),
            'volume_id' => VolumeFactory::new([
                'title'=>'تست',
                'description'=>'تست توضیحات',
                'is_active'=>1
            ]),
            'description'=>$this->faker->realText(),
            'excerpt'=>$this->faker->text(),
            'opinions'=>$this->faker->title(),
            'price'=>$this->faker->numberBetween(10000,300000),
            'producer_id'=>ProducerFactory::new(),
            'product_type'=>ProductType::getRandomValue(),
            'is_available'=>1,
            'is_active'=>1,
        ];
    }
}
