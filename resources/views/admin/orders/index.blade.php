@extends('app')

@section('title', __('Все Заказы'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Все Заказы') }}</h2>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>{{ __('ФИО') }}</td>
                    <td>{{ __('Товары') }}</td>
                    <td>{{ __('Количество') }}</td>
                    <td>{{ __('Цена') }}</td>
                    <td>{{ __('Статус') }}</td>
                    <td>{{ __('Действия') }}</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->getCustomerFullName() }}</td>
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

                        <td>{{ priceFormat($order->total_sum) }}</td>
                        <td>
                            <form action="{{ route("order.change-status", $order) }}" method="GET">
                                <select name="status" id="" class="form-control changeStatus">
                                    <option value="in_process" @if ($order->status == "in_process") selected @endif>
                                        {{ __('statuses.in_process') }}
                                    </option>
                                    <option value="finished" @if ($order->status == "finished") selected @endif>>
                                        {{ __('statuses.finished') }}
                                    </option>
                                    <option value="canceled" @if ($order->status == "canceled") selected @endif>>
                                        {{ __('statuses.canceled') }}
                                    </option>
                                    <option value="paid" @if ($order->status == "paid") selected @endif>>
                                        {{ __('statuses.paid') }}
                                    </option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
