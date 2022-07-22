<div class="bg-purple-500 py-3 px-10 rounded max-w-4xl grid gap-1 font-bold text-white text-lg">
    <div class="flex items-center">
        <div>Sumar:</div>
        <button wire:click="increment" class="py-1 px-5 mx-2 text-indigo-100 duration-150 bg-indigo-700 rounded-lg hover:bg-indigo-800 active:ring active:transform active:translate-y-1 transition-all cursor-default">+</button>
    </div>
    <h1 class="text-4xl">{{ $count }}</h1>

    <hr class="my-5">

    <div class="text-black">
        <input wire:model="text">
        <div>{{ $text }}</div>
    </div>

</div>
