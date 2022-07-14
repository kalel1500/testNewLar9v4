<div class="bg-gray-50 py-3 px-10 rounded grid gap-2">
    <input wire:model="search" type="search" placeholder="Search posts by title..." class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
 
    <h1 class="font-bold">Search Results:</h1>
 
    <div class="grid grid-cols-5 gap-4">
        @forelse($posts as $post)
            <div class="shadow bg-gray-300" wire:loading.class.delay="opacity-50">
                <div class="font-bold underline">{{ $post->title }}</div>
                <div>{{ str($post->content)->limit(100) }}</div>
            </div>
        @empty
            <div>No hay resultados</div>
        @endforelse
    </div>
    
    <div>
        {{ $posts->links() }}
    </div>
</div>