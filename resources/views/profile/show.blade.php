@extends('layouts.app')

@section('content')
    <h2>プロフィール</h2>

    <p><strong>名前:</strong> {{ $user->name }}</p>
    <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
    <p><strong>自己紹介:</strong> {{ $user->bio ?? '未設定です' }}</p>

    @if ($user->avatar)
        <p><img src="{{ asset('storage/' . $user->avatar) }}" alt="アバター" style="max-width: 150px;"></p>
    @else
        <p>アバターは未設定です</p>
    @endif

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">プロフィール編集</a>
@endsection
