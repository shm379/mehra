<?php

use App\Models\Book;
use App\Models\Product;

return [
    'media' => 'App\Models\Media',
    'blog' => 'App\Models\Blog',
    'announcement' => 'App\Models\Announcement',
    'award' => 'App\Models\Award',
    'comment' => 'App\Models\Comment',
    'category' => 'App\Models\Category',
    'collection' => 'App\Models\Collection',
    'creator' => 'App\Models\Creator',
    'slider' => 'App\Models\Slider',
    'discount' => 'App\Models\Discount',
    'message' => 'App\Models\Message',
    'page' => 'App\Models\Page',
    'producer' => 'App\Models\Producer',
    'shipping' => 'App\Models\Shipping',
    'user' => 'App\Models\User',
    'temporary_upload' => 'App\Models\TemporaryUpload',
    'product'=>[
        Book::class,
        Product::class,
    ],
    'book'=> 'App\Models\Book'
];
