@extends('layouts.app')

@section('title', 'Admin - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/admin.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <h1 class="header__title">FashionablyLate</h1>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="header__logout-button" type="submit">logout</button>
        </form>
    </div>
</header>
@endsection

@section('content')
<div class="admin">
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
                <td class="table__cell table__cell--desc">{{ $contact->full_name }}</td>
                <td class="table__cell table__cell--desc">{{ $contact->gender_text }}</td>
                <td class="table__cell table__cell--desc">{{ $contact->email }}</td>
                <td class="table__cell table__cell--desc">{{ $contact->category->content }}</td>
                <td class="table__cell table__cell--desc">
                    <a class="table__detail-button" href="#modal-{{ $contact->id }}">詳細</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダルウィンドウ -->
    @foreach($contacts as $contact)
        <x-admin-modal :contact="$contact" />
    @endforeach
</div>
@endsection