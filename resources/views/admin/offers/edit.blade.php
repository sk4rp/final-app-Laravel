@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Редактирование оффера</h2>
        <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Название</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $offer->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="cost_per_click" class="form-label">Стоимость за клик</label>
                <input type="number" step="0.01" class="form-control" id="cost_per_click" name="cost_per_click" value="{{ old('cost_per_click', $offer->cost_per_click) }}" required>
            </div>

            <div class="mb-3">
                <label for="target_url" class="form-label">Целевой URL</label>
                <input type="url" class="form-control" id="target_url" name="target_url" value="{{ old('target_url', $offer->target_url) }}" required>
            </div>

            <div class="mb-3">
                <label for="site_themes" class="form-label">Темы сайта</label>
                <input type="text" class="form-control" id="site_themes" name="site_themes" value="{{ old('site_themes', $offer->site_themes) }}" required>
            </div>

            <div class="mb-3">
                <label for="is_active" class="form-label">Статус</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" {{ old('is_active', $offer->is_active) ? 'selected' : '' }}>Активен</option>
                    <option value="0" {{ !old('is_active', $offer->is_active) ? 'selected' : '' }}>Неактивен</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
