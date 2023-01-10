<?php
namespace App\Services\Admin\Forms;

use App\Enums\AttributeType;
use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Helpers\Helpers;
use App\Http\Resources\Admin\ProductAttributeResourceCollection;
use App\Interfaces\Admin\AdminFormInterface;
use App\Models\Attribute;
use App\Models\Book;
use App\Services\Admin\AdminForm;

class ProductForm extends AdminForm implements AdminFormInterface
{
    protected $form;
    static bool $isForCreate = false;

    /**
     * @return bool
     */
    public static function isForCreate(): bool
    {
        return self::$isForCreate;
    }

    /**
     * @param bool $isForCreate
     */
    public static function setIsForCreate(bool $isForCreate): void
    {
        self::$isForCreate = $isForCreate;
    }


    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->getForm();
    }

    public function __construct()
    {
        $data['structures'] = Helpers::asSelectLabelValueArray(ProductStructure::asSelectArray());
        $data['types'] = Helpers::asSelectLabelValueArray(ProductType::asSelectArray());
        $data['attributeTypes'] = array_flip(AttributeType::asArray());
        $this->form = $data;

        return $this;
    }

    public static function setForm($form)
    {
        if(self::isForCreate()) {
            $form['attributes'] = Helpers::convertResourceToArray(
                new ProductAttributeResourceCollection(
                    Attribute::query()
                        ->with(['children','values'])
                        ->get()
                )
            );
            $form['mediaCollections'] = (new Book())->getRegisteredMediaCollections();
        }
    }
}
