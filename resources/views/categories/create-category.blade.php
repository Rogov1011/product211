@extends('app')

@section('title', __("New categories"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{ __("New categories") }}</h2>
</div>

<div>
    <form action="{{route("categories.store")}}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="" class="form-label">{{ __("Categories") }}</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button class="btn btn-primary">{{__("Add")}}</button>
    </form>
</div>
    
@endsection