@props(['name', 'price'])

<div class="w-full">
    @if (auth()->user()->subscribed($name))
        @if (auth()->user()->subscribedToPrice($price, $name))
            <button 
                class="font-bold bg-red-600 hover:bg-red-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                Cancelar
            </button>   
        @else
            <button 
                class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
                Cambiar de plan
            </button>
        @endif   
    @else
        <button wire:click="newSubscription('{{ $name }}', '{{ $price }}')"
            wire:loading.remove
            wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full flex items-center justify-center">
            Subcribirse
        </button>

        <button wire:loading.flex
            wire:target="newSubscription('{{ $name }}', '{{ $price }}')"
            class="font-bold bg-gray-600 hover:bg-gray-700 text-white rounded-md px-10 py-2 transition-colors w-full items-center justify-center">
            <x-spinner size=6 class="mr-2" />
            Subcribirse
        </button>
    @endif
</div>