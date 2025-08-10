@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container profile-wrapper my-4">
  <h2 class="mb-4">プロフィール編集</h2>

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
      <label for="name" class="form-label">名前</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label for="bio" class="form-label">自己紹介</label>
      <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">更新する</button>
  </form>
</div>

@if (session('status') === 'profile-updated')
  <div class="alert alert-success my-3">
    プロフィールを更新しました！
  </div>
@endif

@endsection
