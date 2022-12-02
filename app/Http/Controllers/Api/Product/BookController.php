<?php

namespace App\Http\Controllers\Api\Product;

use App\Enums\AttributeType;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceCollection;
use App\Http\Resources\ProductResource;
use App\Models\Book;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BookController extends Controller {

    public function index(Request $request)
    {
        $books = Book::query()->with([
            'volume',
            'volumes',
            'producer',
//            'authors'=>function($creator){
//                $creator->with('types');
//            },
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'media'
        ])->paginate($request->has('per_page') !== null ?$request->get('per_page'): 15);

        return new BookResourceCollection($books);
    }
    public function show(Book $book): BookResource
    {
//        if(is_int($book)){
//            $book = Book::query()->where('id',$book)->firstOrFail();
//        } else {
//            $book = Book::query()->where('slug',$book)->firstOrFail();
//        }
        return BookResource::make($book->load([
            'volume',
            'volumes',
            'producer',
            'creators'=>function($creator){
                $creator->with('types');
            },
            'attributeValues'=>function($value){
                $value->with('attribute');
            },
            'media'
        ]));
    }
}
