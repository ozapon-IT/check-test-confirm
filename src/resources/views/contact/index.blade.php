@extends('layouts.app')

@section('title', 'Contact - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/index.css') }}">
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
    <form class="form__body" action="{{ route('contact.confirm') }}" method="POST">
        @csrf
        <!-- お名前 -->
        <div class="form__group form__group--name">
            <div class="form__label-box">
                <label class="form__label" for="last_name">
                    お名前 <span class="form__required">※</span>
                </label>
                @error('last_name')
                    <div class="form__error">{{ $message }}</div>
                @enderror
                @error('first_name')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__input" type="text" id="last_name" name="last_name" value="{{ old('last_name', $inputs['last_name'] ?? '') }}" placeholder="例: 山田">
                <input class="form__input" type="text" id="first_name" name="first_name" value="{{ old('first_name', $inputs['first_name'] ?? '') }}" placeholder="例: 太郎">
            </div>
        </div>
        <!-- 性別 -->
        <div class="form__group form__group--gender">
            <div class="form__label-box">
                <label class="form__label">
                    性別 <span class="form__required">※</span>
                </label>
                @error('gender')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__radio" type="radio" id="male" name="gender" value="male" checked {{ old('gender', $inputs['gender'] ?? '') === 'male' ? 'checked' : '' }}>
                <label class="form__radio-label" for="male">男性</label>
                <input class="form__radio" type="radio" id="female" name="gender" value="female" {{ old('gender', $inputs['gender'] ?? '') === 'female' ? 'checked' : '' }}>
                <label class="form__radio-label" for="female">女性</label>
                <input class="form__radio" type="radio" id="other" name="gender" value="other" {{ old('gender', $inputs['gender'] ?? '') === 'other' ? 'checked' : '' }}>
                <label class="form__radio-label" for="other">その他</label>
            </div>
        </div>
        <!-- メールアドレス -->
        <div class="form__group form__group--email">
            <div class="form__label-box">
                <label class="form__label" for="email">
                    メールアドレス <span class="form__required">※</span>
                </label>
                @error('email')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__input" type="email" id="email" name="email" value="{{ old('email', $inputs['email'] ?? '') }}" placeholder="例: test@example.com">
            </div>
        </div>
        <!-- 電話番号 -->
        <div class="form__group form__group--phone">
            <div class="form__label-box">
                <label class="form__label" for="phone1">
                    電話番号 <span class="form__required">※</span>
                </label>
                @error('phone1')
                    <div class="form__error">{{ $message }}</div>
                @enderror
                @error('phone2')
                    <div class="form__error">{{ $message }}</div>
                @enderror
                @error('phone3')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__input form__input--phone" type="text" id="phone1" name="phone1" value="{{ old('phone1', $inputs['phone1'] ?? '') }}" maxlength="5" placeholder="(1) 例: 080"> -
                <input class="form__input form__input--phone" type="text" id="phone2" name="phone2" value="{{ old('phone2', $inputs['phone2'] ?? '') }}" maxlength="5" placeholder="(2) 例: 1234"> -
                <input class="form__input form__input--phone" type="text" id="phone3" name="phone3" value="{{ old('phone3', $inputs['phone3'] ?? '') }}" maxlength="5" placeholder="(3) 例: 5678">
            </div>
        </div>
        <!-- 住所 -->
        <div class="form__group form__group--address">
            <div class="form__label-box">
                <label class="form__label" for="address">
                    住所 <span class="form__required">※</span>
                </label>
                @error('address')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__input" type="text" id="address" name="address" value="{{ old('address', $inputs['address'] ?? '') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
            </div>
        </div>
        <!-- 建物名 -->
        <div class="form__group form__group--building">
            <div class="form__label-box">
                <label class="form__label" for="building">建物名</label>
                @error('building')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <input class="form__input" type="text" id="building" name="building" value="{{ old('building', $inputs['building'] ?? '') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>
        </div>
        <!-- お問い合わせの種類 -->
        <div class="form__group form__group--type">
            <div class="form__label-box">
                <label class="form__label" for="inquiry_type">
                    お問い合わせの種類 <span class="form__required">※</span>
                </label>
                @error('content')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <select class="form__select" id="inquiry_type" name="content">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('content', $inputs['content'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- お問い合わせ内容 -->
        <div class="form__group form__group--content">
            <div class="form__label-box">
                <label class="form__label" for="inquiry_content">
                    お問い合わせ内容 <span class="form__required">※</span>
                </label>
                @error('detail')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form__input-box">
                <textarea class="form__textarea" id="inquiry_content" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $inputs['detail'] ?? '') }}</textarea>
            </div>
        </div>
        <!-- 確認画面へのボタン -->
        <div class="form__group form__group--submit">
            <button class="form__button" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
