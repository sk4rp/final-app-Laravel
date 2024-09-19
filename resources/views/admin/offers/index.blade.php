@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Управление офферами</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Стоимость за клик</th>
                <th>Целевой URL</th>
                <th>Темы сайта</th>
                <th>Статус</th>
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
                    <td>{{ $offer->is_active ? 'Активен' : 'Неактивен' }}</td>
                    <td>
                        <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-primary">Изменить</a>
                        <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                        @if($offer->is_active)
                            <form action="{{ route('admin.offers.deactivate', $offer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Деактивировать оффер</button>
                            </form>
                        @else
                            <form action="{{ route('admin.offers.activate', $offer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Активировать оффер</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
