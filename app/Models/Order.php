<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'user_surname',
        "user_name",
        'user_patronimyc',
        'phone',
        'email',
        'total_sum'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function promocodes()
    {
        return $this->belongsToMany(Promocode::class);
    }


    public static function add(array $input)
    {
        $order = new static;
        $order->fill($input);
        $order->email = $input['user_email'];
        $order->phone = $input['user_phone'] != null ? str_replace(['(', ')', '-', ' ', '+'], '', $input['user_phone']) : null;
        $order->save();

        return $order;
    }

    public function getCustomerFullName()
    {
        $data = [];

        $data[] = $this->user_surname ?? $this->user_surname;
        $data[] = $this->user_name ?? $this->user_name;
        $data[] = $this->user_patronimyc ?? $this->user_patronimyc;

        return implode(' ', $data);
    }
}
