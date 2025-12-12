<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ShowArticle extends Component
{
    public Article $article;

    public function mount($slug)
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();
        $this->article->incrementViews();
    }

    public function like()
    {   
        $this->article->increment('likes');
        $this->article->refresh();
    }

    public function render()
    {
        return view('public.show', [
        'article' => $this->article
        ])->layout('layouts.app');
    }
}