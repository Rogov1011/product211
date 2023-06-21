@extends('app');

@section('title', $category->name )
@section('content')

    <h1 class="my-5">{{ $category->name }}</h1>
    <tbody>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="card mb-3">
                        <img src="{{ $product->getImage() }}" class="card-img-top" alt="" style="width:150px; height:100px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->category->name }}</p>
                            <p class="card-text">{{ $product->getPrice() }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary">Перейти</a>
                            @if (auth()->user())
                            <a href="{{ route('cart.add-product', $product) }}" type="button" class="btn btn-sm btn-success add-to-cart">В корзину</a>
                            @else
                            <a href="{{ route('auth.loginPage') }}" type="button" class="btn btn-sm btn-success">В корзину</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </tbody>
@endsection