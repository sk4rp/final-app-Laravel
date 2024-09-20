import './bootstrap';

window.Echo.channel('offers')
    .listen('OfferCreated', (e) => {
        console.log('Новый оффер:', e.offer);
    });
