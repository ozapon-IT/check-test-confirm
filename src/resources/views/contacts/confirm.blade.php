@extends('layouts.app')

@section('title', 'Confirm - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contacts/confirm.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <h1 class="header__title">FashionablyLate</h1>
    </div>
</header>
@endsection

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>

    <!-- 確認フォーム -->
    <form class="confirm__form" action="{{ route('contacts.store') }}" method="POST">
        @csrf

        @foreach($inputs as $key => $value)
            @if(is_array($value))
                @foreach($value as $k => $v)
                    <input type="hidden" name="{{ $key }}[{{ $k }}]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <table class="confirm__table">
            <x-confirm-field label="お名前" value="{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}" />

            <x-confirm-field label="性別" :value="($inputs['gender'] === 'male') ? '男性' : (($inputs['gender'] === 'female') ? '女性' : 'その他')" />

            <x-confirm-field label="メールアドレス" value="{{ $inputs['email'] }}" />

            <x-confirm-field label="電話番号" value="{{ $inputs['phone1'] }}-{{ $inputs['phone2'] }}-{{ $inputs['phone3'] }}" />

            <x-confirm-field label="住所" value="{{ $inputs['address'] }}" />

            <x-confirm-field label="建物名" value="{{ $inputs['building'] ?? 'なし' }}" />

            <x-confirm-field label="お問い合わせの種類" value="{{ $category->content }}" />

            <x-confirm-field label="お問い合わせ内容" value="{!! nl2br(e($inputs['detail'])) !!}" />
        </table>

        <button class="confirm__button confirm__button--store" type="submit">送信</button>
    </form>

    <!-- 修正フォーム -->
    <form class="confirm__form--edit" action="{{ route('contacts.edit') }}" method="POST">
        @csrf

        @foreach($inputs as $key => $value)
            @if(is_array($value))
                @foreach($value as $k => $v)
                    <input type="hidden" name="{{ $key }}[{{ $k }}]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach

        <button class="confirm__button confirm__button--edit" type="submit">修正</button>
    </form>
</div>
@endsection
