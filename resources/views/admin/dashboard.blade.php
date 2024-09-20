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
        <h2>{{ __('Панель управления') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ __('Выдано ссылок') }}: {{ $totalOffers }}</p>
                <p>{{ __('Переходов') }}: {{ $totalClicks }}</p>
                <p>{{ __('Отказов') }}: {{ $totalUsers }}</p>
            </div>
        </div>
    </div>
@endsection
