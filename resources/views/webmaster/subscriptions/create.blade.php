@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Создать подписку') }}</h2>
        <form action="{{ route('webmaster.subscriptions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="offer_id">{{ __('Оффер') }}</label>
                <select name="offer_id" id="offer_id" class="form-control" required>
                    @foreach($offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cost_per_click">{{ __('Стоимость за клик (в руб.)') }}</label>
                <input type="number" name="cost_per_click" id="cost_per_click" class="form-control" step="0.01"
                       required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Создать') }}</button>
        </form>
    </div>
@endsection
