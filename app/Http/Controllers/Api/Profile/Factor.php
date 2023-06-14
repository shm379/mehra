<?php

namespace App\Http\Controllers\Api\profile;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Discount;
use App\Models\OrderItem;
use App\Models\OrderNote;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Factor extends Controller
{
    public function show($order_id)
    {
        $user_id = Auth::id();

        $user = User::findOrFail($user_id);
        $order = $user->orders()->findOrFail($order_id);
        $items = OrderItem::where('order_id', $order_id)->get();
        $payments = Payment::where('order_id',$order_id)->get()[0];
        $books = [];
        $user_address = UserAddress::find($order->address_id);
        $order_notes = OrderNote::where('order_id',$order_id)->get()[0];
        $dicount_name = Discount::find($order->discount_id);

        foreach ($items as $key => $item) {
            $line_item_id = $item->line_item_id;
            if($item->line_item_type == 'product'){
                $book_item = Book::find($line_item_id);
                array_push($books , $book_item);
            }
        }

//       unset user parameters
        unset(
            $user->id,
            $user->country_id,
            $user->state_id,
            $user->city_id,
            $user->national_number,
            $user->email_verified_at,
            $user->mobile_verified_at,
            $user->type,
            $user->created_at,
            $user->updated_at,
            $user->deleted_at,
            $user->admin_id,
        );

//       unset order parameters
        unset(
            $order->id,
            $order->user_id,
            $order->address_id,
            $order->discount_id,
            $order->updated_at,
            $order->admin_id,
            $order->deleted_at,
        );

//       set products_items parameters
        $product_item= [];
        foreach ($books as $key => $item){
            $product_item[$key]['id'] = $item->id;
            $product_item[$key]['title'] = $item->title;
            $product_item[$key]['slug'] = $item->slug;
            $product_item[$key]['sub_title'] = $item->sub_title;
            $product_item[$key]['price'] = $item->price;
            $product_item[$key]['sale_price'] = $item->sale_price;
            $product_item[$key]['weight'] = $item->weight;
        }
        $books = $product_item;

//       unset order_items parameters
        foreach ($items as $key => $item){
            unset(
                $user_address->is_virtual,
                $user_address->discount_applied,
                $item->discount_applied,
                $item->line_item_id,
                $item->updated_at,
                $item->admin_id,
            );
        }

//       unset user_address parameters
        unset(
            $user_address->id,
            $user_address->user_id,
            $user_address->update_at,
            $user_address->deleted_at,
        );

        return response()->json([
            'user' => $user,
            'address' => $user_address,
            'order' => $order,
            'order_note' => $order_notes->note,
            'discount' => array(
                'name' => $dicount_name->code,
                'description' => $dicount_name->description,
            ),
            'order_items' => $items,
            'products' => $books,
            'payments' => array(
                'gateway'           => $payments->gateway,
                'amount'            => $payments->amount,
                'transaction_id'    => $payments->transaction_id,
                'created_at'        => $payments->created_at,
            ),
        ]);

    }
}
