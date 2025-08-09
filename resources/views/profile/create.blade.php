@extends('layouts.app')

@section('title', 'プロフィール作成')

@section('content')
    <h2>プロフィール作成</h2>

    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="bio">自己紹介:</label>
            <textarea name="bio" id="bio">{{ old('bio') }}</textarea>
        </div>

        <div>
            <label for="avatar">アイコン画像:</label>
            <input type="file" name="avatar" id="avatar">
        </div>

        <button type="submit">作成する</button>
    </form>
@endsection
