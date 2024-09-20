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
        <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Название') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $offer->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="cost_per_click" class="form-label">{{ __('Стоимость за клик (в руб.)') }}</label>
                <input type="number" step="0.01" class="form-control" id="cost_per_click" name="cost_per_click" value="{{ old('cost_per_click', $offer->cost_per_click) }}" required>
            </div>

            <div class="mb-3">
                <label for="target_url" class="form-label">{{ __('Целевой UR') }}L</label>
                <input type="url" class="form-control" id="target_url" name="target_url" value="{{ old('target_url', $offer->target_url) }}" required>
            </div>

            <div class="mb-3">
                <label for="site_themes" class="form-label">{{ __('Темы сайта') }}</label>
                <input type="text" class="form-control" id="site_themes" name="site_themes" value="{{ old('site_themes', $offer->site_themes) }}" required>
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">{{ __('Статус') }}</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ old('is_active', $offer->is_active) ? 'selected' : '' }}>{{ __('Активен') }}</option>
                    <option value="0" {{ !old('is_active', $offer->is_active) ? 'selected' : '' }}>{{ __('Неактивен') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Сохранить изменения') }}</button>
        </form>
    </div>
@endsection
