<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - FashionablyLate</title>
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
            <div class="filters__box">
                <input class="filters__input" type="text" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}" name="keyword">
            </div>
            <div class="filters__box">
                <select class="filters__select filters__select--gender" name="gender">
                    <option value="">性別</option>
                    <option value="all" {{ request('gender') =='all' ? 'selected' : ''}}>全て</option>
                    <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <div class="filters__box">
                <select class="filters__select filters__select--inquiry" name="category">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : ''}}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="filters__box">
                <input  class="filters__select filters__select--date" type="date" value="{{ request('date') }}" name="date">
            </div>

            <!-- ボタン -->
            <div class="filters__box">
                <button class="filters__button filters__button--search" type="submit">検索</button>
            </div>
            <div class="filters__box">
                <a class="filters__button filters__button--reset" href="{{ route('admin.index') }}" type="reset">リセット</a>
            </div>
        </form>

        <!-- 機能 -->
        <div class="admin__features">
            <!-- エクスポート -->
            <div class="export__container">
                <a class="export-button" href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
            </div>

            <!-- ページネーション -->
            <div class="pagination-container">
                {{ $contacts->links('vendor.pagination.custom') }}
            </div>
        </div>


        <!-- テーブル -->
        <table class="admin__table">
            <thead class="table__head">
                <tr class="table__row table__row--head">
                    <th class="table__cell table__cell--head">お名前</th>
                    <th class="table__cell table__cell--head">性別</th>
                    <th class="table__cell table__cell--head">メールアドレス</th>
                    <th class="table__cell table__cell--head" colspan="2">お問い合わせの種類</th>
                </tr>
            </thead>
            <tbody class="table__body">
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
                        {{-- <button class="table__detail-button">詳細</button> --}}
                        <a class="table__detail-button" href="#modal-{{ $contact->id }}">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- モーダルウィンドウ -->
        @foreach($contacts as $contact)
        <div class="modal" id="modal-{{ $contact->id }}">
            <div class="modal__content">
                <!-- 閉じるボタン -->
                <a href="#" class="modal__close">&times;</a>

                <!-- お問い合わせ詳細 -->
                <div class="contact__box">
                    <div class="contact__item">
                        <p>お名前</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->last_name }} {{ $contact->first_name }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>性別</p>
                    </div>
                    <div class="contact__content">
                        <p>@if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>メールアドレス</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>電話番号</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->tell }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>住所</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->address }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>建物名</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->building }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>お問い合わせの種類</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->category->content }}</p>
                    </div>
                </div>
                <div class="contact__box">
                    <div class="contact__item">
                        <p>お問い合わせ内容</p>
                    </div>
                    <div class="contact__content">
                        <p>{{ $contact->detail }}</p>
                    </div>
                </div>

                <!-- 削除ボタン -->
                <form action="{{ route('admin.destroy', ['id' => $contact->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="button__box">
                        <button type="submit" class="modal__delete-button">削除</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </main>
</body>

</html>