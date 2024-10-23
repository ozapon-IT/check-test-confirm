<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム確認画面</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body class="page">
    <!-- ヘッダー -->
    <header class="header">
        <div class="header__container">
            <h1 class="header__title">FashionablyLate</h1>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main">
        <div class="confirm">
            <h2 class="confirm__title">Confirm</h2>

            <form class="confirm__form" action="/thanks" method="POST">
                @csrf
                <table class="confirm__table">
                    <tr class="confirm__row">
                        <th class="confirm__label">お名前</th>
                        <td class="confirm__value">山田 太郎</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">性別</th>
                        <td class="confirm__value">男性</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">メールアドレス</th>
                        <td class="confirm__value">test@example.com</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">電話番号</th>
                        <td class="confirm__value">08012345678</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">住所</th>
                        <td class="confirm__value">東京都渋谷区千駄ヶ谷1-2-3</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">建物名</th>
                        <td class="confirm__value">千駄ヶ谷マンション101</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">お問い合わせの種類</th>
                        <td class="confirm__value">商品の交換について</td>
                    </tr>
                    <tr class="confirm__row">
                        <th class="confirm__label">お問い合わせ内容</th>
                        <td class="confirm__value">
                            届いた商品が注文した商品ではありませんでした。<br>
                            商品の取り替えをお願いします。
                        </td>
                    </tr>
                </table>

                <div class="confirm__buttons">
                    <button class="confirm__button" type="submit">送信</button>
                    <a class="confirm__link" href="/">修正</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
