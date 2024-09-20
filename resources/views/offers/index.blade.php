@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Офферы') }}</h1>
{{--        <a href="{{ route('offers.create') }}" class="btn btn-primary">{{ __('Создать новый оффер') }}</a>--}}

        @if($offers->isEmpty())
            <div class="alert alert-info mt-3">{{ __('Офферы отсутствуют') }}</div>
        @else
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Название') }}</th>
                    <th>{{ __('Стоимость за клик (в руб.)') }}</th>
                    <th>{{ __(' URL') }}</th>
                    <th>{{ __('Темы сайта') }}</th>
                    <th>{{ __('Активность') }}</th>
                    <th>{{ __('Действия') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->cost_per_click }} в руб.</td>
                        <td>{{ $offer->target_url }}</td>
                        <td>{{ $offer->site_themes }}</td>
                        <td>{{ $offer->is_active ? 'Активен' : 'Неактивен' }}</td>
                        <td>
                            <a href="{{ route('offers.show', $offer) }}" class="btn btn-info">{{ __('Посмотреть') }}</a>
                            <a href="{{ route('offers.edit', $offer) }}" class="btn btn-warning">{{ __('Редактировать') }}</a>
                            <form action="{{ route('offers.destroy', $offer) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">{{ __('Удалить') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
