<div>
	<div class="container mx-auto px-4 sm:px-8">
		<div class="py-8">
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
				<div>
					<x-jet-label value="Hospital" class="mb-2"></x-jet-label>
					<select wire:model="hospital"
									class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
						<option hidden>Seleccione</option>
						@if (!is_null($hospitals))
							@foreach ($hospitals as $hospital )
								<option value="{{$hospital->id}}">
									{{ $hospital->name }} </option>
							@endforeach
						@endif
					</select>
					@error('hospital')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
				<div>
					<x-jet-label value="Doctor" class="mb-2"></x-jet-label>
					<select wire:model="doctor"
									class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'">
						<option hidden>Seleccione</option>
						@if (!is_null($doctors))
							@foreach ($doctors as $doctor )
								<option value="{{$doctor->id}}">
									{{ $doctor->user->name ." ".$doctor->user->lastname }} </option>
							@endforeach
						@endif
					</select>
					@error('doctor')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
				<div>
					<x-jet-label value="Fecha y Hora" class="mb-2"></x-jet-label>
					<input type="datetime-local" wire:model.defer = "date">
					@error('date')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
				</div>
			</div>
			<div>
				<x-jet-button wire:click="store()" wire:loading.attr='disabled' wire:target="store">Guardar</x-jet-button>
			</div>
			<div>
				<link rel="stylesheet" href="../../../node_modules/fullcalendar/main.min.css">
				<script src="../../../node_modules/fullcalendar/main.min.js"></script>
				<script>

					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('calendar');
						var calendar = new FullCalendar.Calendar(calendarEl, {
							initialView: 'dayGridMonth'
						});
						calendar.render();
					});

				</script>
				<div id='calendar'></div>
			</div>
		</div>
	</div>

</div>
