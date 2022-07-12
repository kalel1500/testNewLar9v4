<div class="bg-purple-500 py-3 px-10 rounded max-w-4xl grid gap-2 font-bold text-white text-lg">
    <div>Hooola</div>
    <button wire:click="increment" class="h-10 px-5 m-2 text-indigo-100 duration-150 bg-indigo-700 rounded-lg hover:bg-indigo-800 active:ring active:transform active:translate-y-1 transition-all cursor-default">+</button>
    <h1 class="text-5xl">{{ $count }}</h1>
</div>
