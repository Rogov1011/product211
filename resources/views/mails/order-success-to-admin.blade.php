<p>Заказчик: {{ $order->user_name . ' ' . $order->user_surname}}</p>
<p>Телефон: {{ $order->phone }}</p>
<p>email: {{ $order->email }}</p>
<h4>Состав заказа</h4>
<table>
    <tr>
        <td>{{ __('Товары') }}</td>
        <td>{{ __('Цена') }}</td>
        <td>{{ __('Количество') }}</td>
        <td>{{ __('Итого') }}</td>
    </tr>
    <tr>
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
                    <li class="list-unstyled">{{ priceFormat($item->price) }}</li>
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
    </tr>
</table>
