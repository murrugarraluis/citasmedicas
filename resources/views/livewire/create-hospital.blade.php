<div>
	<div class="relative">
		<button type="button" wire:click="open()"
			class=" flex border border-green-400 bg-green-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
			<p class="pr-2">Agregar</p>
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
			</svg>
		</button>
	</div>
	<x-jet-dialog-modal wire:model="open" maxWidth="2xl">
		<x-slot name='title'>
			<p class="font-bold">
				Nuevo Hospital
			</p>
		</x-slot>
		<x-slot name='content'>
			<div>
				<div class="grid grid-cols-3 gap-4 my-2">
					<div>
						<x-jet-label value="Departamento" class="mb-2"></x-jet-label>
						<select wire:model="departament"
							class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@foreach ($departaments as $departament )
							<option value="{{$departament->code}}">
								{{ $departament->name }}</option>
							@endforeach
						</select>
						@error('departament')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Provincia" class="mb-2"></x-jet-label>
						<select wire:model="provincie"
							class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($provincies))
							@foreach ($provincies as $provincie )
							<option value="{{$provincie->code}}">
								{{ $provincie->name }}</option>
							@endforeach
							@endif
						</select>
						@error('provincie')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Distrito" class="mb-2"></x-jet-label>
						<select wire:model="distritic"
							class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
							<option hidden>Seleccione</option>
							@if (!is_null($distritics))
							@foreach ($distritics as $distritic )
							<option value="{{$distritic->code}}">
								{{ $distritic->name }} </option>
							@endforeach
							@endif
						</select>
						@error('distritic')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="my-2">
					<x-jet-label value="Nombre Hospital" class="mb-2"></x-jet-label>
					<x-jet-input type="text" class="w-full" wire:model.defer="name"></x-jet-input>
					@error('name')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
			</div>
			<div>
				<div class="grid grid-cols-2 gap-4 my-2">
					<div>
						<x-jet-label value="Documento" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="DNI" maxlength="8"
							onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
						</x-jet-input>
						@error('DNI')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<x-jet-label value="Nombres" class="mb-2"></x-jet-label>
						<x-jet-input type="text" class="w-full" wire:model.defer="firstname"></x-jet-input>
						@error('firstname')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div>
					<x-jet-label value="Apellidos" class="mb-2"></x-jet-label>
					<x-jet-input type="text" class="w-full" wire:model.defer="lastname"></x-jet-input>
					@error('lastname')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
				<div class="grid grid-cols-2 gap-4 my-2">
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
					<div>
						<x-jet-label value="Email" class="mb-2"></x-jet-label>
						<x-jet-input type="email" class="w-full" wire:model.defer="email"></x-jet-input>
						@error('email')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
			</div>
		</x-slot>
		<x-slot name='footer'>
			<x-jet-button wire:click="store()" wire:loading.attr='disabled' wire:target="store">Guardar</x-jet-button>
			<x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>
