@extends('app');

@section('title', __('Спасибо за заказ!!!'))
@section('content')

    <h1 class="my-5">{{ __('Спасибо за заказ!!!') }}</h1>


    <p class="mb-3">Ваш заказ №{{ $order->id }} успешно оформлен! Статус заказа - {{ __('statuses.'.$order->status) }}</p>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>{{ __("ФИО") }}</td>
                    <td>{{ __("Товары") }}</td>
                    <td>{{ __("Количество") }}</td>
                    <td>{{ __("Цена") }}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerFullName()}}</td>
                    <td>
                        <ul>
                            @foreach ($order->items as $item)
                                <li class="list-unstyled">{{ $item->product->title }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($order->items as $item)
                                <li class="list-unstyled">{{ $item->quantity . ' шт.'}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{priceFormat($order->total_sum)}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <a href="/" class="btn btn-success">Вернуться на главную</a>
@endsection
