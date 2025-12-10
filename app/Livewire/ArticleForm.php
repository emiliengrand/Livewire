<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Article;

class ArticleForm extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $body;
    public $image;
    public $articleId = null;

    protected $rules = [
        'title' => 'required|min:3',
        'body'  => 'required|min:10',
        'image' => 'nullable|image|max:1024',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body'  => $this->body,
        ];

        if ($this->image) {
            $path = $this->image->store('articles', 'public');
            $data['image'] = $path;
        }

        Article::updateOrCreate(
            ['id' => $this->articleId],
            $data
        );

        session()->flash('message', 'Article enregistré.');

        // On remet le formulaire à zéro
        $this->reset(['title', 'body', 'image', 'articleId']);

        // On repart sur la première page de la liste
        $this->resetPage();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $this->articleId = $article->id;
        $this->title     = $article->title;
        $this->body      = $article->body;
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        session()->flash('message', 'Article supprimé.');

        $this->resetPage();
    }

    public function render()
    {
        $articles = Article::latest()->paginate(10);

        return view('admin.dashboard', [
            'articles' => $articles,
        ])->layout('layouts.app');
    }
}