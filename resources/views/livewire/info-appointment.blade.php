<div>
	<div class="flex">
		<a wire:click="open()"
			 class="cursor-pointer border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
			</svg>
		</a>
	</div>
	<x-jet-dialog-modal wire:model="open" maxWidth="2xl">
		<x-slot name='title'>
			<p class="font-bold">
				Información de la Cita
			</p>
		</x-slot>
		<x-slot name='content'>
			<div>
				<div class="grid grid-cols-1 gap-1 md:grid-cols-4">
					<div class="mb-2">
						<x-jet-label value="Hospital" class="mb-2"></x-jet-label>
						<p>{{ $appointment->hospital->name }}</p>
					</div>
					<div class="mb-2">
						<x-jet-label value="Doctor" class="mb-2"></x-jet-label>
						<p>{{ $appointment->doctor->user->name ." ".$appointment->doctor->user->lastname }}</p>
					</div>
					<div class="mb-2">
						<x-jet-label value="Fecha" class="mb-2"></x-jet-label>
						<p>{{ $appointment->date}}</p>
					</div>
					<div class="mb-2">
						<x-jet-label value="Estado" class="mb-2"></x-jet-label>
						@if ($appointment->status == 'Retrasado')
							<span
								class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
						@elseif($appointment->status == 'Atendido')
							<span
								class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
						@else
							<span
								class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
													<span aria-hidden
																class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
													<span class="relative">{{$appointment->status}}</span>
												</span>
						@endif
					</div>
				</div>
				<div class="mt-2">
					@if ($appointment->status == 'Retrasado')
						<p class="my-2 font-bold">Mensaje</p>
						<p>El estado de la cita es retrasado, nos comunicaremos lo mas pronto posible con usted.Le pedimos las disculpas del caso.</p>
					@elseif($appointment->status == 'Atendido')
						<p class="my-2 font-bold">Mensaje</p>
						<p>El estado de la cita es atendido, la cita a sido realizada con éxito.</p>
						<p class="my-2 font-bold">Diagnostico</p>
						<p>{{$appointment->attentionsheet->description}}</p>
					@else
						<p class="my-2 font-bold">Mensaje</p>
						<p>El estado de la cita es pendiente, la cita se realizará en la fecha pactada,pronto el doctor se comunicará con usted.</p>
					@endif
				</div>
			</div>
		</x-slot>
		<x-slot name='footer'>
			<x-jet-secondary-button wire:click="$set('open',false)">Salir</x-jet-secondary-button>
		</x-slot>
	</x-jet-dialog-modal>
</div>

