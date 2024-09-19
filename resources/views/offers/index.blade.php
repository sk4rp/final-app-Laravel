@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Офферы</h1>
        <a href="{{ route('offers.create') }}" class="btn btn-primary">Создать новый оффер</a>

        @if($offers->isEmpty())
            <div class="alert alert-info mt-3">Офферы отсутствуют</div>
        @else
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Стоимость за клик</th>
                    <th>URL</th>
                    <th>Темы сайта</th>
                    <th>Активность</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->cost_per_click }}</td>
                        <td>{{ $offer->target_url }}</td>
                        <td>{{ $offer->site_themes }}</td>
                        <td>{{ $offer->is_active ? 'Активен' : 'Неактивен' }}</td>
                        <td>
                            <a href="{{ route('offers.show', $offer) }}" class="btn btn-info">Посмотреть</a>
                            <a href="{{ route('offers.edit', $offer) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('offers.destroy', $offer) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
