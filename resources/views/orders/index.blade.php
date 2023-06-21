@extends('app')

@section('title', __("Заказы"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{__("Заказы")}}</h2>
</div>

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
            @foreach ($orders as $order)
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
                            <li class="list-unstyled">{{ $item->quantity . ' шт.' }}</li>
                        @endforeach
                    </ul>
                </td>

                <td>{{priceFormat($order->total_sum)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection