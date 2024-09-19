@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Система статистики</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Общее количество кликов</th>
                <th>Количество отказов</th>
                <th>Количество переходов</th>
                <th>Общий доход</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $totalClicks }}</td>
                <td>{{ $totalRefusals }}</td>
                <td>{{ $totalRedirects }}</td>
                <td>{{ $totalIncome }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
