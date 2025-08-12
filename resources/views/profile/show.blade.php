@extends('layouts.app')

@section('title', 'プロフィール情報')

@section('content')
{{-- resources/views/profile/show.blade.php --}}
<div class="container profile-wrapper my-4">
    <h2 class="mb-4 profile-title">プロフィール情報</h2>

    {{-- 名前 --}}
    <p><strong>名前：</strong> {{ $user->name }}</p>

    {{-- 自己紹介 --}}
    <p><strong>自己紹介：</strong></p>
    <pre class="bio-text">{{ $user->bio }}</pre>

    {{-- 編集ボタン --}}
    <a href="{{ route('profile.edit') }}" class="btn btn-primary shadow">編集</a>

    {{-- 更新完了メッセージ --}}
    @if (session('status'))
        <div class="alert alert-success mt-3">
            {{ session('status') }}
        </div>
    @endif
</div>

@endsection
