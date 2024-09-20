# 📊 Финальный Проект

Добро пожаловать в финальный проект! Этот проект выполнен с учетом всех требований и стандартов, и я рад представить его
вашему вниманию.

## Запуск проекта

1. **Установка зависимостей**
    ```bash
    composer install
    ```

2. **Проверка ```.env``` файла**

   Здесь должна быть указана ваша БД с правильными кредами:

   (в моём случае была база от ```MAMP```)
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=final
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

   Так же, если используем ***Pusher*** - тогда необходимо вставить свои креды здесь:
    ```
    PUSHER_APP_ID="1868062"
    PUSHER_APP_KEY="a6d6cae195ed43c8791f"
    PUSHER_APP_SECRET="1c779343d084288db883"
    PUSHER_APP_CLUSTER="eu"
    ```

3. **Запустить миграции, чтобы у нас были таблицы в БД**
    ```bash
    php artisan migrate
    ```

4. **Запустить seeders, чтобы у нас были тестовые данные в таблицах**
    ```bash
    php artisan db:seed
    ```

5. **Запустить live-server для тестирования**
    ```bash
   php artisan serve
   ```

## 🔍 Критерии оценивания

Максимальный балл за выполнение: **50**  
Минимальный балл для прохождения защиты: **40**

### ✅ Оценка проекта производится по следующим критериям:

1. **Нормализация базы данных и индексы**
    - 🗃️ База данных сформирована с соблюдением нормализации.
    - 🔄 Соотношения в данных отвечают третьей нормальной форме.
    - 📈 В базе данных расставлены индексы.

2. **Асинхронное общение и обновление сообщений**
    - 🌐 Сообщения отправляются через асинхронное общение с сервером.
    - 🔄 Принятие сообщения, его изменение и удаление происходят без перезагрузки страницы.
    - ⏱️ Сообщение отправляется на сервер за время до 0.5 секунд.

3. **Безопасность**
    - 🛡️ Система не имеет уязвимостей вида:
        - 🔍 SQL-инъекция (SQL Injection)
        - 🛡️ CSRF атака (Cross-Site Request Forgery)
        - 🕵️‍♂️ XSS атака (Cross-Site Scripting)

4. **Многопользовательский режим и производительность**
    - 👥 Система работает в многопользовательском режиме, не снижая производительности.

5. **Менеджеры зависимостей**
    - 📦 Все библиотеки в коде подключаются через менеджеры зависимостей.

6. **Стандарты кодирования**
    - 📜 Код отвечает стандартам:
        - ECMA Script 6
        - PSR 1, 12, 2, 4, 11

7. **Интерактивность трекера**
    - 🖱️ Трекер предоставляет интерактивность в виде перемещения офферов из статуса в статус при помощи мыши,
      соответственно изменяя их статус в хранилище.
