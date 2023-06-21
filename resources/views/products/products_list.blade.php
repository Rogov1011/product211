@extends('app')

@section('title', __('Products'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ __('Products') }}</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">{{ __('Add') }}</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        @if ($products->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{ __("Image") }}</td>
                        <td>{{ __('Product name') }}</td>
                        <td>{{ __("Category") }}</td>
                        <td>{{ __("Availability") }}</td>
                        <td>{{__("Сonditions")}}</td>
                        <td>{{ __('Actions') }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img style="height:100px" src="{{ $product->getImage() }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->slug) }}">
                                    {{ $product->title }}
                            </td>
                            </a>
                            <td>{{ $product->category->name }}</td>
                            <td>{!! $product->getAvailabilityStatus() !!}</td>
                            <td>
                                @foreach ($product->conditions as $condition)
                                    {!! $condition->name . "<br>" !!}
                                @endforeach
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning"
                                    style='height:31px'>{{ __('Edit') }}</a>
                                <form action="{{ route('products.delete', $product) }}" method="POST" class="mx-3">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick='event.preventDefault();if(confirm("запись бдет удалена. Продолжить?")){this.closest("form").submit();}'>{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>{{ __("There are no products yet") }}</p>
        @endif

    </div>

@endsection
