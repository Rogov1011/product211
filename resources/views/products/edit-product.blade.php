@extends('app')

@section('title', $product->title . '(ред.)')
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{$product->title . '(ред.)'}}</h2>
</div>
<div>
    <form action="{{route("products.update", $product)}}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group mb-3">
            <label for="title" class="form-label">{{ __('Product name') }}</label>
            <input type="title" name="title" class="form-control" value="{{old("title", $product->title)}}">
            @error("title")
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="text" class="form-label">{{ __("Description") }}</label>
            <textarea name="text" id="text" class="form-control">{{old("text", $product->content)}}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="category" class="form-label">{{ __('Category') }}</label>
            <select name="category" id="category" class="form-select">
                <option value="" selected disabled>{{ __('Select a category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if ($category->id == old("category", $product->category_id)) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
            @error("category")
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group mb-3">
            <p>{{__("The condition of the goods")}}</p>
            @foreach ($conditions as $condition)
            <label for="{{ 'condition_' . $condition->id }}" class="form-label">
                <input type="checkbox" id="{{ 'condition_' . $condition->id }}" name="conditions[]" class="form-check-input" 
                value="{{ $condition->id }}" @if($product->conditions->contains(old('condition_' . $condition->id, $condition->id))) checked @endif> {{ $condition->name }}
            </label>
            @endforeach
        </div>
        <div class="form-group mb-3">
            <label for="image" class="form-label">{{ __("Image") }}</label>
            <input type="file" name="image" class="form-control">
            @if($product->image)
                <div class="my-5">
                    <img src="{{$product->getImage()}}" alt="" style="height:150px">
                </div>
                <a class="btn btn-sm btn-danger" href="{{route("products.remove-image", $product->id)}}">{{ __('Delete an image') }}</a>
            @endif
        </div>
        <div class="form-group mb-3">
            <label for="availability" class="form-label">
                <input type="checkbox" id="availability" name="availability" class="form-check-input" value="1" @if(old("availability",  $product->availability) == 1) checked @endif> {{ __('Add') }}
            </label>
        </div>
        <button class="btn btn-primary">{{ __("Save") }}</button>
    </form>
</div>
    
@endsection