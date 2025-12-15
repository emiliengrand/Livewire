<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','body','image','views','likes'];

    protected static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'article_user_likes')->withTimestamps();
    }
}