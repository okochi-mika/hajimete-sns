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
   <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

   <form action="{{ route('posts.update', $post) }}" method="POST">
       @csrf
       @method('PATCH')
       <div class="form-group mb-3">
           <label for="title">タイトル</label>
           <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
       </div>
       <div class="form-group mb-3">
           <label for="content">本文</label>
           <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
       </div>

       <!-- ② 画像アップロード欄を追加！ -->
       <div class="form-group mb-3">
           <label for="image">画像</label>
           <input type="file" class="form-control" id="image" name="image">
       </div>

       <button type="submit" class="btn btn-outline-primary">更新</button>
   </form>
@endsection