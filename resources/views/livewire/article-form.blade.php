<div class="bg-white p-4 rounded shadow">
    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
            @error('title')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contenu</label>
            <textarea wire:model="body" class="w-full border rounded p-2" rows="6"></textarea>
            @error('body')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Publier
        </button>
    </form>
</div>