@extends('app')

@section('title', __('Products'))
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
    </div>

    <div>
        <div>
            <img src="{{ $product->getImage() }}" alt="" style="width: 300px">
        </div>
        <h1 class="my-5">{{ $product->category->name }}</h1>
        <h2 class="my-5">{{ $product->title }}</h2>
        <h2 class="my-5">{{ $product->getPrice() }}</h2>
        <p>{{ $product->content }}</p>
        @if (auth()->user())
            <a href="{{ route('cart.add-product', $product) }}" type="button" class="btn btn-sm btn-success add-to-cart">В
                корзину</a>
        @else
            <a href="{{ route('auth.loginPage') }}" type="button" class="btn btn-sm btn-success">В корзину</a>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

@endsection
