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
            <x-auth-field name="email" label="メールアドレス">
                <input class="form__input" type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            </x-auth-field>

            <!-- パスワード -->
            <x-auth-field name="password" label="パスワード">
                <input class="form__input" type="password" id="password" name="password" placeholder="例: coachtech1106">
            </x-auth-field>

            <!-- 登録ボタン -->
            <div class="form__group form__group--submit">
                <button  class="form__button" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</section>
@endsection