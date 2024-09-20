async function subscribeToOffer(offerId, costPerClick) {
    try {
        const response = await fetch('/webmaster/subscriptions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                offer_id: offerId,
                cost_per_click: costPerClick
            })
        });

        if (response.ok) {
            const data = await response.json();
            console.log('Подписка успешна:', data);
            alert('Подписка успешно создана!');
        } else {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Ошибка при подписке');
        }
    } catch (error) {
        console.error('Произошла ошибка:', error);
        alert('Не удалось создать подписку: ' + error.message);
    }
}

document.querySelector('#subscribe-button').addEventListener('click', async function () {
    const offerId = document.querySelector('#offer-id').value;
    const costPerClick = document.querySelector('#cost-per-click').value;

    try {
        await subscribeToOffer(offerId, costPerClick);
        console.log('Подписка завершена');
    } catch (error) {
        console.error('Ошибка подписки:', error);
    }
});
