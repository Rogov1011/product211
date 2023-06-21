@extends('app')

@section('title', $condition->name.'(ред.)')
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{$condition->name . '(ред.)'}}</h2>
</div>

<div>
    <form action="{{route("conditions.update", $condition->id)}}" method="POST">
        @csrf @method("PUT")
        <div class="form-group mb-3">
            <label for="" class="form-label">{{ __("Name category") }}</label>
            <input type="text" name="name" class="form-control" value="{{$condition->name}}">
        </div>
        <button class="btn btn-primary">{{ __("Save") }}</button>
    </form>
</div>

@endsection