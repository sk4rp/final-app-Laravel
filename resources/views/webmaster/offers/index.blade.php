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

    <h2>{{ __('Доступные офферы') }}</h2>
    <div id="offers-container">
        @foreach($offers as $offer)
            <div class="offer-item" data-offer-id="{{ $offer->id }}">
                <strong>{{ $offer->name }}</strong><br>
                {{ __('Стоимость клика:') }} {{ $offer->cost_per_click }} руб.<br>
                <p><strong>{{ __('Ваша ссылка для отправки трафика:') }}</strong>
                    <a href="{{ $offer->trackingUrl }}" target="_blank">{{ $offer->trackingUrl }}</a>
                </p>
            </div>
        @endforeach
    </div>

    <script>
        let lastOfferId = {{ $offers->last()->id ?? 0 }};

        function updateOffers() {
            fetch('/api/offers/new/' + lastOfferId)
                .then(response => response.json())
                .then(data => {
                    if (data.offers.length > 0) {
                        let offersContainer = document.getElementById('offers-container');
                        data.offers.forEach(offer => {
                            let offerElement = document.createElement('div');
                            offerElement.classList.add('offer-item');
                            offerElement.setAttribute('data-offer-id', offer.id);
                            offerElement.innerHTML = `
                                <strong>${offer.name}</strong><br>
                                Стоимость клика: ${offer.cost_per_click} руб.<br>
                                <p><strong>Ваша ссылка для отправки трафика:</strong>
                                    <a href="${offer.trackingUrl}" target="_blank">${offer.trackingUrl}</a>
                                </p>
                            `;
                            offersContainer.appendChild(offerElement);
                        });
                        lastOfferId = data.offers[data.offers.length - 1].id;
                    }
                })
                .catch(error => console.error('Ошибка при обновлении офферов:', error));
        }

        setInterval(updateOffers, 1000);
    </script>
@endsection
