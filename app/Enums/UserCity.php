<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static TABRIZ()
 * @method static static QOM()
 * @method static static TEHRAN()
 * @method static static OROMIEH()
 * @method static static BIRJAND()
 * @method static static BOJNORD()
 * @method static static ISFAHAN()
 * @method static static YAZD()
 * @method static static MASHHAD()
 * @method static static SHIRAZ()
 * @method static static KARAJ()
 * @method static static ARAK()
 * @method static static ARDABIL()
 * @method static static AHWAZ()
 * @method static static ILAM()
 * @method static static BANDARABAS()
 * @method static static BUSHEHR()
 * @method static static KHORAMABAD()
 * @method static static RASHT()
 * @method static static ZAHEDAN()
 * @method static static ZANJAN()
 * @method static static SARI()
 * @method static static SEMNAN()
 * @method static static SANANDAJ()
 * @method static static SHAHREKURD()
 * @method static static GHAZVIN()
 * @method static static KERMAN()
 * @method static static KERMANSHAH()
 * @method static static GORGAN()
 * @method static static HAMEDAN()
 * @method static static YASUJ()
 */
final class UserCity extends Enum implements LocalizedEnum
{
    const TABRIZ = 'تبریز';
    const QOM = 'قم';
    const TEHRAN = 'تهران';
    const OROMIEH = 'ارومیه';
    const BIRJAND = 'بیرجند';
    const BOJNORD = 'بجنورد';
    const ISFAHAN = 'اصفهان';
    const YAZD = 'یزد';
    const MASHHAD = 'مشهد';
    const SHIRAZ = 'شیراز';
    const KARAJ = 'کرج';
    const ARAK = 'اراک';
    const ARDABIL = 'اردبیل';
    const AHWAZ = 'اهواز';
    const ILAM = 'ایلام';
    const BANDARABAS = 'بندرعباس';
    const BUSHEHR = 'بوشهر';
    const KHORAMABAD = 'خرم آباد';
    const RASHT = 'رشت';
    const ZAHEDAN = 'زاهدان';
    const ZANJAN = 'زنجان';
    const SARI = 'ساری';
    const SEMNAN = 'سمنان';
    const SANANDAJ = 'سنندج';
    const SHAHREKURD = 'شهرکرد';
    const GHAZVIN = 'قزوین';
    const KERMAN = 'کرمان';
    const KERMANSHAH = 'کرمانشاه';
    const GORGAN = 'گرگان';
    const HAMEDAN = 'همدان';
    const YASUJ = 'یاسوج';
}
