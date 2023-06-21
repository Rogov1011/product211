@extends('app')

@section('title', __("CreateCondition"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{ __("CreateCondition") }}</h2>
</div>

<div>
    <form action="{{route("conditions.store")}}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{__("Сonditions")}}</label>
            <input type="text" name="name" class="form-control">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary">{{__("Add")}}</button>
    </form>
</div>
    
@endsection