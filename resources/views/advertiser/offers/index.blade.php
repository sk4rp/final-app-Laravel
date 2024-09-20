@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Мои офферы')  }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Название') }}</th>
                <th>{{ __('Стоимость за клик (в руб.)') }}</th>
                <th>{{ __('Целевой URL') }}</th>
                <th>{{ __('Темы сайта') }}</th>
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
                    <td>
                        <a href="{{ route('advertiser.offers.edit', $offer->id) }}"
                           class="btn btn-primary">{{ __('Изменить') }}</a>
                        <form action="{{ route('advertiser.offers.destroy', $offer->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Удалить') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('advertiser.offers.create') }}" class="btn btn-primary">{{ __('Создать новый оффер') }}</a>
    </div>
@endsection
