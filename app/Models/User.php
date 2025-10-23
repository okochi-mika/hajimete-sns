<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',   // ここがないと更新できない
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
     // 1人のユーザーは複数の投稿を作成できる
    public function posts()
     {
        return $this->hasMany(Post::class);
     }

     public function profileExists()
     {
    // 例: 自己紹介かアイコンのどちらかがあればプロフィールありと判断
    return !empty($this->bio) || !empty($this->avatar);
     }

    // User.php
    public function bookmarks()
    {
    return $this->hasMany(Bookmark::class);
    }

    public function bookmarkedPosts()
    {
    return $this->belongsToMany(Post::class, 'bookmarks');
    }

}
