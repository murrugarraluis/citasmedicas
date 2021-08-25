<div>
	<div class="relative">
		<button type="button" wire:click="open()"
			class=" flex border border-green-400 bg-green-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">

			<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
			</svg>
		</button>
	</div>
	<x-jet-dialog-modal wire:model="open" maxWidth="5xl">
    <x-slot name='title'>
			<p class="font-bold">
				Equipo Covid
			</p>
		</x-slot>
		<x-slot name='content'>
			<div>
                <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-4">
                <div class="flex justify-center items-center">
					<div>
						<x-jet-input type="text" class="w-full" wire:model.defer="DNI" placeholder="Documento"></x-jet-input>
						@error('DNI')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
					<div>
						<button type="button" wire:click="search()"
										class=" flex border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
									 stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
							</svg>
						</button>
					</div>
				</div>
                <div class="col-span-3">
					<div class="flex flex-col justify-between items-center md:flex-row ">
						<div class="my-2 w-72 md:px-2">
							<x-jet-input type="text" class="w-full bg-gray-200 text-gray-600" wire:model.defer="name"
													 placeholder="Nombre"
													 disabled></x-jet-input>
							@error('name')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
						</div>
						<div class="my-2 w-72 md:px-2">
							<x-jet-input type="text" class="w-full bg-gray-200 text-gray-600" wire:model.defer="lastname"
													 placeholder="Apellido"
													 disabled></x-jet-input>
							@error('lastname')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
						</div>
						<div class="my-2 w-72 md:px-2">
							<x-jet-input type="text" class="w-full bg-gray-200 text-gray-600" wire:model.defer="speciality"
													 placeholder="Especialidad" disabled></x-jet-input>
							@error('speciality')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
						</div>
						<div>
							<button type="button" wire:click="clear()"
											class=" flex border border-gray-400 bg-gray-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-600 focus:outline-none focus:shadow-outline">
								<p class="pr-2">Limpiar</p>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
										 stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
								</svg>
							</button>
						</div>
					</div>
				</div>
                </div>


                <div>
						<button type="button" wire:click="assign()"
										class=" flex border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
							<p class="pr-2">Asignar</p>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
									 stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
							</svg>
						</button>
					</div>


                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
						<tr>
							{{-- <th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('id')">
									id
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
										stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
									</svg>
								</div>
							</th> --}}
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('DNI')">
									Documento
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('name')">
									Nombre
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('lastname')">
									Apellido
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('speciality')">
									Especalidad
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>

							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('email')">
									email
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('phone')">
									telefono
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								Estado
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
							</th>
						</tr>
						</thead>
						<tbody>
						@if ($doctors->count())
							@foreach ($doctors as $doctor)
								<tr>
									{{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
										<p class="text-gray-600 font-semibold whitespace-no-wrap">
											{{ $doctor->id }}</p>
									</td> --}}
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->user->DNI }}</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->user->name}}</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->user->lastname}}
										</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->speciality}}</p>
									</td>

									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->user->email}}</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $doctor->phone}}</p>
									</td>
									@if ($doctor->trashed())
										<td class="px-5 py-5 border-b border-gray-200 bg-transparent text-sm w-10">
										<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
											<span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
											<span class="relative">Inactivo</span>
										</span>
										</td>
										<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
											<div class="flex flex-col md:flex-row">
												<button wire:click="renovate({{ $doctor->id }})"
																class=" cursor-pointer border border-gray-600 bg-gray-600 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
															 stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																	d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
													</svg>
												</button>
											</div>
										</td>
									@else
										<td class="px-5 py-5 border-b border-gray-200 bg-transparent text-sm w-10">
										<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
											<span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
											<span class="relative">Activo</span>
										</span>
										</td>
										<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
											<div class="flex flex-col md:flex-row">

												<div class="flex">
													<a wire:click="suprim({{ $doctor->id }})"
														 class="cursor-pointer border border-red-400 bg-red-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
																 stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																		d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
														</svg>
													</a>
												</div>
											</div>
										</td>
									@endif
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="8" class="py-4 px-2 text-sm italic text-center">No Existe Ningun
									Registro Coincidente
								</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>




			</div>
		</x-slot>
		<x-slot name='footer'>
			<!-- <x-jet-button wire:click="store()" wire:loading.attr='disabled' wire:target="store">Guardar</x-jet-button>
			<x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button> -->
		</x-slot>
	</x-jet-dialog-modal>
</div>
