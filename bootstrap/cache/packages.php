<?php return array (
  'alexusmai/laravel-file-manager' => 
  array (
    'providers' => 
    array (
      0 => 'Alexusmai\\LaravelFileManager\\FileManagerServiceProvider',
    ),
  ),
  'artesaos/seotools' => 
  array (
    'providers' => 
    array (
      0 => 'Artesaos\\SEOTools\\Providers\\SEOToolsServiceProvider',
    ),
    'aliases' => 
    array (
      'SEOMeta' => 'Artesaos\\SEOTools\\Facades\\SEOMeta',
      'OpenGraph' => 'Artesaos\\SEOTools\\Facades\\OpenGraph',
      'Twitter' => 'Artesaos\\SEOTools\\Facades\\TwitterCard',
      'JsonLd' => 'Artesaos\\SEOTools\\Facades\\JsonLd',
      'SEO' => 'Artesaos\\SEOTools\\Facades\\SEOTools',
    ),
  ),
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facades\\Debugbar',
    ),
  ),
  'barryvdh/laravel-dompdf' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
      'PDF' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
    ),
  ),
  'barryvdh/laravel-ide-helper' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
    ),
  ),
  'bensampo/laravel-enum' => 
  array (
    'providers' => 
    array (
      0 => 'BenSampo\\Enum\\EnumServiceProvider',
    ),
  ),
  'codexshaper/laravel-woocommerce' => 
  array (
    'providers' => 
    array (
      0 => 'Codexshaper\\WooCommerce\\WooCommerceServiceProvider',
    ),
    'aliases' => 
    array (
      'Attribute' => 'Codexshaper\\WooCommerce\\Models\\Attribute',
      'Category' => 'Codexshaper\\WooCommerce\\Models\\Category',
      'Coupon' => 'Codexshaper\\WooCommerce\\Models\\Coupon',
      'Customer' => 'Codexshaper\\WooCommerce\\Models\\Customer',
      'Note' => 'Codexshaper\\WooCommerce\\Models\\Note',
      'Order' => 'Codexshaper\\WooCommerce\\Models\\Order',
      'PaymentGateway' => 'Codexshaper\\WooCommerce\\Facades\\PaymentGateway',
      'Product' => 'Codexshaper\\WooCommerce\\Models\\Product',
      'Refund' => 'Codexshaper\\WooCommerce\\Models\\Refund',
      'Report' => 'Codexshaper\\WooCommerce\\Models\\Report',
      'Review' => 'Codexshaper\\WooCommerce\\Models\\Review',
      'Setting' => 'Codexshaper\\WooCommerce\\Models\\Setting',
      'ShippingMethod' => 'Codexshaper\\WooCommerce\\Models\\ShippingMethod',
      'ShippingZone' => 'Codexshaper\\WooCommerce\\Models\\ShippingZone',
      'ShippingZoneMethod' => 'Codexshaper\\WooCommerce\\Models\\ShippingZoneMethod',
      'System' => 'Codexshaper\\WooCommerce\\Models\\System',
      'Tag' => 'Codexshaper\\WooCommerce\\Models\\Tag',
      'Tax' => 'Codexshaper\\WooCommerce\\Models\\Tax',
      'TaxClass' => 'Codexshaper\\WooCommerce\\Models\\TaxClass',
      'Term' => 'Codexshaper\\WooCommerce\\Models\\Term',
      'Variation' => 'Codexshaper\\WooCommerce\\Models\\Variation',
      'Webhook' => 'Codexshaper\\WooCommerce\\Facades\\Webhook',
      'WooCommerce' => 'Codexshaper\\WooCommerce\\Facades\\WooCommerce',
      'WooAnalytics' => 'Codexshaper\\WooCommerce\\Facades\\WooAnalytics',
      'Query' => 'Codexshaper\\WooCommerce\\Facades\\Query',
    ),
  ),
  'cviebrock/eloquent-sluggable' => 
  array (
    'providers' => 
    array (
      0 => 'Cviebrock\\EloquentSluggable\\ServiceProvider',
    ),
  ),
  'ghaninia/shipping' => 
  array (
    'providers' => 
    array (
      0 => 'GhaniniaIR\\Shipping\\ShippingServiceProvider',
    ),
  ),
  'inertiajs/inertia-laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Inertia\\ServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'jgrossi/corcel' => 
  array (
    'providers' => 
    array (
      0 => 'Corcel\\Laravel\\CorcelServiceProvider',
    ),
  ),
  'kavenegar/laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Kavenegar\\Laravel\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Kavenegar' => 'Kavenegar\\Laravel\\Facade',
    ),
  ),
  'kitloong/laravel-migrations-generator' => 
  array (
    'providers' => 
    array (
      0 => 'KitLoong\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
    ),
  ),
  'knuckleswtf/scribe' => 
  array (
    'providers' => 
    array (
      0 => 'Knuckles\\Scribe\\ScribeServiceProvider',
    ),
  ),
  'laracademy/generators' => 
  array (
    'providers' => 
    array (
      0 => 'Laracademy\\Generators\\GeneratorsServiceProvider',
    ),
  ),
  'laravel/breeze' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Breeze\\BreezeServiceProvider',
    ),
  ),
  'laravel/sail' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/scout' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Scout\\ScoutServiceProvider',
    ),
  ),
  'laravel/socialite' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Socialite\\SocialiteServiceProvider',
    ),
    'aliases' => 
    array (
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'matchish/laravel-scout-elasticsearch' => 
  array (
    'providers' => 
    array (
      0 => 'Matchish\\ScoutElasticSearch\\ScoutElasticSearchServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider',
    ),
  ),
  'realrashid/sweet-alert' => 
  array (
    'providers' => 
    array (
      0 => 'RealRashid\\SweetAlert\\SweetAlertServiceProvider',
    ),
    'aliases' => 
    array (
      'Alert' => 'RealRashid\\SweetAlert\\Facades\\Alert',
    ),
  ),
  'ronasit/laravel-swagger' => 
  array (
    'providers' => 
    array (
      0 => 'RonasIT\\Support\\AutoDoc\\AutoDocServiceProvider',
    ),
  ),
  'sadegh19b/laravel-persian-validation' => 
  array (
    'providers' => 
    array (
      0 => 'Sadegh19b\\LaravelPersianValidation\\PersianValidationServiceProvider',
    ),
  ),
  'shetabit/payment' => 
  array (
    'providers' => 
    array (
      0 => 'Shetabit\\Payment\\Provider\\PaymentServiceProvider',
    ),
    'aliases' => 
    array (
      'Payment' => 'Shetabit\\Payment\\Facade\\Payment',
    ),
  ),
  'shm379/media' => 
  array (
    'providers' => 
    array (
      0 => 'Shm379\\Media\\MediaServiceProvider',
    ),
  ),
  'spatie/eloquent-sortable' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\EloquentSortable\\EloquentSortableServiceProvider',
    ),
  ),
  'spatie/laravel-activitylog' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Activitylog\\ActivitylogServiceProvider',
    ),
  ),
  'spatie/laravel-ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
    ),
  ),
  'spatie/laravel-medialibrary' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\MediaLibrary\\MediaLibraryServiceProvider',
    ),
  ),
  'spatie/laravel-permission' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Permission\\PermissionServiceProvider',
    ),
  ),
  'spatie/laravel-query-builder' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\QueryBuilder\\QueryBuilderServiceProvider',
    ),
  ),
  'spatie/laravel-tags' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Tags\\TagsServiceProvider',
    ),
  ),
  'spatie/laravel-translatable' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Translatable\\TranslatableServiceProvider',
    ),
  ),
  'tightenco/ziggy' => 
  array (
    'providers' => 
    array (
      0 => 'Tightenco\\Ziggy\\ZiggyServiceProvider',
    ),
  ),
);