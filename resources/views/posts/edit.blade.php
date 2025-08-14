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

   <div class="mb-2">
       <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
   </div>

   <!-- ① enctypeを追加！ -->
<form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mx-auto" style="width: 60%;">
        <div class="card mb-4 p-3 shadow">
            <div class="card-body">
        <div class="form-group mb-3">
        <label for="title" class="form-label fs-4 fw-bold">タイトル</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
    </div>

    <div class="form-group mb-3">
        <label for="content" class="form-label fs-5 fw-bold">本文</label>
        <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
    </div>
    
	<!-- ② 画像アップロード欄を追加！ -->
    <div class="form-group mb-3">
        <label for="image" class="form-label fs-5 fw-bold">画像</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    @if ($post->image_path)
    <div>
        <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" width="200">
        <div>
            <label>
                <input type="checkbox" name="remove_image" value="1">
                画像を削除する
            </label>
        </div>
    </div>
</div>
</div>
@endif

    <a href="{{ route('posts.index') }}" class="btn btn btn btn-outline-primary shadow me-1">更新</a>
</form>

@endsection