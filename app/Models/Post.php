<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 追加！どのカラムをまとめて保存していいか指定
    protected $fillable = [
        'title',
        'content',
        'user_id' // ← もし一緒に保存してるならこれも必要！
    ];

    // 1つの投稿は1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
