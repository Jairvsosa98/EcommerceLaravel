<x-app-layout>
    <div class="container py-8">
        <ul>
            @forelse ($products as $product)
                <x-product-list :product="$product" />
            @empty
                <li class="bg-white rounded-lg shadow-2xl ">
                    <div class="p-4">
                        <p class="font-semibold text-gray-700">Ningún producto coincide con tu búsqueda</p>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
