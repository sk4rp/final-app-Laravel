document.addEventListener('DOMContentLoaded', function () {
    const subscribeButton = document.querySelector('#subscribe-button');

    if (subscribeButton) {
        subscribeButton.addEventListener('click', async function () {
            const offerId = document.querySelector('#offer-id').value;

            try {
                await subscribeToOffer(offerId);
            } catch (error) {
                console.error('Ошибка подписки:', error);
            }
        });
    } else {
        console.error('Элемент #subscribe-button не найден.');
    }

    async function subscribeToOffer(offerId) {
        try {
            const response = await fetch('/webmaster/subscriptions', { // Исправлено на правильный URL
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
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    const errorData = await response.json();
                    if (errorData.exists) {
                        alert('Вы уже подписаны на этот оффер.');
                    } else {
                        throw new Error(errorData.message || 'Ошибка при подписке');
                    }
                } else {
                    const errorText = await response.text();
                    throw new Error('Ошибка при подписке: ' + errorText);
                }
            }
        } catch (error) {
            console.error('Произошла ошибка:', error);
            alert('Не удалось создать подписку: ' + error.message);
        }
    }
});
