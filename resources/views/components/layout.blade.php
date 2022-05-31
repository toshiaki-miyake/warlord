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
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ダッシュボード</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">サインアップ</a>
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
