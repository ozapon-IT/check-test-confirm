@extends('layouts.app')

@section('title', 'Contact - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contacts/index.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <h1 class="header__title">FashionablyLate</h1>
    </div>
</header>
@endsection

@section('content')
<div class="form">
    <h2 class="form__title">Contact</h2>
    <form class="form__body" action="{{ route('contacts.confirm') }}" method="POST">
        @csrf
        <!-- お名前 -->
        <x-contact-field :name="['last_name', 'first_name']" label="お名前" required="true">
            <input class="form__input form__input--name" type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
            <input class="form__input form__input--name" type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
        </x-contact-field>

        <!-- 性別 -->
        <x-contact-field name="gender" label="性別" required="true">
            <input class="form__radio" type="radio" id="male" name="gender" value="male" checked {{ old('gender') == 'male' ? 'checked' : '' }}>
            <label class="form__radio-label" for="male">男性</label>
            <input class="form__radio" type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
            <label class="form__radio-label" for="female">女性</label>
            <input class="form__radio" type="radio" id="other" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
            <label class="form__radio-label" for="other">その他</label>
        </x-contact-field>

        <!-- メールアドレス -->
        <x-contact-field name="email" label="メールアドレス" required="true">
            <input class="form__input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </x-contact-field>

        <!-- 電話番号 -->
        <x-contact-field :name="['phone1', 'phone2', 'phone3']" label="電話番号" required="true">
            <input class="form__input form__input--phone" type="text" id="phone1" name="phone1" value="{{ old('phone1') }}" placeholder="（1）例: 080"> -
            <input class="form__input form__input--phone" type="text" id="phone2" name="phone2" value="{{ old('phone2') }}" placeholder="（2）例: 1234"> -
            <input class="form__input form__input--phone" type="text" id="phone3" name="phone3" value="{{ old('phone3') }}" placeholder="（3）例: 5678">
        </x-contact-field>

        <!-- 住所 -->
        <x-contact-field name="address" label="住所" required="true">
            <input class="form__input" type="text" id="address" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        </x-contact-field>

        <!-- 建物名 -->
        <x-contact-field name="building" label="建物名">
            <input class="form__input" type="text" id="building" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        </x-contact-field>

        <!-- お問い合わせの種類 -->
        <x-contact-field name="content" label="お問い合わせの種類" required="true">
            <select class="form__select" id="inquiry_type" name="content">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('content') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                @endforeach
            </select>
        </x-contact-field>

        <!-- お問い合わせ内容 -->
        <x-contact-field name="detail" label="お問い合わせ内容" required="true">
            <textarea class="form__textarea" id="inquiry_content" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        </x-contact-field>

        <!-- 確認画面へのボタン -->
        <div class="form__group form__group--submit">
            <button class="form__button" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
