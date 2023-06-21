@extends('app')

@section('title', __("Роли"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{__("Роли")}}</h2>
    <a href="{{ route("roles.create") }}" class="btn btn-primary">{{__("Add")}}</a>
</div>

<div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <td>{{__("Роль")}}</td>
                <td>{{__("Права")}}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>
                    @foreach ($role->permissions as $perm)
                        {{ $perm->name . ","}}
                    @endforeach
                </td>
                <td class="d-flex">
                    <a href="{{ route("roles.edit", $role) }}" class="btn btn-sm btn-warning">{{__("Edit")}}</a>
                    <form action="" method="POST" class="mx-3">
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
