<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Categoría --}}
        <div>
            <x-jet-label value="Categorias" />
            <select class="w-full form-control" wire:model="category_id">
                <option selected disabled value="">Seleccione una categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <x-jet-input-error for="category_id" />
        </div>
        {{-- SubCategoría --}}
        <div>
            <x-jet-label value="Subcategorías" />
            <select class="w-full form-control" wire:model="subcategory_id">
                <option selected disabled value="">Seleccione una subcategoría</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="subcategory_id" />
        </div>
    </div>
    {{-- Nombre --}}
    <div class="mb-4">
        <x-jet-label velue="Nombre" />
        <x-jet-input wire:model="name" class="w-full" type="text" placeholder="Ingrese el nombre del producto" />
        <x-jet-input-error for="name" />
    </div>

    {{-- Slug --}}
    <div class="mb-4">
        <x-jet-label velue="Slug" />
        <x-jet-input wire:model="slug" disabled class="w-full bg-gray-200" type="text"
            placeholder="Ingrese el slug del producto" />
        <x-jet-input-error for="slug" />
    </div>

    {{-- Descripcion --}}
    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea class="w-full form-control" rows="4" wire:model="description" x-data x-init="ClassicEditor
                .create($refs.miEditor)
                .then(function(editor) {
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData())
                    })
                })
                .catch(error => {
                    console.error(error);
                });"
                x-ref="miEditor"></textarea>
        </div>
        <x-jet-input-error for="description" />

    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        {{-- Marca --}}
        <div>
            <x-jet-label value="Marca" />
            <select wire:model="brand_id" class="form-control w-full">
                <option selected disabled value="">Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="brand_id" />
        </div>
        <div>
            {{-- Precio --}}
            <x-jet-label value="Precio" />
            <x-jet-input min="1" step="0.001" class="w-full" type="number" wire:model="price" />
            <x-jet-input-error for="price" />
        </div>
    </div>

    @if ($subcategory_id)
        @if (!$this->subcategory->color && !$this->subcategory->size)
            <div>
                {{-- Cantidad --}}
                <x-jet-label value="Cantidad" />
                <x-jet-input min="1" class="w-full" type="number" wire:model="quantity" />
                <x-jet-input-error for="quantity" />
            </div>
        @endif
    @endif

    <div class="flex mt-4">
        <x-jet-button class="ml-auto"
                      wire:loading.attr="disabled"
                      wire:target="save"
                      wire:click="save">
            Crear Producto
        </x-jet-button>
    </div>
</div>
