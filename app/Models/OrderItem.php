<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'price', 
        'quantity', 
        'discount', 
        'discount_type', 
        'subtotal',
        'product_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function add($cartitem , $order){
        $item = new static;
        $item->order_id = $order->id;
        $item->price = $cartitem->price;
        $item->quantity = $cartitem->quantity;
        $item->subtotal = $cartitem->price * $cartitem->quantity;
        $item->product_id = $cartitem->product_id;
        $item->save();
        return $item;
    }
}
