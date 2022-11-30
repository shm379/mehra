<?php

namespace Tests\Feature\Product;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Otp;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AddToCartTest extends TestCase
{

    protected function afterRefreshingDatabase()
    {
        Schema::disableForeignKeyConstraints();
        Product::query()->insert([
                [
                    "id" => "1",
                    "sku" => "417435",
                    "parent_id" => NULL,
                    "volume_id" => "1",
                    "title" => "بهار بود و زمستان
",
                    "slug" => "cum-placeat-commodi-iusto",
                    "sub_title" => "دکتر",
                    "description" => "است. به هر کدام‌شان بیست ساعت درس بیشتر نرسیده بود. کم کم احساس کردم تغییری در رفتار خود داد و فریادش این بود.",
                    "excerpt" => "Velit sed ipsam non et ut quis consectetur. Maxime iste itaque neque.",
                    "summary" => NULL,
                    "price" => "9",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "101",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "2",
                    "sku" => "162593",
                    "parent_id" => NULL,
                    "volume_id" => "2",
                    "title" => "قصه ابر و باران
",
                    "slug" => "est-rem-aliquam-numquam-error-architecto-quos",
                    "sub_title" => "آقای",
                    "description" => "مرکز می‌دادند. با حقوق ماه بعد هم راه افتادم که «نکند علمای تعلیم و تربیت هم، همین جورها هم باشد. خنده توی.",
                    "excerpt" => "Officia et sed sed id ullam dignissimos consequatur. Dignissimos voluptates velit praesentium nihil assumenda. Molestias minima quia enim vel quia.",
                    "summary" => NULL,
                    "price" => "9",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "102",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "3",
                    "sku" => "255157",
                    "parent_id" => NULL,
                    "volume_id" => "3",
                    "title" => "یک اخمو و یک خندان
",
                    "slug" => "et-esse-id-rerum-occaecati-ipsa",
                    "sub_title" => "استاد",
                    "description" => "انداخته بود. البته فراش می‌آورد. با یک سطل بزرگ و یک مرتبه ترکید: - اگه خبرش می‌کرد آقا بایست سهمش رو می‌داد....",
                    "excerpt" => "Alias nesciunt quia ducimus maxime ipsam. Voluptatem magnam voluptatibus mollitia magnam iste ea saepe. Voluptas eum magni ea aut ducimus quia. Accusantium quas ut et expedita.",
                    "summary" => NULL,
                    "price" => "9",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "103",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "4",
                    "sku" => "424190",
                    "parent_id" => NULL,
                    "volume_id" => "4",
                    "title" => "قصه باغ و باغبان
",
                    "slug" => "molestiae-delectus-unde-doloribus-ut",
                    "sub_title" => "مهندس",
                    "description" => "معلم‌ها را می‌برید. و حالا هم داده‌ام، دنبالش نکنم و رضایت طرفین و خط و ربط کند. نائب رئیس بزک کرده و معطر.",
                    "excerpt" => "Quis quae qui corrupti est ullam commodi molestiae nemo. Incidunt nesciunt ut officiis sit aut. Animi iusto provident et nihil atque aut. Sunt fugiat minus officia.",
                    "summary" => NULL,
                    "price" => "6",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "104",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "5",
                    "sku" => "578308",
                    "parent_id" => NULL,
                    "volume_id" => "5",
                    "title" => "انگشتر گمشده
",
                    "slug" => "eum-omnis-distinctio-animi-ad-similique-quidem-dolor",
                    "sub_title" => "مهندس",
                    "description" => "یکی دو بار رو انداختم که تازه رئیس شده. زورکی غبغب می‌انداخت و حرفش را در آن درس می‌دادم، حقوقم را منتقل.",
                    "excerpt" => "Quo reiciendis enim illum. Quos sunt distinctio quia aut in deleniti. Et vel accusamus facilis eligendi blanditiis odit.",
                    "summary" => NULL,
                    "price" => "4",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "105",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "6",
                    "sku" => "795710",
                    "parent_id" => NULL,
                    "volume_id" => "6",
                    "title" => "یک مسواک و یک دندان
",
                    "slug" => "ea-qui-modi-minima-ratione",
                    "sub_title" => "استاد",
                    "description" => "فراش را مرخص کردم و معلم‌ها همکاری می‌کنند و یک زن زیبا... ناچار جور در نمی‌آید. یک فراش ماهی نود تومانی باشی،.",
                    "excerpt" => "Et perspiciatis quam impedit iure. Sit et quasi aut voluptas excepturi iusto. Tempore enim soluta alias.",
                    "summary" => NULL,
                    "price" => "5",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "106",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "7",
                    "sku" => "16123",
                    "parent_id" => NULL,
                    "volume_id" => "7",
                    "title" => "قصه گرگ و چوپان
",
                    "slug" => "repellendus-consequatur-quo-eos-non-sed-earum-est",
                    "sub_title" => "خانم",
                    "description" => "کرد که از خانواده‌ی عیال‌واری است. کم‌خونی و فقر. دیدم معلمش زیاد هم محض خاطر من نمی‌گردد. کلاس اول بود و.",
                    "excerpt" => "Molestiae in omnis incidunt occaecati est quae ipsa sit. Ut placeat maiores occaecati sit occaecati porro deserunt. Laboriosam est reprehenderit dolorum ex ut id esse. Vel aut commodi at voluptas.",
                    "summary" => NULL,
                    "price" => "1",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "107",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "8",
                    "sku" => "389504",
                    "parent_id" => NULL,
                    "volume_id" => "8",
                    "title" => "شلوار آستین کوتاه
",
                    "slug" => "praesentium-quis-ut-voluptatem-aut-iure",
                    "sub_title" => "دکتر",
                    "description" => "یکی همین آقازاده که هنوز نیومده آقا. در همین حین که من باشم! برو ورقه رو بده دست‌شون، گورشون رو گم کنند. پدر.",
                    "excerpt" => "Hic quos quam dolorum iure suscipit voluptatem. Voluptatem animi molestiae deleniti beatae.",
                    "summary" => NULL,
                    "price" => "1",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "108",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "9",
                    "sku" => "901806",
                    "parent_id" => NULL,
                    "volume_id" => "9",
                    "title" => "پنج رئیس کوتوله
",
                    "slug" => "incidunt-tempore-ad-et",
                    "sub_title" => "استاد",
                    "description" => "محله‌شان وارد کرده. جلسه که رسمی شد، صاحبخانه معرفی‌مان کرد و صدا و شارت و شورت! حتی نرفتم احوال مادرش را.",
                    "excerpt" => "Ut et et dolorum. Nisi nihil voluptatum ut. Earum velit expedita fugit labore aliquid aliquam illum.",
                    "summary" => NULL,
                    "price" => "6",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "109",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "10",
                    "sku" => "316603",
                    "parent_id" => NULL,
                    "volume_id" => "10",
                    "title" => "آبان در ترافیک
",
                    "slug" => "aliquid-et-architecto-autem-aperiam-provident-ab",
                    "sub_title" => "مهندس",
                    "description" => "و بردمش کلاس‌های سوم و چهارم را هم نمی‌تواند به کار بگیرد که خیلی هم زمخت‌اند و دست پر کن. این بود که چرا ما.",
                    "excerpt" => "Dolorum doloremque est incidunt sint. Sed voluptas voluptas reiciendis nesciunt inventore natus ut. Eveniet ad iure aut nostrum qui eum. Commodi fugiat nemo architecto nisi odit.",
                    "summary" => NULL,
                    "price" => "9",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "110",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "11",
                    "sku" => "961360",
                    "parent_id" => NULL,
                    "volume_id" => "11",
                    "title" => "ببارد باران نبارد باران
",
                    "slug" => "autem-voluptate-tempore-et-quos-cupiditate-laborum-cumque-itaque",
                    "sub_title" => "مهندس",
                    "description" => "تو کوک مردم! اونم این جوری می‌آند مدرسه. اون قرتی که عین خیالش هم نبود آقا! اما این کار را می‌برید و پیش فلان.",
                    "excerpt" => "Impedit corporis eum esse aut eum debitis. Tempora itaque fuga incidunt iure molestiae laudantium. Dolorem doloremque in omnis natus consequatur rerum unde. Est beatae ea qui omnis dolorum.",
                    "summary" => NULL,
                    "price" => "7",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "111",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "12",
                    "sku" => "289602",
                    "parent_id" => NULL,
                    "volume_id" => "12",
                    "title" => "کشاورز پیر و خرس قهوه‌ای
",
                    "slug" => "veritatis-et-omnis-est-et-est",
                    "sub_title" => "استاد",
                    "description" => "راحتی می‌توانستی حدس بزنی که کی‌ها با هم قرار و مداری دارند و کدام یک خواهد نشست. یکی دو بار پر و خالی مانده..",
                    "excerpt" => "Recusandae ducimus ut quisquam ipsam et dolor dolorem. Dolores temporibus id et magni voluptatem.",
                    "summary" => NULL,
                    "price" => "2",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "112",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "13",
                    "sku" => "878971",
                    "parent_id" => NULL,
                    "volume_id" => "13",
                    "title" => "گنجشک و پنبه دانه
",
                    "slug" => "odio-rerum-exercitationem-dolor-aut-ipsum",
                    "sub_title" => "استاد",
                    "description" => "اما خیلی دلم می‌خواد قضیه به همین سادگی تمام می‌شود. و بعد یک سخنرانی که چه طور شد که عکس‌ها دست بابات افتاد..",
                    "excerpt" => "Nemo non natus a illo illo et beatae. Eum maiores ducimus modi quas ex eveniet iure.",
                    "summary" => NULL,
                    "price" => "3",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "113",
                    "product_type" => "2",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "14",
                    "sku" => "811339",
                    "parent_id" => NULL,
                    "volume_id" => "14",
                    "title" => "یکی بیز یکی نبیز
",
                    "slug" => "commodi-voluptatem-maiores-voluptatem",
                    "sub_title" => "خانم",
                    "description" => "بود. او هم می‌خندید. دو نفر را در نیاورد و یک ورق دیگر از اداره ی فرهنگ خواستم که ترکه‌ها را که می‌نوشت، تمام.",
                    "excerpt" => "Quis nostrum veritatis eum molestias velit vel iure. Delectus tenetur ratione quia eaque necessitatibus. Recusandae eum amet eum vero enim dolores suscipit sed.",
                    "summary" => NULL,
                    "price" => "7",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "114",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => NULL,
                    "order" => NULL,
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "15",
                    "sku" => "809764",
                    "parent_id" => NULL,
                    "volume_id" => "16",
                    "title" => "ویز ویز تره
",
                    "slug" => "est-et-repudiandae-numquam-quaerat-ea",
                    "sub_title" => "استاد",
                    "description" => "بلخ کرده. جزو پر قیچی‌های رئیس فرهنگ هم این روزها گرفتار مصاحبه‌های روزنامه‌ای و رادیویی هستند. اما در تمام.",
                    "excerpt" => "Libero et tempore commodi consequatur. Et voluptatem amet sed et itaque aut nihil. Qui aliquam expedita voluptas cupiditate.",
                    "summary" => NULL,
                    "price" => "9",
                    "sale_price" => NULL,
                    "vat" => NULL,
                    "producer_id" => "115",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => "3",
                    "order" => "1",
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "1",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ],
                [
                    "id" => "16",
                    "sku" => "768855",
                    "parent_id" => NULL,
                    "volume_id" => "16",
                    "title" => "خان بیز پشه
",
                    "slug" => "perspiciatis-debitis-magni-aut-est-animi-aut-cum-earum",
                    "sub_title" => "دکتر",
                    "description" => "دم در مدرسه خواهند دید و تمام طول راه در این خجالت خواهند ماند و دیگر دیر نخواهند آمد. یک سیاهی از ته جاده‌ی.",
                    "excerpt" => "Iste deserunt cupiditate officiis ipsam aliquid. Id ea corporis cum. Eveniet repellendus quo rem omnis fuga. Iste similique et et et.",
                    "summary" => NULL,
                    "price" => "60000",
                    "sale_price" => "49500",
                    "vat" => NULL,
                    "producer_id" => "116",
                    "product_type" => "1",
                    "product_structure" => 1,
                    "order_volume" => "2",
                    "order" => "2",
                    "min_purchases_per_user" => "1",
                    "max_purchases_per_user" => "1",
                    "is_virtual" => "0",
                    "is_available" => "1",
                    "in_stock_count" => "20",
                    "is_active" => "1",
                    "created_at" => "2022-11-05 18:13:48",
                    "updated_at" => "2022-11-05 18:13:48",
                    "admin_id" => NULL,
                    "deleted_at" => NULL
                ]
            ]);
    }

    use RefreshDatabase;
    use WithoutMiddleware;

    public function getToken()
    {
        $mobile = '+989391727950';
        $response = $this->post(route('api.v1.send-otp'),[
            'mobile'=> $mobile
        ]);

        $user = User::query()->where('mobile',$mobile)->first();
        $token = $response->collect('temporary_token')->first();
        $otp_code = (string)Otp::query()->first()->code;
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post(route('api.v1.verify-otp'),[
                'code'=>$otp_code
            ]);
        return $response->json('token');
    }

    public function test_can_add_to_cart()
    {
        $token = self::getToken();
        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->get(route('api.v1.me'));
        if($response->status()==200){
            $response = $this
                ->withHeader('Authorization', 'Bearer ' . $token)
                ->post(route('api.v1.cart.add-item'),[
                    'id'=> '16',
                    'quantity'=> 1
            ]);
            $this->assertTrue($response->json('success'));
        }
    }

}
