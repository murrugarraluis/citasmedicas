<div>
	<div class="flex">
		<a wire:click="open()"
			 class="cursor-pointer border border-yellow-400 bg-yellow-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-600 focus:outline-none focus:shadow-outline">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
			</svg>
		</a>
	</div>
	<x-jet-dialog-modal wire:model="open" maxWidth="5xl">
		<x-slot name='title'>
			<p class="font-bold">
				Editar Doctor
			</p>
		</x-slot>
		<x-slot name='content'>
			<div>
				<div class="grid grid-cols-2 gap-4 my-2">
					<div>
						<x-jet-label value="DNI" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="DNI" maxlength="8"
												 onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
						</x-jet-input>
						@error('DNI')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Nombres" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="name"></x-jet-input>
						@error('name')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div>
					<x-jet-label value="Apellidos" class="mb-2"></x-jet-label>
					<x-jet-input type="text" class="w-full" wire:model.defer="lastname"></x-jet-input>
					@error('lastname')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
				<div class="grid grid-cols-2 gap-4 my-2">
					<div>
						<x-jet-label value="Especialidad" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="specialty"></x-jet-input>
						@error('specialty')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Sexo" class="mb-2"></x-jet-label>
						<select wire:model.defer="gender"
										class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							<option>Masculino</option>
							<option>Femenino</option>
						</select>
						@error('gender')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="grid grid-cols-2 gap-4 my-2">
					<div>
						<x-jet-label value="Celular" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="phone"></x-jet-input>
						@error('phone')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Email" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="email"></x-jet-input>
						@error('email')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</x-slot>
		<x-slot name='footer'>
			<x-jet-button wire:click="update()" wire:loading.attr='disabled' wire:target="update">Guardar</x-jet-button>
			<x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>
