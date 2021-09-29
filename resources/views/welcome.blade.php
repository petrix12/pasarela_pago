<x-app-layout>
    <div class="container py-10">
        <div class="grid grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="card">
                    <div class="px-4 py-2 bg-gray-200 flex justify-between items-center">
                        <p class="text-gray-500 font-bold text-xl">{{ $product->price }} USD</p>
                        <a href="{{ route('products.pay', $product) }}" class="btn btn-primary">Comprar</a>
                    </div>
                    <img class="h-56 w-full object-cover" src="{{Storage::url($product->image)}}" alt="Imagen del producto">
                    <div class="card-body">
                        <h1 class="text-gray-900 font-bold text-xl uppercase">{{ $product->title }}</h1>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 150) }}</p>
                    </div>
                </div>
            @endforeach
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>