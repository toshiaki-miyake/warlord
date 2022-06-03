<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <header class="header">
        <div class="inner">
            <h1><a href="/"><img src="/img/warload.png"></a></h1>
            <ul>
                <li>
                    @if (Route::has('login'))
                    @auth
                        {{-- <nav x-data="{ open: false }" class=""> --}}
                            <!-- Responsive Navigation Menu -->
                            <div :class="{'block': open, 'hidden': ! open}" class="logout">
                                <!-- Responsive Settings Options -->
                                <p class="name">{{ Auth::user()->name }}</p>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('ログアウト') }}
                                    </x-responsive-nav-link>
                                </form>
                        {{-- </nav> --}}
                    @else
                        <a href="{{ route('login') }}" class="">ログイン</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">サインアップ</a>
                        @endif
                    @endauth
                    </div>
                @endif
                </li>
            </ul>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="footer">
        <div class="copyright">copyright 2022</div>
    </footer>
</body>
</html>
