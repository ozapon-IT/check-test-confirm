<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- ヘッダー -->
    <header class="header">
        <div class="header__container">
            <h1 class="header__title">FashionablyLate</h1>
            <a  class="header__register-link" href="{{ route('register') }}">register</a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main">
        <h2 class="login__title">Login</h2>
        <section class="login">
            <div class="login__form-container">
                <form class="login__form" action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- メールアドレス -->
                    <div class="form__group">
                        <label class="form__label" for="email">メールアドレス</label>
                        <input class="form__input" type="email" id="email" name="email"  placeholder="例: test@example.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- パスワード -->
                    <div class="form__group">
                        <label class="form__label" for="password">パスワード</label>
                        <input class="form__input" type="password" id="password" name="password" placeholder="例: coachetech1106">
                        @error('password')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 登録ボタン -->
                    <div class="form__group form__group--submit">
                        <button  class="form__button" type="submit">ログイン</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>

</html>
