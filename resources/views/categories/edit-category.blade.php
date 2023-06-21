@extends('app')

@section('title', $category->name.'(ред.)')
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{$category->name . '(ред.)'}}</h2>
</div>

<div>
    <form action="{{route("categories.update", $category->id)}}" method="POST">
        @csrf @method("PUT")
        <div class="form-group mb-3">
            <label for="" class="form-label">{{ __("Name category") }}</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}">
        </div>
        <button class="btn btn-primary">{{ __("Save") }}</button>
    </form>
</div>

@endsection
