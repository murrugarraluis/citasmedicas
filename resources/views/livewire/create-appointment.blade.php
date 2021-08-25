<div>
	<div class="container mx-auto px-4 sm:px-8">
		<div class="py-8">
			<div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">
				<div class="grid grid-cols-1 my-2 md:grid-cols-3 md:gap-4 lg:grid-cols-1 lg:col-span-1 lg:gap-1">
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
					@role('Doctor')
					<div class="md:col-start-1	md:col-end-4 lg:col-span-1">
						<x-jet-label value="DNI" class="mb-2"></x-jet-label>
						<div class="flex items-center w-full">
							<div class="w-full">
								<x-jet-input type="text" class="w-full" wire:model.defer="DNI" placeholder="DNI"></x-jet-input>
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
							<div>
								<button type="button" wire:click="clear()"
												class=" flex border border-gray-400 bg-gray-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-600 focus:outline-none focus:shadow-outline">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
											 stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
									</svg>
								</button>
							</div>
						</div>
						<div class="grid grid-cols-2 gap-4 lg:grid-cols-1 lg:gap-1">
						<div class="my-2 w-full">
							<x-jet-label value="Nombre" class="mb-2"></x-jet-label>
							<x-jet-input type="text" class="w-full bg-gray-200 text-gray-600" wire:model.defer="name"
													 placeholder="Nombre"
													 disabled></x-jet-input>
							@error('name')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
						</div>
						<div class="my-2 w-full">
							<x-jet-label value="Apellido" class="mb-2"></x-jet-label>
							<x-jet-input type="text" class="w-full bg-gray-200 text-gray-600" wire:model.defer="lastname"
													 placeholder="Apellido"
													 disabled></x-jet-input>
							@error('lastname')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
						</div>
						</div>
					</div>
					@endrole
					<div class="hidden">
						<x-jet-label value="Fecha y Hora" class="mb-2"></x-jet-label>
						<input id="date" type="datetime-local" wire:model="date" disabled>
						@error('date')<span class="italic lowercase text-xs text-red-600">{{ $message }}</span>@enderror
					</div>
				</div>
				<div class="py-4 lg:col-span-2">
					<div id='calendar'></div>
					<div class="flex justify-center md:justify-end mt-4">
						<x-jet-button wire:click="store()" wire:loading.attr='disabled' wire:target="store">Guardar</x-jet-button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.addEventListener('DOMContentLoaded', event => {
			var myDate = @this.date;
			var Appointments = @this.appointments;
			var f = new Date();
			var m = (f.getMonth() + 1).toString().length < 2 ? '0' + (f.getMonth() + 1) : (f.getMonth() + 1);
			var h = f.getHours().toString().length < 2 ? '0' + (f.getHours() + 1) + ':00' : (f.getHours() + 1) + ':00';
			var fecha = f.getFullYear() + "-" + m + "-" + f.getDate();
			var fechaGlobal = f.getFullYear() + "-" + m + "-" + f.getDate() + 'T' + h;
			var calendarEl = document.getElementById('calendar');
			var ArrayEvents = [
				{
					groupId: 999,
					title: 'Mi Cita',
					start: myDate
				},
				{
					groupId: 'testGroupId',
					start: fechaGlobal,
					end: '4021-08-18T16:00',
					display: 'inverse-background',
					color: 'red',
				}
			];
			if (Appointments != null) {
				let array = Appointments['appointments'];
				for (let val of array) {
					var prueba = {groupId: 999, title: 'Ocupado', start: val['date'], color: 'red'};
					ArrayEvents.push(prueba);
				}
			}

			var calendar = new FullCalendar.Calendar(calendarEl, {
					locale: 'es',
					initialDate: fecha,
					initialView: 'timeGridWeek',
					nowIndicator: true,
					headerToolbar: {
						left: 'prev,next today',
						center: 'title',
						right: ''
					},
					navLinks: false, // can click day/week names to navigate views
					editable: false,
					selectable: false,
					selectMirror: true,
					dayMaxEvents: true, // allow "more" link when too many events
					height: 550,
					expandRows: true,
					slotDuration: '01:00',
					allDaySlot: false,
					slotMinTime: "08:00:00",
					slotMaxTime: "19:00:00",
					windowResize: function (arg) {
					},
					slotLabelFormat: {
						hour: '2-digit',
						minute: '2-digit',
						omitZeroMinute: true,
						meridiem: 'short',
						hour12: true
					},
					eventTimeFormat: {
						hour: '2-digit',
						minute: '2-digit',
						hour12: true
					},
					dateClick: function (info) {
						var selectedDoctor = @this.doctor;
						if (selectedDoctor != null) {
							var inputF = document.getElementById("date");
							var dateF = new Date(info.dateStr);
							var m = (dateF.getMonth() + 1).toString().length < 2 ? '0' + (dateF.getMonth() + 1) : (dateF.getMonth() + 1);
							var h = dateF.getHours().toString().length < 2 ? '0' + (dateF.getHours()) + ':00' : (dateF.getHours()) + ':00';
							var fechaM = dateF.getFullYear() + "-" + m + "-" + dateF.getDate() + 'T' + h;
							if (fechaM < fechaGlobal) {
								Livewire.emit('info', 'no se puede realizar la cita en esta fecha')
							} else {
								inputF.value = fechaM;
							@this.date
								= fechaM;
								fechaM = null;
							}
						} else {
							Livewire.emit('info', 'Antes de escoger un horario, por favor complete todos los campos')
						}
					},
					events: ArrayEvents,
				})
			;
			calendar.render();
		});
	</script>
</div>
