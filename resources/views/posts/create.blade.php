@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h3 class="mb-4">投稿詳細</h3>

    <!-- 戻るリンク -->
    <div class="mb-4">
        <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
    </div>

    <!-- フォームをカード風に中央寄せ -->
    <div class="mx-auto" style="width: 60%";>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group mb-3">
                <label for="content">本文</label>
                <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="image">画像</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-outline-primary shadow">投稿</button>
        </form>
    </div>
</div>
@endsection
