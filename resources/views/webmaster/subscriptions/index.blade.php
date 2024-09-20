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
        <h2>{{ __('Мои подписки') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Оффер') }}</th>
                <th>{{ __('Стоимость за клик (в руб.)') }}</th>
                <th>{{ __('Дата подписки') }}</th>
                <th>{{ __('Действия') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->offer->name }}</td>
                    <td>{{ $subscription->cost_per_click }} руб.</td>
                    <td>{{ $subscription->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('webmaster.subscriptions.show', $subscription->id) }}"
                           class="btn btn-info">{{ __('Просмотр') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('webmaster.subscriptions.create') }}" class="btn btn-primary">{{ __('Создать подписку') }}</a>
    </div>
@endsection
