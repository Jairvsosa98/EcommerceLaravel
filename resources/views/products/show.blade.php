<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                        <li data-thumb="{{ Storage::url($image->url) }}">
                            <img src="{{ Storage::url($image->url) }}" />
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="-mt-10 text-gray-700">
                    <h2 class="font-bold text-lg">Descripción</h2>
                    {!! $product->description !!}
                </div>
                @can('review', $product)
                    <div class="text-gray-700 mt-4">
                        <h2 class="font-bold text-lg">Dejar reseña</h2>
                        <form action="{{ route('reviews.store', $product) }}" method="POST">
                            @csrf

                            <textarea name="comment" id="editor"></textarea>
                            <x-jet-input-error for="comment" />
                            <div class="flex items-center mt-2" x-data="{rating: 5}">
                                <p class="font-semibold mr-3">Puntaje:</p>
                                <ul class="flex space-x-2">
                                    <li x-bind:class="rating >= 1 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 1">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 2 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 2">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 3 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 3">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 4 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 4">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                    <li x-bind:class="rating >= 5 ? 'text-yellow-500' : ''">
                                        <button type="button" class="focus:outline-none" x-on:click="rating = 5">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </li>
                                </ul>
                                <input name="rating" class="hidden" type="number" x-model="rating" />
                                <x-jet-button class="ml-auto">
                                    Agregar reseña
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                @endcan

                @if ($product->reviews->isNotEmpty())
                    
                    {{-- Este producto tiene reseñas --}}
                    <div class="mt-6 text-gray-700">
                        <h2 class="font-bold text-lg">Reseñas</h2>

                        <div class="mt-2">
                            @foreach ($product->reviews as $review)
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full object-cover mr-4 " src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}">
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $review->user->name }}</p>
                                        <p class="text-sm">{{ $review->created_at->diffForHumans() }}</p>
                                        <div>
                                            {!!  $review->comment !!}
                                        </div>
                                    </div>
                                    <div>
                                        <p>
                                            {{ $review->rating }}
                                            <i class="fas fa-star text-yellow-500 cursor-pointer hover:text-yellow-400"></i>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endif
            </div>
            <div>
                <h1 class="text-xl font-bold text-trueGray-700">{{ $product->name }}</h1>

                <div class="flex">
                    <p class="text-trueGray-700">Marca: <a class="underline capitalize hover:text-emerald-500"
                            href="">{{ $product->brand->name }}</a></p>
                    <p class="text-trueGray-700 mx-6">{{ round($product->reviews->avg('rating'), 1) }} <i class="fas fa-star text-sm text-yellow-500"></i></p>
                    <a href="" class="text-cyan-500 underline hover:text-cyan-700">{{ $product->reviews->count() }} reseñas</a>
                </div>
                <p class="text-2xl font-semibold text-trueGray-700 my-4">USD {{ $product->price }}</p>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-lime-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-lime-600">Se hace envíos a todo el Perú</p>
                            <p>Recíbelo el <span>{{ Date::now()->addDay(7)->locale('es')->format('l j F') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                @if ($product->subcategory->size)
                @livewire('add-cart-item-size', ['product' => $product])
                @elseif($product->subcategory->color)
                @livewire('add-cart-item-color', ['product' => $product])
                @else
                @livewire('add-cart-item', ['product' => $product])
                @endif
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create( document.querySelector( '#editor' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            }).catch( error => {
                console.log( error );
            } );

    </script>
    <script>
        $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
    </script>
    @endpush
</x-app-layout>