@php
    use App\Enums\RoleEnum;
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SF-AdTech')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">SF-AdTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    @if(auth()->user()->role === RoleEnum::admin->value)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Статистика</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.offers.index') }}">Управление офферами</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Управление пользователями</a>
                        </li>
                    @endif
                    @if(auth()->user()->role === RoleEnum::advertiser->value)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('advertiser.offers.index') }}">Мои офферы</a>
                        </li>
                    @endif
                    @if(auth()->user()->role === RoleEnum::webmaster->value)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('webmaster.subscriptions.index') }}">Мои подписки</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Выйти</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
            </ul>

            @auth
                <div class="d-flex flex-column ms-auto text-end">
                    <span class="navbar-text">
                        Вы авторизованы как: {{ auth()->user()->name }}
                    </span>
                    <span class="navbar-text">
                        Ваша роль: {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            @endauth
        </div>
    </div>
</nav>

<main role="main" class="container mt-4">
    @yield('content')
</main>
<noscript>
    <p>Для полной функциональности сайта включите JavaScript в вашем браузере</p>
</noscript>
@yield('scripts')
</body>
</html>
