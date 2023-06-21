@extends('app')

@section('title', $user->name)
@section('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h2>{{ $user->name }}</h2>
    </div>

    <div>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group mb-3">
                <label for="name" class="form-label">{{ __('Имя') }}</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @if ($user->id != auth()->user()->id)
                <div class="form-group mb-3">
                    <p>{{ __('Роли') }}</p>
                    @foreach ($roles as $role)
                        <label for="{{ 'role' . $role->id }}" class="form-label">
                            <input type="checkbox" id="{{ 'role' . $role->id }}" name="roles[]" class="form-check-input"
                                value="{{ $role->name }}" @if ($user->roles->contains(old('role_' . $role->id, $role->id))) checked @endif>
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>
                <div class="form-group mb-3">
                    <p>{{ __('Права') }}</p>
                    @foreach ($permissions as $perm)
                        <label for="{{ 'perm_' . $perm->id }}" class="form-label">
                            <input type="checkbox" id="{{ 'perm_' . $perm->id }}" name="permissions[]"
                                class="form-check-input" value="{{ $perm->name }}"
                                @if ($user->hasPermissionTo($perm->name)) checked @endif>
                            {{ $perm->name }}
                        </label>
                    @endforeach
                </div>
            @endif
            <button class="btn btn-primary">{{ __('Add') }}</button>
        </form>
    </div>

@endsection
