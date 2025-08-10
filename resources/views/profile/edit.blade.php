@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container my-4">
  <h2 class="mb-4">プロフィール編集</h2>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
    @csrf
    @method('PATCH')

    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">メールアドレス</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
      <label for="bio" class="form-label">自己紹介</label>
      <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <div class="mb-3">
      <label for="avatar" class="form-label">アイコン画像</label>
      <input class="form-control" type="file" id="avatar" name="avatar">
      @if ($user->avatar)
      <div class="mt-2">
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="アバター" class="img-thumbnail" style="max-width: 150px;">
      </div>
      @endif
    </div>

    <button type="submit" class="btn btn-primary">更新する</button>
    <a href="{{ route('profile.show') }}" class="btn btn-secondary ms-2">キャンセル</a>
  </form>
</div>
@endsection
