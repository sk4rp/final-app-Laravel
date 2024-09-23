@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
    @endif
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
                <input type="hidden" id="cost-per-click" value="{{ $offer->cost_per_click }}">
            </div>
            <button type="button" id="subscribe-button" class="btn btn-primary">{{ __('Подписаться') }}</button>
        </form>
    </div>
@endsection
