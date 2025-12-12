<div class="max-w-3xl mx-auto space-y-6">

    <header class="space-y-3 border-b border-slate-300 pb-6">
        <p class="text-[11px] uppercase tracking-[0.25em] text-slate-500">
            Article • {{ $article->created_at->format('d F Y') }} • {{ $article->views }} vues
        </p>
        <h1 class="text-3xl md:text-4xl font-semibold leading-tight">
            {{ $article->title }}
        </h1>
    </header>

    @if($article->image)
        <div class="rounded-[22px] overflow-hidden border border-slate-200 bg-slate-100">
            <img
                src="{{ asset('storage/'.$article->image) }}"
                alt="Image de {{ $article->title }}"
                class="w-full h-[320px] md:h-[380px] object-cover"
            >
        </div>
    @endif

    {{-- Contenu --}}
    <section class="bg-white border border-slate-200 rounded-[22px] p-6 leading-relaxed text-[15px] text-slate-800">
        {!! nl2br(e($article->body)) !!}
    </section>

    <footer class="pt-4 border-t border-dashed border-slate-300 flex items-center justify-between text-[11px] text-slate-500 uppercase tracking-[0.25em]">
    <span>Mini Blog</span>

    <div class="flex items-center gap-4">
        <button
            wire:click="like"
            class="inline-flex items-center gap-2 text-[11px] tracking-[0.2em] uppercase hover:text-red-500 transition"
            type="button"
        >
            <span class="@if($article->likes > 0) text-red-500 @else text-slate-400 @endif text-lg leading-none">
                ❤️
            </span>
            <span>{{ $article->likes }}</span>
        </button>

        <a href="{{ route('home') }}" class="hover:text-slate-800">
            ← Retour aux articles
        </a>
    </div>
    </footer>

</div>