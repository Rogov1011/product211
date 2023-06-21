@extends('app')

@section('title', __("Создание права"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{ __("Создание права") }}</h2>
</div>

<div>
    <form action="{{route("permissions.store")}}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{__("Название права")}}</label>
            <input type="text" name="name" class="form-control">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary">{{__("Add")}}</button>
    </form>
</div>
    
@endsection