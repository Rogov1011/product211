@extends('app');

@section('title', __('Оформление заказа'))
@section('content')

    <h1 class="my-5">{{ __('Оформление заказа') }}</h1>

    <form action="{{ route('app.storeOrder') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="form-group mb-3">
                    <label for="user_surname">Фамилия</label>
                    <input type="text" name="user_surname" id="user_surname" class="form-control" value="{{ old('user_surname')}}">
                    @error('user_surname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group mb-3">
                    <label for="user_name">Имя</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name', auth()->user()->name) }}">
                    @error('user_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="form-group mb-3">
                    <label for="user_patronimyc">Отчество</label>
                    <input type="text" name="user_patronimyc" id="user_patronimyc" class="form-control" value="{{ old('user_patronimyc') }}">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="phone">Телефон</label>
                    <input type="text" name="user_phone" id="phone" class="form-control" value="{{ old('user_phone') }}">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group mb-3">
                    <label for="user_email">Email</label>
                    <input type="text" name="user_email" id="user_email" class="form-control" value="{{ old('user_email', auth()->user()->email) }}">
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Оформить заказ</button>

    </form>

@endsection

@section('page-scripts')
<script src="{{asset("assets/js/jquery.inputmask.min.js")}}"></script>
@endsection
