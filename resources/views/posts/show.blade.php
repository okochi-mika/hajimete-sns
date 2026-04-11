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
            @if ($post->video)
                <video src="{{ asset('storage/' . $post->video) }}"
                class="mb-3"
                style="max-width: 500px; width: 100%;"
                controls
                loop>
            </video>
            @endif

            {{-- 音声表示 --}}
            @if ($post->audio)
                <audio src="{{ asset('storage/' . $post->audio) }}"
                class="mb-2"
                style="max-width: 500px; width: 100%;"
                controls
                loop>
            </audio>
            @endif

            {{-- URL込み投稿 --}}
            @if ($post->url)
            <div class="mt-3">
                <a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer">
            🔗 参考リンクを見る
                </a>
            </div>
            @endif



               <p class="card-text">{!! nl2br(e($post->content)) !!}</p>
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

               <hr> {{-- ← ここで区切るのおすすめ✨ --}}
               
            {{-- コメント一覧表示 --}}
            <h5 class="mt-4">コメント</h5>
               @foreach ($post->comments as $comment)
               <div class="border p-2 mt-2">
                {!! nl2br(e($comment->content)) !!}
               </div>
               @endforeach

            {{-- コメント投稿フォーム --}}
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <textarea name="content" class="form-control"></textarea>
                {{-- どの投稿に対するコメントか送る --}}
                <button type="submit">コメントする</button>
            </form>
        
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror


            @foreach ($post->comments as $comment)
    <div class="border p-2 mb-2">
        <p>{{ $comment->content }}</p>

        {{-- 自分のコメントだけ削除ボタン表示 --}}
        @if ($comment->user_id === auth()->id())
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('削除しますか？');">
                @csrf
                @method('DELETE')
                <button class="tn btn-outline-danger shadow">削除</button>
            </form>
        @endif
    </div>
@endforeach
            
           </div>
       </div>
   </article>
@endsection