<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \BenSampo\Enum\Exceptions\InvalidEnumMemberException
     */
    public function run()
    {
        $defaultAttributes = [
            'Age' => [
                'name'=>'رده سنی',
                'slug'=> Str::slug('age'),
                'type'=>AttributeType::getKey(AttributeType::MULTI_CHOICE),
                'values'=>[
                    'کودک',
                    'بزرگسال',
                    'خردسال',
                    'نوجوان',
                ]
            ],
            'Volume Type' => [
                'name'=>'نوع جلد',
                'slug'=> Str::slug('volume type'),
                'type'=>AttributeType::getKey(AttributeType::SINGLE_CHOICE),
                'values'=>[
                    'مقوایی',
                    'کاغذی',
                ]
            ],
            'Page Count' => [
                'name'=>'تعداد صفحه',
                'slug'=> Str::slug('page count'),
                'type'=> AttributeType::getKey(AttributeType::NUMBER),
                'values'=>[
                    '1300',
                    '300',
                    '100',
                ]
            ],
            'Publish Year' => [
                'name'=>'سال نشر',
                'slug'=> Str::slug('publish year'),
                'type'=>AttributeType::getKey(AttributeType::MULTI_CHOICE),
                'values'=>[
                    '1393',
                    '1401',
                ]
            ],
            'Language' => [
                'name'=>'زبان',
                'slug'=> Str::slug('language'),
                'type'=>AttributeType::getKey(AttributeType::MULTI_CHOICE),
                'values'=>[
                    'فارسی',
                    'عربی',
                    'انگلیسی',
                    'آلمانی',
                ]
            ],
            'ISBN' => [
                'name'=>'شابک',
                'slug'=> Str::slug('isbn'),
                'type'=>AttributeType::getKey(AttributeType::INPUT),
                'values'=>[
                    '1234-111',
                    '1234-121',
                ]
            ],
            'Book Format' => [
                'name'=>'قطع',
                'slug'=> Str::slug('format'),
                'type'=>AttributeType::getKey(AttributeType::SINGLE_CHOICE),
                'values'=>[
                    'رقعی',
                ]
            ],
            'Weight' => [
                'name'=>'وزن',
                'slug'=> Str::slug('weight'),
                'type'=>AttributeType::getKey(AttributeType::WEIGHT),
                'values'=>[
                    '1300',
                    '30',
                ]
            ],
            'Printing Time' => [
                'name'=>'نوبت چاپ',
                'slug'=> Str::slug('printing time'),
                'type'=>AttributeType::getKey(AttributeType::INPUT),
                'values'=>[
                    '21',
                    '20',
                ]
            ],
            'Dimensions' => [
                'name'=>'ابعاد',
                'slug'=> Str::slug('dimensions'),
                'type'=>AttributeType::getKey(AttributeType::DIMENSIONS),
                'children'=>[
                    'Length' => [
                        'name'=>'طول',
                        'slug'=> Str::slug('length'),
                        'type'=>AttributeType::getKey(AttributeType::INPUT),
                        'values'=>[
                            '21',
                            '20',
                        ]
                    ],
                    'Width' => [
                        'name'=>'عرض',
                        'slug'=> Str::slug('width'),
                        'type'=> AttributeType::getKey(AttributeType::INPUT),
                        'values'=>[
                            '13',
                            '11',
                        ]
                    ],
                    'Height' => [
                        'name'=>'ارتفاع',
                        'slug'=> Str::slug('height'),
                        'type'=>AttributeType::getKey(AttributeType::INPUT),
                        'values'=>[
                            '11',
                            '10',
                        ]
                    ],
                ],
            ],
//            'Book excerpt' => [
//                'name'=>'گزیده متن کتاب',
//                'slug'=> Str::slug('book excerpt'),
//                'type'=>AttributeType::getKey(AttributeType::TEXTAREA),
//                'values'=>[
//                    'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.',
//                    'در کادر زیر هر متنی را که دوست دارید تایپ کنید تا ما آن را برایتان نگه داریم و همیشه در دسترس شما قرار دهیم؛ از این طریق می‌توانید متن آزمایشی و متن تستی خودتان را تایپ کرده و در طرح‌هایتان از این متن استفاده کنید... تایپ کنید، به صورت خودکار ذخیره می‌شود.',
//                ]
//            ],
//            'Opinions of celebrities' => [
//                'name'=>'نظرات افراد',
//                'slug'=> Str::slug('Opinions of celebrities'),
//                'type'=>AttributeType::getKey(AttributeType::TEXTAREA),
//                'values'=>[
//                    'مثل این کتاب پیدا نمی کنید حتما بخریدش و عالیه',
//                    'این کتاب یک اثر تاریخی فوق العادس'
//                ]
//            ],
        ];
        foreach ($defaultAttributes as $en_name => $attribute) {
            $attribute_child_id = 0;
            // insert attribute
            $attribute_id = DB::table('attributes')->insertGetId(array_merge(['admin_id'=>1,'en_name'=>$en_name],collect($attribute)->only(['name','slug','type'])->toArray()));
            // insert attribute value
            if(isset($attribute['values'])) {
                foreach ($attribute['values'] as $value) {
                    $attribute_value_id = DB::table('attribute_values')->insertGetId(
                        array_merge(['admin_id' => 1, 'attribute_id' => $attribute_id, 'value' => $value])
                    );
                }
            }
            // insert child attribute
            if(isset($attribute['children'])) {
                foreach ($attribute['children'] as $en_name_child => $child) {
                    $attribute_child_id = DB::table('attributes')->insertGetId(array_merge(['parent_id' => $attribute_id, 'admin_id' => 1, 'en_name' => $en_name_child], collect($child)->only(['name', 'slug', 'type'])->toArray()));
                    // insert child values
                        if (isset($child['values'])) {
                            foreach ($child['values'] as $childValue) {
                                DB::table('attribute_values')->insertGetId(
                                    array_merge(['admin_id' => 1, 'attribute_id' => $attribute_child_id, 'value' => $childValue])
                                );
                            }
                        }

                }
            }

        }
    }
}
