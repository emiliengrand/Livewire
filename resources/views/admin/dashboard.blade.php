<div class="max-w-4xl mx-auto space-y-8">

    <h1 class="text-2xl font-semibold mb-2">Administration des articles</h1>

    @if (session()->has('message'))
        <div class="p-3 bg-green-100 text-green-800 rounded text-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100">
        <h2 class="text-lg font-semibold mb-4">
            @if($articleId) Modifier l’article @else Nouvel article @endif
        </h2>

        <form wire:submit.prevent="save" class="space-y-4">

            <div>
                <label class="block text-sm font-medium mb-1">Titre</label>
                <input
                    type="text"
                    wire:model="title"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('title')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Contenu</label>
                <textarea
                    wire:model="body"
                    rows="6"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                @error('body')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Image (optionnelle)</label>
                <input type="file" wire:model="image" class="text-sm">
                @error('image')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700"
                >
                    @if ($articleId)
                        Mettre à jour l’article
                    @else
                        Publier l’article
                    @endif
                </button>
            </div>

        </form>
    </div>

    {{-- Liste --}}
    <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100">
        <h2 class="text-lg font-semibold mb-3">Articles existants</h2>

        @if($articles->count() === 0)
            <p class="text-sm text-slate-500">Aucun article pour le moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Titre</th>
                            <th class="text-left py-2">Date</th>
                            <th class="text-left py-2">Vues</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="border-b last:border-0">
                                <td class="py-2">{{ $article->title }}</td>
                                <td class="py-2">{{ $article->created_at->format('d/m/Y') }}</td>
                                <td class="py-2">{{ $article->views }}</td>
                                <td class="py-2 space-x-2">
                                    <button
                                        type="button"
                                        wire:click="edit({{ $article->id }})"
                                        class="px-2 py-1 text-xs bg-yellow-500 text-white rounded"
                                    >
                                        Éditer
                                    </button>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $article->id }})"
                                        class="px-2 py-1 text-xs bg-red-600 text-white rounded"
                                    >
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>