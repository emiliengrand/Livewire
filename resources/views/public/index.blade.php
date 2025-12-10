<div class="space-y-10">

    <section class="text-center space-y-4">
        <p class="text-[11px] tracking-[0.25em] uppercase text-slate-500">Édition {{ date('Y') }}</p>
        <h1 class="text-6xl md:text-7xl font-semibold tracking-[0.35em] leading-none">
            BLOG<br class="hidden md:block"> MAGAZINE
        </h1>
        <p class="text-sm text-slate-600 max-w-xl mx-auto mt-3">
            Une sélection d’articles pas ouf à une fréquence plus que non régulière.
        </p>
    </section>

    {{-- Filtres / recherche --}}
    <section class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-y border-slate-300 py-4 text-[11px] uppercase tracking-[0.25em]">
        <div class="flex items-center gap-4">
            <span class="text-slate-500">Recherche</span>
            <input
                type="text"
                wire:model.live="search"
                placeholder="Titre de l’article…"
                class="text-[12px] normal-case tracking-normal border border-slate-300 rounded-full px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-slate-900/80"
            >
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <span class="text-slate-500">Catégories</span>
            <button type="button" class="px-3 py-1 rounded-full border border-slate-900 text-[11px]">
                Tous
            </button>
        </div>
    </section>

    @if($articles->count() === 0)
        <p class="text-sm text-slate-500 mt-6">Aucun article trouvé pour cette recherche.</p>
    @else
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach($articles as $article)
                <article class="bg-white border border-slate-200 rounded-[18px] overflow-hidden flex flex-col hover:shadow-md transition-shadow duration-150">
                    @if($article->image)
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden">
                            <img
                                src="{{ asset('storage/'.$article->image) }}"
                                alt="Image de {{ $article->title }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                    @else
                        <div class="aspect-[4/3] bg-slate-100 flex items-center justify-center text-xs text-slate-400 tracking-[0.25em] uppercase">
                            Sans image
                        </div>
                    @endif

                    <div class="px-5 pt-4 pb-5 flex-1 flex flex-col gap-3">
                        <div class="flex items-center justify-between text-[11px] text-slate-500 uppercase tracking-[0.22em]">
                            <span>{{ $article->created_at->format('d F Y') }}</span>
                            <span>{{ $article->views }} vues</span>
                        </div>

                        <h2 class="text-[17px] font-semibold leading-snug">
                            <a href="{{ route('article.show', $article->slug) }}" class="hover:underline">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="text-[13px] text-slate-600 flex-1 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($article->body, 140) }}
                        </p>

                        <div class="mt-1">
                            <a
                                href="{{ route('article.show', $article->slug) }}"
                                class="inline-flex items-center text-[11px] uppercase tracking-[0.25em] text-slate-900"
                            >
                                Lire plus
                                <span class="ml-2 text-[10px]">→</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="mt-10 flex justify-center">
            {{ $articles->links() }}
        </div>
    @endif

</div>