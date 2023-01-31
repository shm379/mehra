<?php

use App\Models\Book;
use App\Models\Product;
use App\Models\Media;
use App\Models\Blog;
use App\Models\Announcement;
use App\Models\Award;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Creator;
use App\Models\Slider;
use App\Models\Discount;
use App\Models\Message;
use App\Models\Page;
use App\Models\Producer;
use App\Models\Shipping;
use App\Models\User;
use App\Models\TemporaryUpload;
use App\Models\Order;

return [
    'media' => Media::class,
    'blog' => Blog::class,
    'announcement' => Announcement::class,
    'award' => Award::class,
    'comment' => Comment::class,
    'category' => Category::class,
    'collection' => Collection::class,
    'creator' => Creator::class,
    'slider' => Slider::class,
    'discount' => Discount::class,
    'message' => Message::class,
    'page' => Page::class,
    'producer' => Producer::class,
    'shipping' => Shipping::class,
    'user' => User::class,
    'temporary_upload' => TemporaryUpload::class,
    'order' => Order::class,
    'product'=> Product::class,
    'book'=> Book::class
];
