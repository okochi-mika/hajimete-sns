@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <h2>プロフィール編集</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        </div>

        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        </div>

        <div>
            <label for="bio">自己紹介:</label>
            <textarea name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <label for="avatar">アイコン画像:</label>
            <input type="file" name="avatar" id="avatar">
        </div>

        @if ($user->avatar)
            <p>現在のアイコン:</p>
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="アバター" style="max-width: 150px;">
        @endif

        <button type="submit" class="btn btn-success">更新する</button>
    </form>
@endsection
