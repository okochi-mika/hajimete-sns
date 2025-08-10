@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
<div class="container my-4">
  <h2 class="mb-4">プロフィール</h2>

  <div class="card" style="max-width: 600px;">
    <div class="card-body">
      <h5 class="card-title">{{ $user->name }}</h5>
      <h6 class="card-subtitle mb-3 text-muted">{{ $user->email }}</h6>

      <p class="card-text">{{ $user->bio ?? '自己紹介は未設定です。' }}</p>

      @if ($user->avatar)
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="アバター" class="img-thumbnail" style="max-width: 150px;">
      @else
        <p>アバターは未設定です。</p>
      @endif

      <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mt-3">プロフィール編集</a>
    </div>
  </div>
</div>
@endsection
