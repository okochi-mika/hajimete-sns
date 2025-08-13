@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
   @if (session('flash_message'))
       <p class="text-success">{{ session('flash_message') }}</p>
   @endif

   @if (session('error_message'))
       <p class="text-danger">{{ session('error_message') }}</p>
   @endif

   <div class="mx-auto" style="width: 40%;">
   <div class="mb-2">
       <a href="{{ route('posts.create') }}" class="fs-4 text-decoration-none link-custom shadow">新規投稿</a>

   </div>
   </div>

   @if($posts->isNotEmpty())
       @foreach($posts as $post)
           <article>
            <div class="container m-4">
                <div class="mx-auto" style="width: 60%;">
                <div class="card mb-4 p-3 shadow">
                   <div class="card-body">
                    <!-- タイトル -->
                       <h2 class="fs-4 fw-bold mb-3">{{ $post->title }}</h2>
                       <!-- 本文 -->
                       <p class="fs-6 text-secondary">{{ $post->content }}</p>

                       {{-- 画像表示 --}}
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-fluid mb-2" style="max-width: 300px;">
                @endif
                    <div class="text-muted mt-3">
                       <p class="fs-7 post-dates">投稿日時：{{ $post->created_at->format('Y-m-d H:i') }} （{{ $post->created_at->diffForHumans() }}）</p>

                       <div class="d-flex">
                           <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary d-block me-1 shadow">詳細</a>
                           <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary d-block me-1 shadow">編集</a>

                           <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-outline-danger shadow">削除</button>
                           </form>
                       </div>
                   </div>
               </div>
              </div>
           </div>
           </article>
       @endforeach
   @else
       <p>投稿はありません。</p>
   @endif
@endsection