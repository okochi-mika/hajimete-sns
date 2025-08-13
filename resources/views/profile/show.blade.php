{{-- resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', 'プロフィール情報')

@section('content')
<div class="container profile-wrapper my-4">
    <h2 class="mb-4 profile-title">プロフィール情報</h2>

    <div class="mx-auto" style="width: 60%;"> {{-- 中央寄せ＆幅指定 --}}
        <div class="card mb-4 p-3 shadow">
            <div class="card-body">
                {{-- 名前 --}}
                <p class="fs-4"><strong>名前：</strong> {{ $user->name }}</p>

                {{-- 自己紹介 --}}
                <p class="fs-5"><strong>自己紹介：</strong></p>
                <pre class="fs-6 bio-text">{{ $user->bio }}</pre>

                {{-- 編集ボタンと戻るリンク --}}
                <div class="mt-3">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary me-2 shadow">編集</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-link text-decoration-none">戻る</a>
                </div>

                {{-- 更新完了メッセージ --}}
                @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
            </div> {{-- card-body --}}
        </div> {{-- card --}}
    </div> {{-- mx-auto --}}
</div>
@endsection
