<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Promocode;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {

        $currentUser = auth()->user();
        $args = [];
        if ($currentUser) {
            $args['user_id'] = $currentUser->id;
        }

        $cart = $currentUser->cart;

        if (!$cart) {
            $cart = Cart::create($args);
        }

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

        if(!$cartItem) {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'sub_total' => $product->price
            ]);
        } else {
            $cart->update([
                'quantity'=> $cartItem->quantity + 1
            ]);
            $cartItem->setSubTotal();
        }

        $cart->setTotalPrice();

        return response()->json([
            'qty' => $cart-> getTotalItems(),
            'success' => 'Товар"' . $product->title . '"добавлен в корзину'
        ]);
    }

    public function cartPage()
    {
        return view('cart', [
            'cart' => auth()->user()->cart
        ]);
    }

    public function changeQty(Request $request, CartItem $item)
    {
        $item->update(['quantity' => $request->input('quantity')]);
        $item->setSubTotal();
        $item->cart->setTotalPrice();
        return back();
    }
    public function destroy(CartItem $item)
    {
        $cart = $item->cart;
        $item->delete();

        if(!$cart->items->count()){
            $cart->delete();
        }else{
            $cart->setTotalPrice();
        }

        return back();
    }
    public function applyPromocode(Request $request)
    {
        $cart = auth()->user()->cart;

        $promocode = Promocode::where('code', $request->input('promocode'))->where('count', '!=', 0)->first();

        $message = "Промокод не действительный";

        if ($promocode) {
            $cart->promocodes()->attach($promocode->id);


            if ($promocode->discount_type == "amount") {
                $total = $cart->total - $promocode->discount;
                $cart->update([
                    'total' => $total
                ]);
                $message = 'Промокод ' . $promocode->code . ' применён успешно';
            } else {
                $total = 0;
                foreach ($cart->items as $item) {
                    $item->update([
                        'discount' => $promocode->discount,
                        'discount_type' => $promocode->type,
                        'sub_total' => $item->sub_total * ($promocode->discount / 100)
                    ]);
                    $total += $item->sub_total;
                }
                $cart->update([
                    'total' => $total
                ]);
            }

            if($promocode->count != null && $promocode->count > 0){
                $promocode->update([
                    'count' => $promocode->count - 1
                ]);
            }
        }

        return back()->with('message', $message);
    }
    public function cancelPromocode()
    {
        $cart = auth()->user()->cart;

        $promocode = $cart->promocodes()->first();

        if ($promocode) {
            $cart->promocodes()->detach($promocode->id);


            if ($promocode->discount_type == "amount") {
                $total = $cart->total + $promocode->discount;
                $cart->update([
                    'total' => $total
                ]);
            } else {
                $total = 0;
                foreach ($cart->items as $item) {
                    $item->update([
                        'discount' => $promocode->discount,
                        'discount_type' => $promocode->type,
                        'sub_total' => $item->sub_total * ($promocode->discount / 100)
                    ]);
                    $total += $item->sub_total;
                }
                $cart->update([
                    'total' => $total
                ]);
            }

            if($promocode->count != null && $promocode->count > 0){
                $promocode->update([
                    'count' => $promocode->count + 1
                ]);
            }
        }

        return back();
    }
}
