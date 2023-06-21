<?php

namespace App\Http\Controllers;

use App\Mail\OrderSuccess;
use App\Mail\OrderSuccessToAdmin;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderContrloller extends Controller
{
    public function checkoutPage()
    {
        return view('checkout');
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'user_surname' => 'required',
            'user_name' => 'required',
        ]);

        try {
            $cart = auth()->user()->cart;

            $order = Order::add($request->all());

            foreach ($cart->items as $item) {
                OrderItem::add($item, $order);
            }

            $order->total_sum = $cart->getTotalPrice();
            $order->save();

            $cart->delete();

            Mail::to($order->email)->send(new OrderSuccess($order));
            Mail::to('rogov_p.a@mail.ru')->send(new OrderSuccessToAdmin($order));

        } catch (Throwable $e) {
            report($e);
            return false;
        }

        return redirect()->route('app.order-thankyou', $order);
    }

    public function thankyouPage(Order $order){
        return view('order-thankyou', [
            'order'=> $order,
            'orders' => Order::all()->sortByDesc('creted_at')
        ]);
    }

    public function orders(){
        return view('orders.index',[
            'orders' => Order::all()->sortByDesc('creted_at'),
        ]);
    }
}
