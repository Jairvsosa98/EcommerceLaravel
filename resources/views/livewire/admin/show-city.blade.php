<div>
    <x-slot name="header">
        <h2 class="capitalize font-semibold text-xl text-gray-800 leading-tight">
            Ciudad {{ $city->name}}
        </h2>
    </x-slot>

    <div class="container py-12">
        {{-- Agregar Distrito --}}
        <x-jet-form-section submit="save" class="mb-6">
            <x-slot name="title">
                Agregar un nuevo distrito
            </x-slot>
            <x-slot name="description">
                Completar la información necesaria para poder agregar un nuevo distrito
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="createForm.name" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    distrito agregada
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        {{-- Mostrar Distritos --}}
        <x-jet-action-section>
            <x-slot name="title">
                Lista de Distritos
            </x-slot>
            <x-slot name="description">
                Aquí encontrará todas los distritos agregados
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
                        @foreach ($districts as $district)
                        <tr>
                            <td class="py-2">
                                {{ $district->name }}
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a wire:click="edit({{$district}})"
                                        class="pr-2 hover:text-green-600 cursor-pointer">Editar</a>
                                    <a wire:click="$emit('deleteDistrict', {{$district->id}})" class="pl-2 hover:text-red-600 cursor-pointer">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
        </x-jet-action-section>

        {{-- Modal para editar los distritos --}}
        <x-jet-dialog-modal wire:model="editForm.open">
            <x-slot name="title">
                Editar Distrito
            </x-slot>
            <x-slot name="content">
                <div class="space-y-3">
                    <div>
                        <x-jet-label>
                            Nombre
                        </x-jet-label>
                        <x-jet-input wire:model="editForm.name" class="w-full mt-1" type="text" />
                        <x-jet-input-error for="editForm.name" />
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>

    @push('script')
    <script>
        Livewire.on('deleteDistrict',districtId => {
            Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir los cambios posterioremente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.show-city', 'delete', districtId)

                    Swal.fire(
                    'Eliminado!',
                    'El distrito ha sido eliminado.',
                    'success'
                    )
                }
            })
        });
        
    </script>
    @endpush

</div>