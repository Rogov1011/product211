@extends('app')

@section('title', __("Пользователи"))
@section('content')
<div class="d-flex justify-content-between align-items-center my-5">
    <h2>{{__("Пользователи")}}</h2>
    <a href="{{ route("conditions.create") }}" class="btn btn-primary">{{__("Add")}}</a>
</div>

<div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <td>{{__("ФИО")}}</td>
                <td>{{ __('email') }}</td>
                <td>{{ __('Роли') }}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->getRoles()}}</td>

                <td class="d-flex">
                    <a href="{{ route("users.edit", $user) }}" class="btn btn-sm btn-warning">{{__("Edit")}}</a>
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
