<div>
	{{-- Page content --}}

	<body class="antialiased font-sans bg-gray-200">
	<div class="container mx-auto px-4 sm:px-8">
		<div class="py-8">
			<div class="pb-4 text-center md:text-left">
				<h2 class="text-2xl font-semibold leading-tight">Citas</h2>
			</div>
			{{--			<div class="flex flex-col items-center w-full md:flex-row">--}}
			{{--				<div class="flex flex-col md:flex-row justify-center items-center">--}}
			{{--					<div class="bg-gray-200 flex flex-col md:flex-row justify-center items-center rounded-lg">--}}
			{{--						<input id="date" type="date" wire:model.defer="date_start" class="border-2 border-gray-100 rounded-lg">--}}
			{{--						<div class="bg-gray-200 px-2"><span>al</span></div>--}}
			{{--						<input id="date" type="date" wire:model.defer="date_end" class="border-2 border-gray-100 rounded-lg">--}}
			{{--					</div>--}}
			{{--					<div>--}}
			{{--						<button type="button" wire:click="search()"--}}
			{{--										class=" flex border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">--}}
			{{--							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"--}}
			{{--									 stroke="currentColor">--}}
			{{--								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
			{{--											d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>--}}
			{{--							</svg>--}}
			{{--						</button>--}}
			{{--					</div>--}}
			{{--				</div>--}}
			{{--			</div>--}}
			<div class="flex flex-col items-center w-full md:flex-row">
				<div class="my-2 w-full items-center flex sm:flex-row flex-col">
					<div class="flex flex-row mb-1 sm:mb-0">
						<div class="relative">
							<select wire:model="show"
											class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
								<option>5</option>
								<option>10</option>
								<option>20</option>
								<option>50</option>
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							</div>
						</div>
						<div class="relative ">
							<select wire:model="status"
											class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
								<option>Pendientes</option>
								<option>Atendidos</option>
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							</div>
						</div>
					</div>
					<div class="block relative w-10/12 md:w-8/12 lg:w-9/12">
							<span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
								<svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
									<path
										d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
									</path>
								</svg>
							</span>
						<input wire:model="search" placeholder="Buscar"
									 class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
					</div>
				</div>
				<div class="flex items-center">
					{{--					@livewire('create-hospital')--}}
				</div>

			</div>
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
						<tr>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('hospitals.name')">
									Hospital
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('users.name')">
									Doctor
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
									</svg>
								</div>
							</th>
							<th
								class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider select-none	">
								<div class="flex justify-between cursor-pointer" wire:click="order('appointments.date')">
									Fecha
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
						@if ($appointments->count())
							@foreach ($appointments as $appointment)
								<tr>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{ $appointment->hospital->name }}</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p
											class="text-gray-600 whitespace-no-wrap">{{ $appointment->doctor->user->name ." ".$appointment->doctor->user->lastname }}</p>
									</td>
									<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
										<p class="text-gray-600 whitespace-no-wrap">{{$appointment->date}}</p>
									</td>
									@if ($appointment->status == 'Retrasado')
										<td class="px-5 py-5 border-b border-gray-200 bg-transparent text-sm w-10">
												<span
													class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
										</td>
										<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
											<div class="flex flex-col md:flex-row">
												@livewire('info-appointment', ['appointment' => $appointment], key($appointment->id))
												<div class="flex">
													<a wire:click="delete({{ $appointment->id }})"
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
									@elseif($appointment->status == 'Atendido')
										<td class="px-5 py-5 border-b border-gray-200 bg-transparent text-sm w-10">
												<span
													class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
										</td>
										<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
											<div class="flex flex-col md:flex-row">
												@livewire('info-appointment', ['appointment' => $appointment], key($appointment->id))
											</div>
										</td>
									@else
										<td class="px-5 py-5 border-b border-gray-200 bg-transparent text-sm w-10">
												<span
													class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
										</td>
										<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-10">
											<div class="flex flex-col md:flex-row">
												@livewire('info-appointment', ['appointment' => $appointment], key($appointment->id))
												<div class="flex">
													<a wire:click="delete({{ $appointment->id }})"
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
			<div class="py-2 px-4">
								{{ $appointments->links() }}
			</div>
		</div>
	</div>
	</body>
</div>
