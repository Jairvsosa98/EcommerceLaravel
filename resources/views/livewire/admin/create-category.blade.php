<div>
    {{-- Formulario Crear categoría --}}
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear Nueva Categoría
        </x-slot>
        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva categoría
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input wire:model="createForm.name" class="w-full mt-1" type="text" />
                <x-jet-input-error for="createForm.name" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input wire:model="createForm.slug" class="w-full mt-1 bg-gray-100" type="text" disabled />
                <x-jet-input-error for="createForm.slug" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Ícono
                </x-jet-label>
                <x-jet-input wire:model.defer="createForm.icon" class="w-full mt-1" type="text" />
                <x-jet-input-error for="createForm.icon" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Marcas
                </x-jet-label>
                <div class="grid grid-cols-4">
                    @foreach ($brands as $brand)
                    <x-jet-label>
                        <x-jet-checkbox wire:model.defer="createForm.brands" name="brands[]" value="{{ $brand->id }}" />
                        {{ $brand->name }}
                    </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createForm.brands" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen
                </x-jet-label>
                <x-jet-input accept="image/*" wire:model="createForm.image" class="mt-1" type="file" id="{{ $rand }}" />

                <x-jet-input-error for="createForm.image" />
            </div>

        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Categoría creada
            </x-jet-action-message>
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    {{-- Listado de las categorías --}}
    <x-jet-action-section>
        <x-slot name="title">
            Lista de Categorías
        </x-slot>
        <x-slot name="description">
            Aquí encontrará todas las categorias
        </x-slot>
        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)
                    <tr>
                        <td class="py-2">
                            <span class="inline-block w-8 text-center mr-2">
                                {!! $category->icon !!}
                            </span>
                            <a href="{{ route('admin.categories.show',$category) }}" class="uppercase underline hover:text-blue-600">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td class="py-2">
                            <div class="flex divide-x divide-gray-300 font-semibold">
                                <a wire:click="edit( '{{$category->slug}}')"
                                    class="pr-2 hover:text-green-600 cursor-pointer">Editar</a>
                                <a wire:click="$emit('deleteCategory', '{{$category->slug}}')"
                                    class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>
    {{-- Modal para editar las categorías --}}
    <x-jet-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar Categoría
        </x-slot>
        <x-slot name="content">
            <div class="space-y-3">

                <div>
                    @if ($editImage)
                    <img class="w-full h-64 object-cover object-center" src="{{ $editImage->temporaryUrl() }}" alt=""> 
                    @else
                    <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editForm['image']) }}" alt="">
                    @endif
                </div>
                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model="editForm.name" class="w-full mt-1" type="text" />
                    <x-jet-input-error for="editForm.name" />
                </div>
                <div>
                    <x-jet-label>
                        Slug
                    </x-jet-label>
                    <x-jet-input wire:model="editForm.slug" class="w-full mt-1 bg-gray-100" type="text" disabled />
                    <x-jet-input-error for="editForm.slug" />
                </div>
                <div>
                    <x-jet-label>
                        Ícono
                    </x-jet-label>
                    <x-jet-input wire:model.defer="editForm.icon" class="w-full mt-1" type="text" />
                    <x-jet-input-error for="editForm.icon" />
                </div>
                <div>
                    <x-jet-label>
                        Marcas
                    </x-jet-label>
                    <div class="grid grid-cols-4">
                        @foreach ($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox wire:model.defer="editForm.brands" name="brands[]"
                                value="{{ $brand->id }}" />
                            {{ $brand->name }}
                        </x-jet-label>
                        @endforeach
                    </div>
                    <x-jet-input-error for="editForm.brands" />
                </div>
                <div>
                    <x-jet-label>
                        Imagen
                    </x-jet-label>
                    <x-jet-input accept="image/*" wire:model="editImage" class="mt-1" type="file" id="{{ $rand }}" />

                    <x-jet-input-error for="editImage" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>