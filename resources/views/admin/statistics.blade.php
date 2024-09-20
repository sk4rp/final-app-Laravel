@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Система статистики') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Общее количество кликов') }}</th>
                <th>{{ __('Общее количество отказов') }}</th>
                <th>{{ __('Общее количество редиректов') }}</th>
                <th>{{ __('Общая прибыль') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $totalClicks }}</td>
                <td>{{ $totalRefusals }}</td>
                <td>{{ $totalRedirects }}</td>
                <td>{{ $totalIncome }} руб.</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
