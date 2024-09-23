async function subscribeToOffer(offerId) {
    try {
        const response = await fetch('/webmaster/subscriptions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                offer_id: offerId
            })
        });

        if (response.ok) {
            const data = await response.json();
            console.log('Подписка успешна:', data);
            alert('Подписка успешно создана на оффер');
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

    try {
        await subscribeToOffer(offerId);
        console.log('Подписка завершена');
    } catch (error) {
        console.error('Ошибка подписки:', error);
    }
});
