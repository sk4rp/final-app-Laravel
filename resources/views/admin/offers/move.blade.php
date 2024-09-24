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
        <h2>{{ __('Управление офферами') }}</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>{{ __('Активные офферы') }}</h4>
                <div id="active-offers" class="offer-list border p-3"
                     style="min-height: 200px; background-color: #f0f0f0;">
                    @foreach($offers->where('is_active', true) as $offer)
                        <div class="offer-item border p-2 mb-2" draggable="true" data-offer-id="{{ $offer->id }}">
                            <strong>{{ $offer->name }}</strong><br>
                            {{ $offer->cost_per_click }} руб.<br>
                            <a href="{{ $offer->target_url }}"
                               target="_blank"> {{ __('Ссылка на оффер') }}</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <h4>{{ __('Неактивные офферы') }}</h4>
                <div id="inactive-offers" class="offer-list border p-3"
                     style="min-height: 200px; background-color: #f0f0f0;">
                    @foreach($offers->where('is_active', false) as $offer)
                        <div class="offer-item border p-2 mb-2" draggable="true" data-offer-id="{{ $offer->id }}">
                            <strong>{{ $offer->name }}</strong><br>
                            {{ $offer->cost_per_click }} руб.<br>
                            <a href="{{ $offer->target_url }}"
                               target="_blank"> {{ __('Ссылка на оффер') }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const activeOffers = document.getElementById('active-offers');
                const inactiveOffers = document.getElementById('inactive-offers');

                document.querySelectorAll('.offer-item').forEach(function (item) {
                    item.addEventListener('dragstart', function (e) {
                        e.dataTransfer.setData('offer-id', item.getAttribute('data-offer-id'));
                    });
                });

                activeOffers.addEventListener('dragover', function (e) {
                    e.preventDefault();
                });

                inactiveOffers.addEventListener('dragover', function (e) {
                    e.preventDefault();
                });

                activeOffers.addEventListener('drop', function (e) {
                    e.preventDefault();
                    const offerId = e.dataTransfer.getData('offer-id');
                    changeOfferStatus(offerId, 'activate');
                });

                inactiveOffers.addEventListener('drop', function (e) {
                    e.preventDefault();
                    const offerId = e.dataTransfer.getData('offer-id');
                    changeOfferStatus(offerId, 'deactivate');
                });

                function changeOfferStatus(offerId, action) {
                    fetch(`/admin/offers/${offerId}/${action}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Произошла ошибка при изменении статуса оффера');
                        }
                    });
                }
            });
        </script>
@endsection
