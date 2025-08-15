{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container profile-wrapper my-4">
    <h2 class="mb-4 profile-title">プロフィール編集</h2>

    <div class="mx-auto" style="width: 60%;"> {{-- 中央寄せ＆幅指定 --}}
        <div class="card mb-4 p-3 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- 名前 --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fs-4 fw-bold">名前</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 自己紹介 --}}
                    <div class="mb-3">
                        <label for="bio" class="form-label fs-5 fw-bold">自己紹介</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- アバター画像 --}}
                    <div class="mb-3">
                        <label for="avatar" class="form-label fs-5 fw-bold">プロフィール画像</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>

                                        {{-- ボタン --}}
                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary me-1 shadow">更新</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary shadow">保存</a>
                    </div>
                </form>
            </div> {{-- card-body --}}
        </div> {{-- card --}}
    </div> {{-- mx-auto --}}
</div>
@endsection
