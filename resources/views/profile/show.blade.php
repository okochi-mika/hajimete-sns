@extends('layouts.app')

@section('title', 'プロフィール情報')

@section('content')
<div class="container profile-wrapper my-4">
  <h2 class="mb-4">プロフィール情報</h2>

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

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">編集</a>
  </form>
</div>
@endsection
