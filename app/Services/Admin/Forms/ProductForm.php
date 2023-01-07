<?php
namespace App\Services\Admin\Forms;

use App\Enums\AttributeType;
use App\Enums\ProductStructure;
use App\Enums\ProductType;
use App\Helpers\Helpers;
use App\Http\Resources\Admin\ProductAttributeResourceCollection;
use App\Models\Attribute;
use App\Models\Book;
use App\Services\Admin\AdminForm;

class ProductForm extends AdminForm
{
    protected $form;
    public function __construct()
    {
        $data['structures'] = Helpers::asSelectLabelValueArray(ProductStructure::asSelectArray());
        $data['types'] = Helpers::asSelectLabelValueArray(ProductType::asSelectArray());
        $data['attributeTypes'] = array_flip(AttributeType::asArray());
        $this->form = $data;
    }

    public function getData($isForCreate=false)
    {
        if($isForCreate) {
            $this->form['attributes'] = Helpers::convertResourceToArray(
                new ProductAttributeResourceCollection(
                    Attribute::query()
                        ->with(['children','values'])
                        ->whereNull('parent_id')
                        ->get()
                )
            );
            $this->form['mediaCollections'] = (new Book())->getRegisteredMediaCollections();
        }
        return $this->form;
    }
}
