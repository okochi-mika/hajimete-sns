@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="bio">自己紹介:</label>
            <textarea name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div>
            <label for="avatar">アイコン画像:</label>
            <input type="file" name="avatar" id="avatar">
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
