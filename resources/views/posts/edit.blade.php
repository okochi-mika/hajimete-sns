@extends('layouts.app')

@section('title', '投稿編集')

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

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mx-auto" style="width: 60%;">
            <div class="card mb-4 p-3 shadow">
                <div class="card-body">

                    <!-- タイトル -->
                    <div class="form-group mb-3">
                        <label for="title" class="form-label fs-4 fw-bold">タイトル</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title', $post->title) }}">
                    </div>

                    <!-- 本文 -->
                    <div class="form-group mb-3">
                        <label for="content" class="form-label fs-5 fw-bold">本文</label>
                        <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
                    </div>

                    <!-- 画像アップロード -->
                    <div class="form-group mb-3">
                        <label for="image" class="form-label fs-5 fw-bold">画像</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <!-- 常に remove_image を送信（0:削除しない, 1:削除する） -->
                    <input type="hidden" name="remove_image" value="0">

                    @if ($post->image_path)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" width="200">
                            <div class="mt-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove_image" value="1">
                                    画像を削除する
                                </label>
                            </div>
                        </div>
                    @endif

                    

                    <!-- 更新ボタン -->
                    <button type="submit" class="btn btn-outline-primary shadow me-1">更新</button>

                </div>
            </div>
        </div>
    </form>
@endsection
