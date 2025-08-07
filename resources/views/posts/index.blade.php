@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
   @if (session('flash_message'))
       <p class="text-success">{{ session('flash_message') }}</p>
   @endif

   @if (session('error_message'))
       <p class="text-danger">{{ session('error_message') }}</p>
   @endif

   <div class="mb-2">
       <a href="{{ route('posts.create') }}" class="text-decoration-none link-custom">新規投稿</a>
   </div>

      <div class="mb-2">
       <a href="{{ route('profile.show') }}" class="btn btn-primary mb-3">プロフィールを見る</a>
   </div>

   @if($posts->isNotEmpty())
       @foreach($posts as $post)
           <article>
               <div class="card mb-3">
                   <div class="card-body">
                       <h2 class="card-title fs-5">{{ $post->title }}</h2>

                       {{-- 画像表示 --}}
                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-fluid mb-2" style="max-width: 300px;">
                @endif
                       <p class="card-text">{{ $post->content }}</p>
                       <p>更新日時：{{ $post->updated_at }}</p>

                       <div class="d-flex">
                           <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary d-block me-1">詳細</a>
                           <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary d-block me-1">編集</a>

                           <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                               @csrf
                               @method('DELETE')
                               <button type="submit" class="btn btn-outline-danger">削除</button>
                           </form>
                       </div>
                   </div>
               </div>
           </article>
       @endforeach
   @else
       <p>投稿はありません。</p>
   @endif
@endsection