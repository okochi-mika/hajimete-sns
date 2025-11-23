@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')
   @if (session('flash_message'))
       <p class="text-success">{{ session('flash_message') }}</p>
   @endif

   <article>
    <div class="container m-4">
       <div class="mx-auto" style="width: 60%;">
       <div class="card mb-4 p-3 shadow">
           <div class="card-body">
               <h2 class="fs-4 fw-bold mb-3">{{ $post->title }}</h2>

               {{-- 画像表示 --}}
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-fluid mb-2" style="max-width: 300px;">  
            @endif

            {{-- 動画表示 --}}
            @if ($post->videos_path)
                <video src="{{ asset('storage/' . $post->video_path) }}"
                class="mb-3"
                style="max-width: 500px; width: 100%;"
                controls
                loop>
    </video>
@endif


               <p class="card-text">{{ $post->content }}</p>
               <p class="post-dates">投稿日時：{{ $post->created_at->format('Y-m-d H:i') }} （{{ $post->created_at->diffForHumans() }}）</p>
               <p class="post-dates">更新日時：{{ $post->updated_at->format('Y-m-d H:i') }} （{{ $post->updated_at->diffForHumans() }}）</p>
               @if ($post->user_id === Auth::id())
                   <div class="d-flex">
                       <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary d-block me-1 shadow">編集</a>
                       <a href="{{ route('posts.index') }}" class="btn btn btn-outline-secondary shadow me-1">保存</a>

                       <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-outline-danger shadow">削除</button>
                       </form>
                   </div>
               @endif
           </div>
       </div>
   </article>
@endsection