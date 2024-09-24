@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Личный кабинет рекламодателя') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <label for="fromDate">С:</label>
                <input type="date" id="fromDate" value="{{ date('Y-m-d') }}">
                <label for="toDate">По:</label>
                <input type="date" id="toDate" value="{{ date('Y-m-d') }}">

                <button onclick="updateStatistics()">{{ __('Обновить') }}</button>
                <p>{{ __('Выдано ссылок') }}: <span id="totalLinks">{{ $totalLinks }}</span></p>
                <p>{{ __('Переходов') }}: <span id="totalClicks">{{ $totalClicks }}</span></p>
                <p>{{ __('Офферов') }}: <span id="totalOffers">{{ $totalOffers }}</span></p>
            </div>
        </div>
    </div>
    <script>
        function updateStatistics() {
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;

            fetch(`/advertiser/statistics?from_date=${fromDate}&to_date=${toDate}`)
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
