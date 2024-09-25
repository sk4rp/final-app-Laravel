@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Личный кабинет рекламодателя') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>{{ __('Общая статистика') }}</h3>
                <p>{{ __('Выдано ссылок') }}: <span id="totalLinks">{{ $totalLinks }}</span></p>
                <p>{{ __('Переходов') }}: <span id="totalClicks">{{ $totalClicks }}</span></p>
                <p>{{ __('Офферов') }}: <span id="totalOffers">{{ $totalOffers }}</span></p>

                <h4>{{ __('Даты кликов') }}</h4>
                <ul id="clickDatesList">
                    @foreach($clickDates as $date)
                        <li>{{ $date }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script>
        function updateStatistics() {
            fetch(`/advertiser/statistics`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('totalLinks').textContent = data.totalLinks || 0;
                        document.getElementById('totalClicks').textContent = data.totalClicks || 0;
                        document.getElementById('totalOffers').textContent = data.totalOffers || 0;

                        const clickDatesList = document.getElementById('clickDatesList');
                        clickDatesList.innerHTML = '';

                        if (data.clickDates && data.clickDates.length > 0) {
                            data.clickDates.forEach(date => {
                                const listItem = document.createElement('li');
                                listItem.textContent = date;
                                clickDatesList.appendChild(listItem);
                            });
                        } else {
                            clickDatesList.innerHTML = '<li>{{ __("Нет данных") }}</li>';
                        }
                    } else {
                        console.error('No data returned');
                    }
                })
                .catch(error => console.error('Error fetching statistics:', error));
        }
        setInterval(updateStatistics, 5000);
        updateStatistics();
    </script>
@endsection
