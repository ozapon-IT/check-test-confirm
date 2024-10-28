@extends('layouts.app')

@section('title', 'Register - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <h1 class="header__title">FashionablyLate</h1>
        <a class="header__login-link" href="{{ route('login') }}">login</a>
    </div>
</header>
@endsection

@section('content')
<h2 class="register__title">Register</h2>
<section class="register">
    <div class="register__form-container">
        <form class="register__form" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- お名前 -->
            <x-auth-field name="name" label="お名前">
                <input class="form__input" type="text" id="name" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
            </x-auth-field>

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
                <button  class="form__button" type="submit">登録</button>
            </div>
        </form>
    </div>
</section>
@endsection