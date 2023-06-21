@extends('app')

@section('title', __('New Product'))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{ __('New Product') }}</h2>
</div>
    {{-- @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}};
                </li>
            @endforeach
        </ul>
    @endif валидация полей сверху --}}
<div>
    <form action="{{route("products.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="title" class="form-label">{{ __('Product name') }}</label>
            <input type="title" name="title" class="form-control" value="{{old("title")}}">
            @error("title")
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="text" class="form-label">{{ __("Availability") }}</label>
            <textarea name="text" id="text" class="form-control">{{old("text")}}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="category" class="form-label">{{ __("Category") }}</label>
            <select name="category" id="category" class="form-select">
                <option value="" selected disabled>{{ __("Select a category") }}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if ($category->id == old("category")) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
            @error("category")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="image" class="form-label">{{ __("Image") }}</label>
            <input type="file" name="image" class="form-control">
        </div>
        
        <div class="form-group mb-3">
            <label for="availability" class="form-label">
                <input type="checkbox" id="availability" name="availability" class="form-check-input" value="1" @if(old("availability") == 1) checked @endif> Добавить
            </label>
        </div>
        <div class="form-group mb-3">
            <p>{{__("The condition of the goods")}}</p>
            @foreach ($conditions as $condition)
            <label for="{{ 'condition_' . $condition->id }}" class="form-label">
                <input type="checkbox" id="{{ 'condition_' . $condition->id }}" name="conditions[]" class="form-check-input" value="{{ $condition->id }}" @if(old('condition_' . $condition->id) == $condition->id) checked @endif> {{ $condition->name }}
            </label>
            @endforeach
        </div>
        <button class="btn btn-primary">{{ __("Add") }}</button>
    </form>
</div>
    
@endsection