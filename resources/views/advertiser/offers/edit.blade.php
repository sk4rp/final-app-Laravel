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
        <h2>{{ __('Редактирование оффера') }}</h2>
        <form action="{{ route('advertiser.offers.update', $offer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">{{ __('Название') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $offer->name }}" required>
            </div>
            <div class="form-group">
                <label for="cost_per_click">{{ __('Стоимость за клик (в руб.)') }}</label>
                <input type="number" name="cost_per_click" id="cost_per_click" class="form-control"
                       value="{{ $offer->cost_per_click . 'руб'}}" min="1" required>
            </div>
            <div class="form-group">
                <label for="target_url">{{ __('Целевой URL') }}</label>
                <input type="url" name="target_url" id="target_url" class="form-control"
                       value="{{ $offer->target_url }}" required>
            </div>
            <div class="form-group">
                <label for="site_themes">{{ __('Темы сайта') }}</label>
                <input type="text" name="site_themes" id="site_themes" class="form-control"
                       value="{{ $offer->site_themes }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Сохранить изменения') }}</button>
        </form>
    </div>
@endsection
