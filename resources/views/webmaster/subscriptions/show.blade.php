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
        <h2>{{ __('Детали подписки') }}</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $subscription->offer->name }}</h5>
                <p class="card-text"><strong>{{ __('Стоимость за клик') }}:</strong> {{ $subscription->cost_per_click }}
                    руб.
                </p>
                <p><strong>Ваша ссылка для отправки трафика:</strong> <a
                        href="{{ $trackingUrl }}">{{ $trackingUrl }}</a></p>
                <p class="card-text"><strong>{{ __('Дата подписки') }}
                        :</strong> {{ $subscription->created_at->format('d.m.Y') }}</p>
                <a href="{{ route('webmaster.subscriptions.index') }}" class="btn btn-secondary">{{ __('Назад') }}</a>
            </div>
        </div>
    </div>
@endsection
