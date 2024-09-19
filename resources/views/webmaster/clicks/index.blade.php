@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Мои клики</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Оффер</th>
                <th>Дата клика</th>
                <th>Количество переходов</th>
                <th>Имя веб-мастера</th>
                <th>Клиентский адрес</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clicks as $click)
                <tr>
                    <td>{{ $click->offer->name }}</td>
                    <td>{{ $click->clicked_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $click->amount }}</td>
                    <td>{{ $click->webmaster->name }}</td>
                    <td>{{ $click->client_ip }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
