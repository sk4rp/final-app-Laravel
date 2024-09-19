@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Мои офферы</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Стоимость за клик</th>
                <th>Целевой URL</th>
                <th>Темы сайта</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->cost_per_click }}</td>
                    <td>{{ $offer->target_url }}</td>
                    <td>{{ $offer->site_themes }}</td>
                    <td>
                        <a href="{{ route('advertiser.offers.edit', $offer->id) }}" class="btn btn-primary">Изменить</a>
                        <form action="{{ route('advertiser.offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('advertiser.offers.create') }}" class="btn btn-primary">Создать новый оффер</a>
    </div>
@endsection
