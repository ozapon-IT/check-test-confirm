@extends('layouts.app')

@section('title', 'Login - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <h1 class="header__title">FashionablyLate</h1>
        <a  class="header__register-link" href="{{ route('register') }}">register</a>
    </div>
</header>
@endsection

@section('content')
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
@endsection