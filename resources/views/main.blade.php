@extends('app');

@section('title', __('Home Page'))
@section('content')

    <h1 class="my-5">{{ __('Home Page') }}</h1>
    <form action="" method="GET" class="mb-5">
        <input type="text" name="search" placeholder="Введите запрос" class="col-6">
        <button class="btn btn-primary">Найти</button>
        <a class="mx-3" href="/">Сбросить фильтр</a>
    </form>
    <tbody>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card mb-3">
                        <img src="{{ $product->getImage() }}" class="card-img-top" alt=""
                            style="width:150px; height:100px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->category->name }}</p>
                            <p class="card-text">{{ $product->getPrice() }}</p>
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="btn btn-sm btn-primary">Перейти</a>
                            @if (auth()->user())
                                <a href="{{ route('cart.add-product', $product) }}" type="button"
                                    class="btn btn-sm btn-success add-to-cart">В корзину</a>
                            @else
                                <a href="{{ route('auth.loginPage') }}" type="button" class="btn btn-sm btn-success">В
                                    корзину</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
                @if ($products->count() > 11)
                    @if ($products->currentPage() > 1)
                        <a href="{{ $products->previousPageUrl() }}" type="button" class="btn btn-lg btn-primary">
                            <</a>
                    @endif
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <a href="{{ $products->url($i) }}" type="button"
                            class="btn btn-lg @if ($i == $products->currentPage()) btn-primary @else btn-outline-primary @endif">{{ $i }}</a>
                    @endfor
                    @if ($products->currentPage() != $products->lastPage())
                        <a href="{{ $products->nextPageUrl() }}" type="button" class="btn btn-lg btn-primary">></a>
                    @endif
                @endif
            </div>
        </div>
    </tbody>
@endsection
