@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Панель управления') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ __('Выдано ссылок') }}: <span id="totalOffers">{{ $totalOffers }}</span></p>
                <p>{{ __('Переходов') }}: <span id="totalClicks">{{ $totalClicks }}</span></p>
                <p>{{ __('Пользователей') }}: <span id="totalUsers">{{ $totalUsers }}</span></p>
            </div>
        </div>
    </div>
    <script>
        function updateStatistics() {
            fetch('/admin/dashboard')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalOffers').textContent = data.totalOffers;
                    document.getElementById('totalClicks').textContent = data.totalClicks;
                    document.getElementById('totalUsers').textContent = data.totalUsers;
                })
                .catch(error => console.error('Error fetching statistics:', error));
        }

        setInterval(updateStatistics, 1000);
        updateStatistics();
    </script>
@endsection
