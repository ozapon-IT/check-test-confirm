<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    <!-- ヘッダー -->
    <header class="header">
        <div class="header__container">
            <h1 class="header__title">FashionablyLate</h1>
            <a class="header__login-link" href="{{ route('login') }}">login</a>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main">
        <h2 class="register__title">Register</h2>
        <section class="register">
            <div class="register__form-container">
                <form class="register__form" action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- お名前 -->
                    <div class="form__group">
                        <label class="form__label" for="name">お名前</label>
                        <input class="form__input" type="text" id="name" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                        @error('name')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>

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
                        <button  class="form__button" type="submit">登録</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

</body>
</html>
