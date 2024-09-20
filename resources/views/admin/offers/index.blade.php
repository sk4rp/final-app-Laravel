@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Управление офферами') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Название') }}</th>
                <th>{{ __('Стоимость за клик (в руб.)') }}</th>
                <th>{{ __('Целевой URL') }}L</th>
                <th>{{ __('Темы сайта') }}</th>
                <th>{{ __('Статус') }}</th>
                <th>{{ __('Действия') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->cost_per_click }} руб.</td>
                    <td>{{ $offer->target_url }}</td>
                    <td>{{ $offer->site_themes }}</td>
                    <td>{{ $offer->is_active ? "Активен" : 'Неактивен' }}</td>
                    <td>
                        <a href="{{ route('admin.offers.edit', $offer->id) }}"
                           class="btn btn-primary">{{__('Изменить')}}</a>
                        <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">{{ __('Удалить') }}</button>
                        </form>
                        @if($offer->is_active)
                            <form action="{{ route('admin.offers.deactivate', $offer->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">{{ __('Деактивировать оффер') }}</button>
                            </form>
                        @else
                            <form action="{{ route('admin.offers.activate', $offer->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">{{ __('Активировать оффер') }}</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
