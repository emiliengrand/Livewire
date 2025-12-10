<div>
  <div class="space-y-4">
    @foreach($articles as $article)
      <div class="p-3 bg-white rounded shadow">
        <div class="flex justify-between">
          <div>
            <a href="{{ route('article.show', $article->slug) }}" class="font-medium">{{ $article->title }}</a>
            <div class="text-xs text-gray-500">{{ $article->created_at->format('Y-m-d') }}</div>
          </div>
          <div class="text-sm text-gray-500">{{ $article->views }} vues</div>
        </div>
      </div>
    @endforeach
  </div>
</div>
