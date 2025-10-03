<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>
                <nav>
                    <ul class="header-nav">
                        @guest
                            @if (Route::currentRouteName() === 'register')
                                <li><button class="header-nav__button"><a class="header-nav__link"
                                            href="/login">login</a></button></li>
                            @elseif (Route::currentRouteName() === 'login')
                                <li><button class="header-nav__button"><a class="header-nav__link"
                                            href="/register">register</a></button></li>
                            @endif
                        @endguest
                        @Auth
                            <li class="header-nav__item">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="header-nav__button">logout</button>
                                </form>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>

    </header>
    <main>
        @yield('content')
    </main>

</body>

</html>
