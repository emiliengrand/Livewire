<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ShowArticle extends Component
{
    public Article $article;
    public bool $hasLiked = false;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();
        $this->article->incrementViews();

        if (Auth::check()) {
            $this->hasLiked = $this->article
                ->likedByUsers()
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->hasLiked) {
            $this->article->likedByUsers()->detach(Auth::id());

            if ($this->article->likes > 0) {
                $this->article->decrement('likes');
            }

            $this->hasLiked = false;
        } else {
            $this->article->likedByUsers()->syncWithoutDetaching([Auth::id()]);
            $this->article->increment('likes');

            $this->hasLiked = true;
        }

        $this->article->refresh();
    }

    public function render()
    {
        return view('public.show', [
            'article' => $this->article,
        ])->layout('layouts.app');
    }
}