@extends('layouts.app')

@section('title', 'Thanks - FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contacts/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
    <h1 class="thanks-page__background-text">Thank you</h1>
    <div class="thanks-page__content">
        <p class="thanks-page__message">お問い合わせありがとうございました</p>
        <a class="thanks-page__button" href="{{ route('contacts.index') }}">HOME</a>
    </div>
</div>
@endsection