@extends('app')

@section('title', __("Сonditions"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{__("Сonditions")}}</h2>
    <a href="{{ route("conditions.create") }}" class="btn btn-primary">{{__("Add")}}</a>
</div>

<div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <td>{{__("Сonditions")}}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($conditions as $condition)
            <tr>
                <td>{{$condition->name}}</td>
                <td class="d-flex">
                    <a href="{{route("conditions.edit", $condition)}}" class="btn btn-sm btn-warning">{{__("Edit")}}</a>
                    <form action="{{route("conditions.destroy", $condition)}}" method="POST" class="mx-3">
                        @csrf @method("DELETE")
                        <button type="submit" class="btn btn-sm btn-danger">{{__("Delete")}}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
