@extends('layouts.app')


@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center fw-bold">ブックマークした投稿</h2>

    @if ($bookmarkedPosts->isEmpty())
        <p class="text-center text-muted">まだブックマークした投稿はありません。</p>
    @else
        @foreach ($bookmarkedPosts as $post)
            <div class="card mb-4 shadow-sm mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    {{-- 投稿タイトル（クリックで詳細ページへ） --}}
                    <h5 class="card-title fw-bold">
                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none link-dark">
                            {{ $post->title }}
                        </a>
                    </h5>

                    {{-- 本文の一部 --}}
                    <p class="card-text text-muted">{{ Str::limit($post->content, 80) }}</p>

                    {{-- 画像 --}}
                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-fluid mb-2 rounded" style="max-width: 100%;">
                    @endif

                    {{-- 投稿日時 --}}
                    <p class="text-secondary small mb-3">投稿日時：{{ $post->created_at->format('Y/m/d H:i') }}</p>

                    {{-- 詳細ボタン --}}
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary shadow-sm">
                        詳細を見る
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
