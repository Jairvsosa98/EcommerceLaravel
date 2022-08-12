<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        {{-- Color --}}
        <div class="mb-6">
            <x-jet-label>
                Color
            </x-jet-label>
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" value="{{ $color->id }}" wire:model.defer="color_id">

                        <span class="ml-2 text-gray-700 capitalize">{{ __($color->name) }}</span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id" />
        </div>
        {{-- Cantidad --}}
        <div>
            <x-jet-label>
                Cantidad
            </x-jet-label>

            <x-jet-input class="w-full" name="quantity" type="number" min="1" placeholder="Ingrese una cantidad"
                wire:model.defer="quantity" />
            <x-jet-input-error for="quantity" />
        </div>

        <div class="flex justify-end items-center mt-4">

            <x-jet-action-message class="mr-3" on="saved">
                Agregado
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                Agregar
            </x-jet-button>
        </div>
    </div>

    @if ($product_colors->count())
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_colors as $product_color)
                        <tr wire:key="product_color-{{ $product_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($product_color->pivot->color_id)->name) }}
                            </td>
                            <td>
                                {{ $product_color->pivot->quantity }} Unidades

                            </td>
                            <td class="p-4 py-2 flex">
                                <x-jet-button class="ml-auto mr-2"
                                    wire:click="edit({{ $product_color->pivot->id }})" wire:loading.attr="disabled"
                                    wire:target="edit({{ $product_color->pivot->id }})">
                                    Actualizar
                                    </x-jet-secondary-button>
                                    <x-jet-danger-button
                                        wire:click="$emit('deletePivot',{{ $product_color->pivot->id }})">
                                        Eliminar
                                    </x-jet-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Editar Colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Color</x-jet-label>

                <select class="w-full form-control" wire:model="pivot_color_id">
                    <option value="">Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ ucfirst(__($color->name)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input wire:model="pivot_quantity" class="w-full" type="number"
                    placeholder="Ingrese una cantidad" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="ml-auto mr-2" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
