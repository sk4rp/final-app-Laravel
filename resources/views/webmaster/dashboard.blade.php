@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Личный кабинет веб-мастера') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ __('Выдано ссылок') }}: <span id="totalLinks">{{ $totalLinks }}</span></p>
                <p>{{ __('Переходов') }}: <span id="totalClicks">{{ $totalClicks }}</span></p>
                <p>{{ __('Офферов') }}: <span id="totalOffers">{{ $totalOffers }}</span></p>
            </div>
        </div>
    </div>
    <script>
        function updateStatistics() {
            fetch(`/webmaster/statistics`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalLinks').textContent = data.totalLinks;
                    document.getElementById('totalClicks').textContent = data.totalClicks;
                    document.getElementById('totalOffers').textContent = data.totalOffers;
                })
                .catch(error => console.error('Error fetching statistics:', error));
        }

        setInterval(updateStatistics, 5000);
        updateStatistics();
    </script>
@endsection
