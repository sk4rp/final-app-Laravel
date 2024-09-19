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
        <h2>{{ __('Регистрация') }}</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Имя') }}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Электронная почта') }}</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Пароль') }}</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Подтвердите пароль') }}</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Выберите роль') }}</label>
                <select name="role" class="form-select" required>
                    <option value="advertiser">{{ __('Рекламодатель') }}</option>
                    <option value="webmaster">{{ __('Веб-мастер') }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Зарегистрироваться') }}</button>
        </form>
    </div>
@endsection
