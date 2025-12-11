<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;

class ArticleList extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    // reset la page quand on change la recherche MAIS CA MARCHE PAS !!!!!!!!!!!!!!!!!!
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::query()
            ->when($this->search, function ($q) {
                $term = '%' . $this->search . '%';

                return $q->where(function ($sub) use ($term) {
                    $sub->where('title', 'like', $term)
                        ->orWhere('body', 'like', $term);
                });
            })
            ->latest()
            ->paginate(6);

        return view('public.index', [
            'articles' => $articles,
        ])->layout('layouts.app');
    }
}