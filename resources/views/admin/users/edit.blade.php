@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h2>{{ __('Редактирование пользователя') }}</h2>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Имя') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                       required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Электронная почта') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Роль') }}</label>
                <select class="form-control" id="role" name="role">
                    <option
                        value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('Администратор') }}</option>
                    <option
                        value="advertiser" {{ $user->role === 'advertiser' ? 'selected' : '' }}>{{ __('Рекламодатель') }}</option>
                    <option
                        value="webmaster" {{ $user->role === 'webmaster' ? 'selected' : '' }}>{{ __('Вебмастер') }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Сохранить изменения') }}</button>
        </form>
    </div>
@endsection
