<?php
namespace App\Services\Admin\Import;

use App\Services\Admin\ImportService;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;

class WoocommerceService extends ImportService
{

    protected $url;

    public function __construct()
    {
        parent::__construct();
        $this->url = config('woocommerce.store_url');

    }

    public function getCreatorTypes()
    {
        $types = Taxonomy::where('taxonomy','expertise-of-artists')->get();

    }
    public function getCreators()
    {

    }
    public function getProducts()
    {

    }
    public function importCreatorTypes()
    {
        $creatorTypes = $this->getCreatorTypes();
        dd($creatorTypes);
    }
    public function importCreators()
    {

    }
    public function importProduct()
    {

    }

}
