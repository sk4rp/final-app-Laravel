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
        <h2>{{ __('Управление пользователями') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Имя') }}</th>
                <th>{{ __('Электронная почта') }}</th>
                <th>{{ __('Роль') }}</th>
                <th>{{ __('Действия') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="btn btn-primary">{{ __('Изменить') }}</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
