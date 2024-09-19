@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Панель управления') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ $totalExpenses }}</p>
            </div>
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ __('Выдано ссылок') }}: {{ $totalOffers }}</p>
                <p>{{ __('Переходов') }}: {{ $totalClicks }}</p>
                <p>{{ __('Отказов') }}: {{ $totalUsers }}</p>
            </div>
        </div>
    </div>
@endsection
