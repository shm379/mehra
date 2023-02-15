<?php

namespace App\Http\Controllers\Admin;

use App\Models\Creator;
use App\Models\Import;
use App\Models\Product;
use App\Services\Admin\Import\WoocommerceService;
use App\Services\Admin\ImportService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\QueryBuilderRequest;

class ImportController extends Controller
{
    /*
     * Import Service Inject
     */
    protected ImportService $import;
    public function __construct(WoocommerceService $import)
    {
        $this->import = $import;
    }

    /*
     * Create Creator Types
     * Create Creator
     * Attach Creator Type To Creator
     * Create Attribute
     * Create Product
     * Attach Attribute To Product
     */
    public function importFromWoocommerce()
    {
        // Get And Import Creator Types
//        $this->import->importCreatorTypes();
        // Get And Import Creators
//        $this->import->importCreators();
        // Get And Import Products
        $this->import->importProducts();

    }
}
