<div>
	<div class="flex">
		<a wire:click="open()"
			class="cursor-pointer border border-yellow-400 bg-yellow-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-600 focus:outline-none focus:shadow-outline">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
			</svg>
		</a>
	</div>
	<x-jet-dialog-modal wire:model="open" maxWidth="2xl">
		<x-slot name='title'>
			<p class="font-bold">
				Editar Equipo Covid
			</p>
		</x-slot>
		<x-slot name='content'>
			<div>
				<div class="my-2">
					<x-jet-label value="Nombre Equipo Covid" class="mb-2"></x-jet-label>
					<x-jet-input type="text" class="w-full" wire:model.defer="name"></x-jet-input>
					@error('name')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
			</div>
		</x-slot>
		<x-slot name='footer'>
			<x-jet-button wire:click="update()" wire:loading.attr='disabled' wire:target="update">Guardar</x-jet-button>
			<x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>
