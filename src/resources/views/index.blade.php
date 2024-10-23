<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <!-- ヘッダー部分 -->
    <header class="header">
        <div class="header__container">
            <h1 class="header__title">FashionablyLate</h1>
        </div>
    </header>

    <!-- メインコンテンツ部分 -->
    <main class="main">
        <div class="form">
            <h2 class="form__title">Contact</h2>

            <form class="form__body" action="/confirm" method="POST">
                @csrf
                <!-- お名前 -->
                <div class="form__group form__group--name">
                    <div class="form__label-box">
                        <label class="form__label" for="last_name">
                            お名前 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <input class="form__input" type="text" id="last_name" name="last_name" placeholder="例: 山田">
                        <input class="form__input" type="text" id="first_name" name="first_name" placeholder="例: 太郎">
                    </div>
                </div>

                <!-- 性別 -->
                <div class="form__group form__group--gender">
                    <div class="form__label-box">
                        <label class="form__label">
                            性別 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <input class="form__radio" type="radio" id="male" name="gender" value="male" checked>
                        <label class="form__radio-label" for="male">男性</label>
                        <input class="form__radio" type="radio" id="female" name="gender" value="female">
                        <label class="form__radio-label" for="female">女性</label>
                        <input class="form__radio" type="radio" id="other" name="gender" value="other">
                        <label class="form__radio-label" for="other">その他</label>
                    </div>
                </div>

                <!-- メールアドレス -->
                <div class="form__group form__group--email">
                    <div class="form__label-box">
                        <label class="form__label" for="email">
                            メールアドレス <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <input class="form__input" type="email" id="email" name="email" placeholder="例: test@example.com">
                    </div>
                </div>

                <!-- 電話番号 -->
                <div class="form__group form__group--phone">
                    <div class="form__label-box">
                        <label class="form__label" for="phone1">
                            電話番号 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <input type="text" id="phone1" name="phone1" maxlength="4" placeholder="080" class="form__input form__input--phone"> -
                        <input type="text" id="phone2" name="phone2" maxlength="4" placeholder="1234" class="form__input form__input--phone"> -
                        <input type="text" id="phone3" name="phone3" maxlength="4" placeholder="5678" class="form__input form__input--phone">
                    </div>
                </div>

                <!-- 住所 -->
                <div class="form__group form__group--address">
                    <div class="form__label-box">
                        <label class="form__label" for="address">
                            住所 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <input class="form__input" type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                    </div>
                </div>

                <!-- 建物名 -->
                <div class="form__group form__group--building">
                    <div class="form__label-box">
                        <label class="form__label" for="building">建物名</label>
                    </div>
                    <div class="form__input-box">
                        <input class="form__input" type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101">
                    </div>
                </div>

                <!-- お問い合わせの種類 -->
                <div class="form__group form__group--type">
                    <div class="form__label-box">
                        <label class="form__label" for="inquiry_type">
                            お問い合わせの種類 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <select class="form__select" id="inquiry_type" name="content">
                            <option value="">選択してください</option>
                            <option value="1">商品のお届けについて</option>
                            <option value="2">商品の交換について</option>
                            <option value="3">商品トラブル</option>
                            <option value="4">ショップへのお問い合わせ</option>
                            <option value="5">その他</option>
                        </select>
                    </div>
                </div>

                <!-- お問い合わせ内容 -->
                <div class="form__group form__group--content">
                    <div class="form__label-box">
                        <label class="form__label" for="inquiry_content">
                            お問い合わせ内容 <span class="form__required">※</span>
                        </label>
                    </div>
                    <div class="form__input-box">
                        <textarea class="form__textarea" id="inquiry_content" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください"></textarea>
                    </div>
                </div>

                <!-- 確認画面へのボタン -->
                <div class="form__group form__group--submit">
                    <button class="form__button" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
