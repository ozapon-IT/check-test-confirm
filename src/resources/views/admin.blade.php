<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FashionablyLate</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <!-- ヘッダー -->
    <header class="header">
        <div class="header__container">
            <h1 class="header__title">FashionablyLate</h1>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="header__logout-button" type="submit">logout</button>
            </form>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="admin">
        <h2 class="admin__title">Admin</h2>

        <!-- フィルタフォーム -->
        <form class="admin__filters" method="GET" action="{{ route('admin.search') }}">
            <input class="filters__input" type="text" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}" name="keyword">
            <select class="filters__select filters__select--gender" name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') =='all' ? 'selected' : ''}}>全て</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>
            <select class="filters__select filters__select--inquiry" name="category">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : ''}}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <input  class="filters__select filters__select--date" type="date" value="{{ request('date') }}" name="date">

            <button class="filters__button filters__button--search" type="submit">検索</button>

            <a class="filters__button filters__button--reset" href="{{ route('admin.index') }}" type="reset">リセット</a>
        </form>

        <div class="admin__features">
            <!-- エクスポートボタン -->
            <button class="export-button">エクスポート</button>

            <!-- ページネーション -->
            {{ $contacts->links() }}
            {{-- <nav class="pagination">
                <ul class="pagination__list">
                    <li class="pagination__item pagination__item--active"><a href="#" class="pagination__link">1</a></li>
                    <li class="pagination__item"><a href="#" class="pagination__link">2</a></li>
                    <li class="pagination__item"><a href="#" class="pagination__link">3</a></li>
                    <li class="pagination__item"><a href="#" class="pagination__link">4</a></li>
                    <li class="pagination__item"><a href="#" class="pagination__link">5</a></li>
                </ul>
            </nav> --}}
        </div>


        <!-- テーブル -->
        <table class="admin__table">
            <thead class="table__head">
                <tr class="table__row table__row--head">
                    <th class="table__cell table__cell--head">お名前</th>
                    <th class="table__cell table__cell--head">性別</th>
                    <th class="table__cell table__cell--head">メールアドレス</th>
                    <th class="table__cell table__cell--head">お問い合わせの種類</th>
                    <th class="table__cell table__cell--head"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                {{-- <tr class="table__row">
                    <td class="table__cell table__cell--desc">山田 太郎</td>
                    <td class="table__cell table__cell--desc">男性</td>
                    <td class="table__cell table__cell--desc">test@example.com</td>
                    <td class="table__cell table__cell--desc">商品の交換について</td>
                    <td class="table__cell table__cell--desc">
                        <button class="table__detail-button">詳細</button>
                    </td>
                </tr> --}}

                @foreach($contacts as $contact)
                <tr class="table__row">
                    <td class="table__cell table__cell--desc">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td class="table__cell table__cell--desc">
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td class="table__cell table__cell--desc">{{ $contact->email }}</td>
                    <td class="table__cell table__cell--desc">{{ $contact->category->content }}</td>
                    <td class="table__cell table__cell--desc">
                        <button class="table__detail-button">詳細</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>