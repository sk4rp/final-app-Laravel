@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Панель управления</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Общий доход</h3>
                <p>{{ $totalExpenses }}</p>
            </div>
            <div class="col-md-6">
                <h3>Статистика по ссылкам</h3>
                <p>Выдано ссылок: {{ $totalOffers }}</p>
                <p>Переходов: {{ $totalClicks }}</p>
                <p>Отказов: {{ $totalUsers }}</p>
            </div>
        </div>
    </div>
@endsection
