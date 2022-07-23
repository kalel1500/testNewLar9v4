<div class="bg-purple-500 py-3 px-10 my-2 rounded max-w-4xl grid gap-1 font-bold text-white">
    <div class="flex items-center">
        <div>Sumar:</div>
        <button 
            wire:click="increment" 
            wire:loading.attr="disabled" 
            wire:loading.class="bg-gray-300 hover:bg-gray-300" 
            wire:loading.class.remove="active:ring active:transform active:translate-y-1" 
            wire:target="increment, decrease"
            class="py-1 px-5 mx-2 text-indigo-100 duration-150 bg-indigo-700 rounded-lg hover:bg-indigo-800 active:ring active:transform active:translate-y-1 transition-all cursor-default"
            >+</button>
    </div>
    <div class="flex items-center">
        <div>Restar:</div>
        <button 
            wire:click="decrease" 
            wire:loading.attr="disabled" 
            wire:loading.class="bg-gray-300 hover:bg-gray-300" 
            wire:loading.class.remove="active:ring active:transform active:translate-y-1" 
            wire:target="increment, decrease"
            class="py-1 px-5 mx-2 text-indigo-100 duration-150 bg-indigo-700 rounded-lg hover:bg-indigo-800 active:ring active:transform active:translate-y-1 transition-all cursor-default"
            >-</button>
    </div>

    <h1 class="text-4xl">{{ $count }}</h1>
    <span>{{ $errorMessage }}</span>

    <hr class="my-5">

    <div class="text-black">
        {{-- wire:dirty.class -> le pone la clase mientras el valor del front sea diferente del back (ver con conexion lenta) --}}
        <input wire:dirty.class="bg-red-500" wire:model.delay="text">
        <div>{{ $text }}</div>
        <div wire:loading wire:target="text">
            Escribiendo...
        </div>
    </div>

    <div wire:offline>
        You are now offline.
    </div>

</div>
