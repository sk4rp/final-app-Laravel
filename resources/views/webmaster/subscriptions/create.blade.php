@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Создать подписку') }}</h2>
        <form id="subscription-form" onsubmit="return false;">
            <div class="form-group">
                <label for="offer-id">{{ __('Оффер') }}</label>
                <select name="offer_id" id="offer-id" class="form-control" required>
                    @foreach($offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cost-per-click">{{ __('Стоимость за клик') }}</label>
                <input type="number" id="cost-per-click" class="form-control" step="0.01" required>
            </div>
            <button type="button" id="subscribe-button" class="btn btn-primary">{{ __('Создать') }}</button>
        </form>
    </div>
@endsection
